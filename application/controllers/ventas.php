<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("ventas_model");
		$this->load->model("articulos_model");
		$this->load->model("personas_model");
		$this->load->model("precios_model");
		$this->load->model("reportes_model");
	}


	public function index()
	{
		$diaPromo=$this->precios_model->diapromo(); 
		$dp=$diaPromo[0];
   	 	$promoActiva=$dp->activa;

		$listaVenta=$this->ventas_model->listarVenta();
		$listaArtEntel=$this->ventas_model->listarArtEntel(); 
		$listaArtViva=$this->ventas_model->listarArtViva();
		$listaArtTigo=$this->ventas_model->listarArtTigo();
		$listaPersona=$this->personas_model->listarpersonas();
		$data['promoActiva']=$promoActiva;
		$data['ventas']=$listaVenta;
		$data['artEntel']=$listaArtEntel;
		$data['artViva']=$listaArtViva;
		$data['artTigo']=$listaArtTigo;
		$data['personas']=$listaPersona;

		$this->load->view('inic/header'); 
		$this->load->view('ventas/index',$data);
		$this->load->view('inic/footer');
	}

	function buscarCi(){
		$ci=$_POST['ci'];

		$result=$this->personas_model->buscarCi($ci);
		echo json_encode($result);
	}

	public function articulosPer(){
		$id=$_POST['id']; // id es idPersona

		$result = $this->precios_model->listarPreciosPer($id);

		echo json_encode($result);
	}
	// busca deuda con idCliente
	public function buscarDeuda(){
		$id=$_POST['id']; // id es idPersona

		$result = $this->ventas_model->buscarDeudas($id);

		echo json_encode($result);
	}

	

	public function insert(){

		$idUsuario = $this->session->userdata('idusuario'); // con minuscula
		
		//array
		$idArticulo=$_POST['idArticulo'];
		$cantidad=$_POST['cantidad'];
		$precioVenta=$_POST['precioVenta'];
		$precioCompra=$_POST['precioCompra'];

		$numE=count($idArticulo);
		$utilidad=0;
		 for ($i=0; $i < $numE; $i++) { 
		 	$utilidad+=$cantidad[$i]*($precioVenta[$i]-$precioCompra[$i]);
		 }

		$data['idCliente']= $_POST['cbxPersona']; // viene idCliente o tambien llamado idPersona
		$data['idUsuario']= $idUsuario;
		$data['totalVenta']=$_POST['totalVenta'];
		$data['utilidad']=$utilidad;
		$tipoVenta= $_POST['cbxTipoVenta']; // para verificar si la venta es al contado(0) o credito(1)
		if ($tipoVenta==NULL) {
			$tipoVenta=0;
		}
		$data['tipoVenta']=$tipoVenta;
		//recuperamos deuda actual
		$saldoActual=0;
		if ($tipoVenta!=0) {
			$id=$_POST['cbxPersona'];
			$totalVenta=$_POST['totalVenta'];
		 	$datosPersona=$this->personas_model->GetPersona($id);
			foreach ($datosPersona->result() as $row) {
				$saldoCliente=$row->saldoDeuda;
			}
			$saldoActual=$saldoCliente+$totalVenta;
		}
		
		$this->ventas_model->insertVenta($data,$idArticulo,$cantidad,$precioVenta,$tipoVenta,$saldoActual);
		
		//redirect('ventas','refresh');

	}



	public function delete($id){
			
		$this->ventas_model->deleteVenta($id);

		$ventasPer=$this->ventas_model->listaVentaPer($id); // recibe idVenta

		$utilidad=0;
		foreach ($ventasPer->result() as $row) {
			$utilidad=$row->utilidad;
		}

		$capitalPrincipal=$this->reportes_model->capitalPrincipal(); 
		$cp=$capitalPrincipal[0];
   	 	$capitalPrincipal=$cp->montoCapital;

   	 	$capitalActual=$capitalPrincipal-$utilidad;

   	 	$this->ventas_model->udateCapital($capitalActual); // restamos la utilidad al capitalPrincipal

   	 	foreach ($ventasPer->result() as $row) {
			$idArticulo=$row->idArticulo;
			$stock=$row->stock;
			$cantidad=$row->cantidad;
			$stockActual=$stock+$cantidad;

			$this->ventas_model->updateStock($idArticulo, $stockActual);
		}


		redirect('ventas','refresh');
		
	}


	// emite recibo venta
	public function recibopdf($id=NULL)
	{
		if ($id==0) {
			
			$ultimoIdVenta=$this->ventas_model->ultimoIdVenta();

			$id="";
			foreach ($ultimoIdVenta as $row) {
				$id= $row->idVenta;
			}
		}
		
		$this->load->library('pdf');
		$venta=$this->ventas_model->detalleVendido($id);
		$venta=$venta->result();

		//var_dump($venta);

		foreach ($venta as $row) {
			$cliente=$row->nombre." ".$row->primerApellido." ".$row->segundoApellido;
			$cedula=$row->numDocumento;
			$fechaVenta=$row->fechaHora;
			$totalVenta=$row->totalVenta;
			$idVenta=$row->idVenta;
			
		}

		$this->pdf=new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("R/".$cliente);
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(169, 208, 245);
		$this->pdf->SetFont('Arial','','12');
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'',0,0,'C');

		$this->pdf->Ln(3);

		

		

// Cabecera principal
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',14);
	    //Movernos a la derecha
		$this->pdf->Cell(50);
	    $this->pdf->Cell(70,10,utf8_decode('RECIBO DE VENTA'),0,0,'C',1);
	    $this->pdf->Ln(13);


	   // apunte: $this->pdf->Cell(ancho,alto,contenido,Margen(1,0),0,'L',background(0,1));
// informacion general
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',10);
	    //$this->pdf->Cell(50);
	    $this->pdf->Cell(20,5,utf8_decode('N° Recibo :'),0,0,'L',0);
	    $this->pdf->Cell(60,5,$idVenta,0,0,'L',0);
	    $this->pdf->Ln(5);
	    //$this->pdf->Cell(50);
	   	$this->pdf->Cell(20,5,utf8_decode('Nombre    :'),0,0,'L',0);
	    $this->pdf->Cell(60,5,utf8_decode($cliente),0,0,'L',0);
	    $this->pdf->Ln(5);
	    //$this->pdf->Cell(50);
	    $this->pdf->Cell(20,5,utf8_decode('Fecha       :'),0,0,'L',0);
	    $this->pdf->Cell(60,5,date($fechaVenta),0,0,'L',0);
	    $this->pdf->Ln(8);


		

		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    
	    $this->pdf->Cell(20,7,utf8_decode('Nro'),1,0,'C',1);
	    $this->pdf->Cell(55,7,utf8_decode('Detalle'),1,0,'C',1);
	    $this->pdf->Cell(45,7,'Cantidad',1,0,'C',1);
	    //$this->pdf->Cell(40,7,'Precio Unitario(Bs)',1,0,'C',1);
	    $this->pdf->Cell(50,7,'Importe (Bs)',1,0,'C',1);
	    $this->pdf->Ln(7);

	    $indice=1;
//lista detalle
    	foreach ($venta as $row) {
    		$cant=$row->cantidad;
    		$nomArt=$row->nombreArticulo;
    		$precioVenta=$row->precioVenta;
    		$subTotal=$cant*$precioVenta;
    	$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(20,6,utf8_decode($indice),1,0,'C',1);
    	$this->pdf->Cell(55,6,utf8_decode($nomArt),1,0,'C',1);
	    $this->pdf->Cell(45,6,utf8_decode($cant),1,0,'C',1);
	    //$this->pdf->Cell(40,6,utf8_decode($precioVenta),1,0,'C',1);
	    $this->pdf->Cell(50,6, utf8_decode($subTotal),1,0,'C',1);
	    $this->pdf->Ln(6);
	    $indice++;
		}
	    


// totales
	    $this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    //$this->pdf->Cell(70);
	    $this->pdf->Cell(120,7,'Total',1,0,'C',1);
	    $this->pdf->Cell(50,7, $totalVenta,1,0,'C',1);
	    $this->pdf->Ln(8);

// pie agradecimiento
	    $this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
	    
	    
	    $this->pdf->Cell(60);
	    $this->pdf->Cell(70,5,'Almacen: La cancha, San Martin entre Tarata -  Cel : 77430222',0,0,'C',1);
	    $this->pdf->Ln(5);
	    $this->pdf->Cell(60);
	    $this->pdf->Cell(70,5,'Gracias por su preferencia',0,0,'C',1);

		$this->pdf->Output($cliente.".pdf","I");
		
		//redirect('ventas','refresh');

	}



	//borrar

	function listarArticulo(){
		$result=$this->articulos_model->listarArticulo();
		echo json_encode($result);
	}



	public function update(){
		$id=$_POST['txtIdArticulo'];
		$data['nombre']=$_POST['txtNombre'];
		$data['precioCompra']=$_POST['txtPrecioCompra'];
		$data['stock']=$_POST['txtStock'];
		$data['precioVenta']=$_POST['txtPrecioVenta'];
		$data['descripcion']=$_POST['txtDescripcion'];

		$this->articulos_model->updateArticulo($id,$data);
		redirect('articulos/index','refresh');
	}



	public function detalleArticulos($id=NULL){

		if ($id!=0) {
			$listaVenta=$this->ventas_model->detalleVendido($id);
			$data['detalleVentas']=$listaVenta;
			$this->load->view('inic/header'); 
			$this->load->view('ventas/lista',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			$ultimoIdVenta=$this->ventas_model->ultimoIdVenta();

			$id="";
			foreach ($ultimoIdVenta as $row) {
				$id= $row->idVenta;
			}
			

			//$this->recibopdf($id//);
			
			//redirect('ventas/recibopdf'+'/'+$id);

			$listaVenta=$this->ventas_model->detalleVendido($id);
			
			$data['detalleVentas']=$listaVenta;
			$this->load->view('inic/header'); 
			$this->load->view('ventas/lista',$data);
			$this->load->view('inic/footer');

		}
	}

	//borrar
	
	public function prueba()
	{
		$query=$this->db->get('persona');
		$execonsulta=$query->result();
		echo json_encode($execonsulta);
	}




}
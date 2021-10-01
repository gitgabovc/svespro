<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("compras_model");
		$this->load->model("ventas_model");
		$this->load->model("articulos_model");
		$this->load->model("personas_model");
	}


	public function index()
	{
		$listaCompra=$this->compras_model->listarCompra();
		$listaArtEntel=$this->ventas_model->listarArtEntel(); 
		$listaArtViva=$this->ventas_model->listarArtViva();
		$listaArtTigo=$this->ventas_model->listarArtTigo();
		$data['compras']=$listaCompra;
		$data['artEntel']=$listaArtEntel;
		$data['artViva']=$listaArtViva;
		$data['artTigo']=$listaArtTigo;
		$this->load->view('inic/header'); 
		$this->load->view('compras/index',$data);
		$this->load->view('inic/footer');
	}

	
	public function insert(){

		$idUsuario = $this->session->userdata('idusuario'); // con minuscula

		$data['idUsuario']= $idUsuario;
		$data['totalCompra']=$_POST['totalCompra'];
		
		
		//array
		$idArticulo=$_POST['idArticulo'];
		$cantidad=$_POST['cantidad'];
		$precioCompra=$_POST['precioCompra'];
		
		$this->compras_model->insertCompra($data,$idArticulo,$cantidad,$precioCompra);
		
		redirect('compras','refresh');

	}



	public function delete($id){
			
		$this->compras_model->deleteCompra($id);

		$comprasPer=$this->compras_model->listaCompraPer($id); // recibe idVenta

		//$capitalPrincipal=$this->reportes_model->capitalPrincipal(); 
		//$cp=$capitalPrincipal[0];
   	 	//$capitalPrincipal=$cp->montoCapital;

   	 	//$capitalActual=$capitalPrincipal-$utilidad;

   	 	//$this->ventas_model->udateCapital($capitalActual); // restamos la utilidad al capitalPrincipal

   	 	foreach ($comprasPer->result() as $row) {
			$idArticulo=$row->idArticulo;
			$stock=$row->stock;
			$cantidad=$row->cantidad;
			$stockActual=$stock-$cantidad;

			$this->compras_model->updateStock($idArticulo, $stockActual);
		}


		redirect('compras','refresh');
		
	}


	// emite recibo de compra
	public function recibopdf($id=NULL)
	{
		if ($id==0) {
			
			$ultimoIdCompra=$this->compras_model->ultimoIdCompra();

			//$id="";
			foreach ($ultimoIdCompra as $row) {
				$id= $row->idCompra;
			}
		}

		
		$this->load->library('pdf');
		$compra=$this->compras_model->detalleCompra($id);
		$compra=$compra->result();

		//var_dump($compra);

		$this->pdf=new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("RECIBO");
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(169, 208, 245);
		$this->pdf->SetFont('Arial','','12');
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'',0,0,'C');

		$this->pdf->Ln(12);

		

		foreach ($compra as $row) {
			$fechaCompra=$row->fecha;
			$totalCompra=$row->totalCompra;
			$idCompra=$row->idCompra;
			$usuario=$row->usuario;
			
		}

// Cabecera principal
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',14);
	    //Movernos a la derecha
		$this->pdf->Cell(50);
	    $this->pdf->Cell(70,10,utf8_decode('RECIBO DE COMPRA'),0,0,'C',1);
	    $this->pdf->Ln(12);


	   // apunte: $this->pdf->Cell(ancho,alto,contenido,Margen(1,0),0,'L',background(0,1));
// informacion general
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',10);
	    //$this->pdf->Cell(50);
	    $this->pdf->Cell(20,6,utf8_decode('N° Recibo :'),0,0,'L',0);
	    $this->pdf->Cell(60,6,$idCompra,0,0,'L',0);
	    $this->pdf->Ln(6);
	    //$this->pdf->Cell(50);
	   	$this->pdf->Cell(20,6,utf8_decode('Usuario    :'),0,0,'L',0);
	    $this->pdf->Cell(60,6,utf8_decode($usuario),0,0,'L',0);
	    $this->pdf->Ln(6);
	    //$this->pdf->Cell(50);
	    $this->pdf->Cell(20,6,utf8_decode('Fecha       :'),0,0,'L',0);
	    $this->pdf->Cell(60,6,date($fechaCompra),0,0,'L',0);
	    $this->pdf->Ln(12);


		

		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    
	    $this->pdf->Cell(50,7,utf8_decode('Detalle'),1,0,'C',1);
	    $this->pdf->Cell(40,7,'Cantidad',1,0,'C',1);
	    $this->pdf->Cell(40,7,'Precio Unitario(Bs)',1,0,'C',1);
	    $this->pdf->Cell(40,7,'Importe (Bs)',1,0,'C',1);
	    $this->pdf->Ln(7);

	    
//lista detalle
    	foreach ($compra as $row) {
    		$cant=$row->cantidad;
    		$nomArt=$row->nombreArticulo;
    		$precioCompra=$row->precioCompra;
    		$subTotal=$cant*$precioCompra;
    	$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(50,6,utf8_decode($nomArt),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($cant),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($precioCompra),1,0,'C',1);
	    $this->pdf->Cell(40,6, utf8_decode($subTotal),1,0,'C',1);
	    $this->pdf->Ln(6);
		}
	    


// totales
	    $this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    //$this->pdf->Cell(70);
	    $this->pdf->Cell(130,7,'Total',1,0,'C',1);
	    $this->pdf->Cell(40,7, $totalCompra,1,0,'C',1);
	    $this->pdf->Ln(15);

// pie agradecimiento
	    $this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
	    $this->pdf->Cell(60);
	    $this->pdf->Cell(70,6,'Gracias por su preferencia',0,0,'C',1);
	    $this->pdf->Ln(6);
	    $this->pdf->Cell(60);
	    $this->pdf->Cell(70,6,'Cochabamba - Bolivia',0,0,'C',1);

		$this->pdf->Output('Compra'.$idCompra.".pdf","I");
		

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
			$listaCompra=$this->compras_model->detalleCompra($id);
			$data['detalleCompras']=$listaCompra;
			$this->load->view('inic/header'); 
			$this->load->view('compras/lista',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			$ultimoIdCompra=$this->compras_model->ultimoIdCompra();

			$id="";
			foreach ($ultimoIdCompra as $row) {
				$id= $row->idCompra;
			}
			

			//$this->recibopdf($id//);
			
			//redirect('ventas/recibopdf'+'/'+$id);

			$listaCompra=$this->compras_model->detalleCompra($id);
			
			$data['detalleCompras']=$listaCompra;
			$this->load->view('inic/header'); 
			$this->load->view('compras/lista',$data);
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportesvc extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("reportes_model");
		$this->load->model("personas_model");
		$this->load->model("ventas_model");
	}


	public function index()
	{
		$listaClientes=$this->personas_model->listarpersonas();
		$listaVentas=$this->ventas_model->listarVenta();
		$data['clientes']=$listaClientes;
		$data['ventas']=$listaVentas;
		$this->load->view('inic/header');
		$this->load->view('reportes/indexvc',$data);
		$this->load->view('inic/footer');
		
	}

	public function reporfechas()
	{
		$idCliente=$this->input->post('idCliente');
		$fechaInicio=$this->input->post('fechaInicio');
		$fechaFinal=$this->input->post('fechaFinal');
		
		$resultado = $this->reportes_model->dbreporfechasvc($fechaInicio,$fechaFinal,$idCliente);
		echo json_encode($resultado);
	}

	public function totalmes()
	{
		//$fechaInicio=$this->input->post('fechaInicio');
		//$fechaFinal=$this->input->post('fechaFinal');
		$mesactual=$this->input->post('mesactual');
		$anioactual=$this->input->post('anioactual');
		//$resultado = $this->reportes_model->ventasmes($fechaInicio,$fechaFinal);

		$array = array();

		for ($i=0; $i < 5 ; $i++) { 
			$fechaInicio=$anioactual.'/'.$mesactual.'/'.'01';
			$fechaFinal=$anioactual.'/'.$mesactual.'/'.'31';
			$resultado = $this->reportes_model->ventasmes($fechaInicio,$fechaFinal);

			$array[$i] = $resultado;
			$mesactual--;
		}


		

		echo json_encode($array);
	}


	public function reporXarticulos()
	{
		$idCliente=$this->input->post('idCliente');
		$fechaInicio=$this->input->post('fechaInicio');
		$fechaFinal=$this->input->post('fechaFinal');
		
		$resultado = $this->reportes_model->dbreporfechasXarticulosVC($fechaInicio,$fechaFinal,$idCliente);
		echo json_encode($resultado);
	}


	public function reporteGlobalPDF($fechaInicio,$fechaFinal,$idCliente)
	{

		$this->load->library('pdf');

		//$id=$this->input->post('idCliente');
		//$fechaInicio=$this->input->post('fechaInicio');
		//$fechaFinal=$this->input->post('fechaFinal');

		$datos = $this->reportes_model->dbreporfechasvc($fechaInicio,$fechaFinal,$idCliente);
		//$datos=$datos->result();

		$this->pdf=new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("REPORTE GLOBAL");
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('Arial','','12');
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'',0,0,'C');

		$this->pdf->Ln(12);

// Cabecera principal
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',14);
	    //Movernos a la derecha
		$this->pdf->Cell(50);
	    $this->pdf->Cell(70,6,utf8_decode('REPORTE DE INGRESOS'),1,0,'C',1);
	    $this->pdf->Ln(12);

	    $montototal=0;
		$utilidad=0;
		$Cliente="";
		$Ci="";
	    foreach ($datos as $row) {
			$montototal+=$row->subTotal;
			//$utilidad+=$row->utilidad;
			$Cliente=$row->cliente;
			$Ci=$row->ci;
			}


			$fechaInicio = date("d/m/Y", strtotime($fechaInicio));
			$fechaFinal = date("d/m/Y", strtotime($fechaFinal));

// informacion general
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',10);

	    $this->pdf->Cell(45,6,utf8_decode('Cliente'),1,0,'C',1);
	    $this->pdf->Cell(45,6, $Cliente,1,0,'C',0);
	    $this->pdf->Cell(30);
		$this->pdf->Cell(30,6,utf8_decode('Fecha Inicio'),1,0,'C',1);
		$this->pdf->Cell(30,6,$fechaInicio,1,0,'C',0);
	    $this->pdf->Ln(6);
		$this->pdf->Cell(45,6,utf8_decode('CI'),1,0,'C',1);
	    $this->pdf->Cell(45,6, $Ci,1,0,'C',0);
	    $this->pdf->Cell(30);
		$this->pdf->Cell(30,6,utf8_decode('Fecha Final'),1,0,'C',1);
		$this->pdf->Cell(30,6,$fechaFinal,1,0,'C',0);
	    
	    $this->pdf->Ln(12);



// cabecera de la tabla
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    $this->pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	    //$this->pdf->Cell(40,6,'Cliente',1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode('Artículo'),1,0,'C',1);
	    $this->pdf->Cell(30,6,'Cantidad',1,0,'C',1);
	    $this->pdf->Cell(30,6,'Precio(Bs)',1,0,'C',1);
	    $this->pdf->Cell(40,6,'SubTotal(Bs)',1,0,'C',1);
	    $this->pdf->Cell(30,6,'Fecha',1,0,'C',1);
	    //$this->pdf->Cell(20,6,'Usuario',1,0,'C',1);
	    $this->pdf->Ln(6);


	    $cont=0;
		foreach ($datos as $row) {
			$cont++;
			$cliente=$row->cliente;
			$articulo=$row->articulo;
			$cantidad=$row->cantidad;
			$precio=$row->precioVenta;
			$subTotal=$row->subTotal;
			$fecha=$row->fechaHora;
			$usuario=$row->login;

		$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(10,6,utf8_decode($cont),1,0,'C',1);
	    //$this->pdf->Cell(40,6,utf8_decode($cliente),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($articulo),1,0,'C',1);
	    $this->pdf->Cell(30,6,$cantidad,1,0,'C',1);
	    $this->pdf->Cell(30,6,$precio,1,0,'C',1);
	    $this->pdf->Cell(40,6,$subTotal,1,0,'C',1);
	    $this->pdf->Cell(30,6,$fecha,1,0,'C',1);
	    //$this->pdf->Cell(20,6,"",1,0,'C',1);
	    $this->pdf->Ln(6);
		}

// fila para el total
		$this->pdf->SetFillColor(169, 208, 245);
    	$this->pdf->SetFont('Arial','B',12);
    	//$this->pdf->Cell(90); // posiciona en 85
	    $this->pdf->Cell(110,6,'Total',1,0,'R',1);
	    $this->pdf->Cell(40,6,$montototal,1,0,'C',1);
	    $this->pdf->Cell(30,6,'',1,0,'C',1);
	    $this->pdf->Ln(6);


// crear y lanzar el pdf
		$ahora=time();
        $ahora = date("d-m-Y H:i:s", $ahora); 

		$this->pdf->Output("Reporte-".$ahora.".pdf","I");
	}

	

	public function reporteXarticulosPDF($fechaInicio,$fechaFinal,$idCliente)
	{

		$this->load->library('pdf');

		//$id=$this->input->post('idCliente');
		//$fechaInicio=$this->input->post('fechaInicio');
		//$fechaFinal=$this->input->post('fechaFinal');

		$datos = $this->reportes_model->dbreporfechasXarticulosVC($fechaInicio,$fechaFinal,$idCliente);
		//$datos=$datos->result();

		$this->pdf=new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("REPORTE GLOBAL");
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('Arial','','12');
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'',0,0,'C');

		$this->pdf->Ln(12);

// Cabecera principal
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',14);
	    //Movernos a la derecha
		$this->pdf->Cell(50);
	    $this->pdf->Cell(70,6,utf8_decode('REPORTE DE VENTAS'),0,0,'C',1);
	    $this->pdf->Ln(12);

	    $mayor=0;
		$menor=100000;
	    foreach ($datos as $row) {
	    	if ($row->cantidad>$mayor) {
	    		$mayor=$row->cantidad;
	    	}
	    	if ($row->cantidad<$menor) {
	    		$menor=$row->cantidad;
	    	}
			}

		$ArticuloMay="";
		$ArticuloMen="";

			foreach ($datos as $row) {
	    	if ($row->cantidad==$mayor) {
	    		$ArticuloMay=$row->articulo;
	    	}
	    	if ($row->cantidad==$menor) {
	    		$ArticuloMen=$row->articulo;
	    	}
			}


			$fechaInicio = date("d/m/Y", strtotime($fechaInicio));
			$fechaFinal = date("d/m/Y", strtotime($fechaFinal));
			$Cliente="";
			$Ci="";
			foreach ($datos as $row) {
				$Cliente=$row->cliente;
				$Ci=$row->ci;
			}


// informacion general
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',10);
	    $this->pdf->Cell(30,6,utf8_decode('Cliente'),1,0,'C',1);
	    $this->pdf->Cell(50,6, $Cliente,1,0,'C',0);
	    $this->pdf->Cell(40);
	    $this->pdf->Cell(30,6,utf8_decode('Fecha Inicio'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaInicio,1,0,'C',0);
	    $this->pdf->Ln(6);
	   	$this->pdf->Cell(30,6,utf8_decode('CI'),1,0,'C',1);
	    $this->pdf->Cell(50,6, $Ci,1,0,'C',0);
	    $this->pdf->Cell(40);
	    $this->pdf->Cell(30,6,utf8_decode('Fecha Final'),1,0,'C',1);
	    $this->pdf->Cell(30,6, $fechaFinal,1,0,'C',0);
	    $this->pdf->Ln(12);



// cabecera de la tabla
		$this->pdf->SetFillColor(169, 208, 245);
	    $this->pdf->SetFont('Arial','B',12);
	    $this->pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	    $this->pdf->Cell(45,6,utf8_decode('Artículo'),1,0,'C',1);
	    $this->pdf->Cell(40,6, 'Precio Unitario',1,0,'C',1);
	    $this->pdf->Cell(45,6, 'Cantidad',1,0,'C',1);
	    $this->pdf->Cell(40,6,'Total (Bs)',1,0,'C',1);
	    $this->pdf->Ln(6);


	    $cont=0;
	    $TotalMovimiento=0;
	    $TotalUtilidad=0;
		foreach ($datos as $row) {
			$cont++;
			$TotalMovimiento+=$row->subTotal;
			$TotalUtilidad+=$row->utilidad;
			$articulo=$row->articulo;
			$cantidad=$row->cantidad;
			$subTotal=$row->subTotal;
			$utilidad=$row->utilidad;
			$precioVenta=$row->precioVenta;
// contenido de la tabla
		$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(10,6,utf8_decode($cont),1,0,'C',1);
	    $this->pdf->Cell(45,6,utf8_decode($articulo),1,0,'C',1);
	    $this->pdf->Cell(40,6, $precioVenta,1,0,'C',1);
	    $this->pdf->Cell(45,6, $cantidad,1,0,'C',1);
	    $this->pdf->Cell(40,6, $subTotal,1,0,'C',1);
	    $this->pdf->Ln(6);

		}

// fila para el total
		$this->pdf->SetFillColor(169, 208, 245);
    	$this->pdf->SetFont('Arial','B',12);
    	//$this->pdf->Cell(90); // posiciona en 85
	    //$this->pdf->Cell(95,6, "",1,0,'R',1);
	    $this->pdf->Cell(140,6, 'Total',1,0,'C',1);
	    $this->pdf->Cell(40,6, $TotalMovimiento,1,0,'C',1);
	    $this->pdf->Ln(6);


// crear y lanzar el pdf
		$ahora=time();
        $ahora = date("d-m-Y H:i:s", $ahora); 

		$this->pdf->Output("Reporte-".$ahora.".pdf","I");
	}





}
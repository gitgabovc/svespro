<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("categoria_model");
		$this->load->model("cliente_model");
		$this->load->model("reporte_model");
		$this->load->model("venta_model");
		$this->load->model("compra_model");
	}


	public function cliente()
	{
		//$listaProductos=$this->producto_model->listarProducto();
		// $listaVentasPorCliente=$this->reporte_model->listarVentaPorClienteFecha();
		//$listaMarca=$this->producto_model->listarMarca();
		//$data['productos']=$listaProductos;

		$data['listaClientes'] = $this->cliente_model->listarCliente();
		//$data['marcas']=$listaMarca;
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('reporte/cliente', $data);
		$this->load->view('layouts/footer');
	}

	public function ventas()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('reporte/venta');
		$this->load->view('layouts/footer');
	}

	public function compra()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('reporte/compra');
		$this->load->view('layouts/footer');
	}


	public function clienteSinConFecha($idCliente, $fechaInicial = NULL, $fechaFinal = NULL)
	{

		$ventas = $this->reporte_model->listarVentasClientePorId($idCliente, $fechaInicial, $fechaFinal);

		$cliente = $this->cliente_model->get($idCliente)->row();

		$totalVenta = 0;
		foreach ($ventas->result() as $row) {

			$totalVenta += $row->precioUnitario;
		}

		$fecha_inicio = date($fechaInicial . " " . "00:00:00");

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Clientes'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Reporte de Ventas Por Cliente', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, "Nombre Cliente", 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, utf8_decode(strtoupper($cliente->nombres . " " . $cliente->primerApellido . " " . $cliente->segundoApellido)), 0, 0, 'L', 0);

		$this->pdf->Ln(7); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Venta: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalVenta . " Bs.- ", 0, 0, 'L', 0);

		if ($fechaInicial != NULL) {
			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Inicial: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaInicial), 0, 0, 'L', 0);

			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Final: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaFinal), 0, 0, 'L', 0);
		}


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Fecha', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);
		$num = 1;
		foreach ($ventas->result() as $row) {
			$fechaRegistro = $row->fechaRegistro;
			$precioUnitario = $row->precioUnitario;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, formatearFecha($fechaRegistro), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, $precioUnitario. " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}
		$this->pdf->Output("clientes.pdf", "I");
	}


	public function clienteTodosSinConFecha( $fechaInicial = NULL, $fechaFinal = NULL)
	{

		$ventas = $this->reporte_model->listarVentasCliente($fechaInicial, $fechaFinal);

		$totalVenta = 0;

		foreach ($ventas->result() as $row) {
			$totalVenta += $row->importeTotalVenta;
		}
		

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Clientes'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Reporte de Ventas Todos Los Clientes', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)



		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Venta: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalVenta . " Bs.- ", 0, 0, 'L', 0);

		if ($fechaInicial != NULL) {
			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Inicial: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaInicial), 0, 0, 'L', 0);

			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Final: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaFinal), 0, 0, 'L', 0);
		}


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Cliente', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);
		$num = 1;
		foreach ($ventas->result() as $row) {
			$importeTotalVenta = $row->importeTotalVenta;
			$nombreCompleto = $row->nombres . " ". $row->primerApellido . " ".$row->segundoApellido;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreCompleto )), 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(50, 5, $importeTotalVenta . " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}
		$this->pdf->Output("clientes.pdf", "I");
	}



	public function ventaSinFechas()
	{

		$ventas = $this->venta_model->lista();
		$ventasMes = $this->reporte_model->ventaSinFechasPorMes();

		$totalVenta = 0;
		foreach ($ventas->result() as $row) {
			$totalVenta+=$row->precioUnitario;
		}

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Venta'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Lista De Ventas', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Venta: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalVenta . " Bs.- ", 0, 0, 'L', 0);


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, 'Fecha', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Usuario', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Cliente', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 7);
		$num = 1;
		foreach ($ventas->result() as $row) {
			$fechaRegistro = $row->fr;
			$precioUnitario = $row->precioUnitario;
			$nombreCliente = $row->cNombre . " ". $row->cPA . " ". $row->cSA;
			$nombreEmpleado = $row->eNombre . " ". $row->ePA . " ". $row->eSA;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, formatearFecha($fechaRegistro), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreEmpleado)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreCliente)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $precioUnitario. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Ventas Por Mes ', 0, 0, 'L', 0);




		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, utf8_decode('Año'), 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Mes', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);
		$num = 1;

		$meses = array(
			1 => 'Enero',
			2 => 'Febrero',
			3 => 'Marzo',
			4 => 'Abril',
			5 => 'Mayo',
			6 => 'Junio',
			7 => 'Julio',
			8 => 'Agosto',
			9 => 'Septiembre',
			10 => 'Octubre',
			11 => 'Noviembre',
			12 => 'Diciembre'
		);
		foreach ($ventasMes->result() as $row) {
			$totalVentas = $row->totalVentas;
			$anio = $row->anio;
			$mes = $meses[$row->mes];

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, $anio, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, $mes, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalVentas. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}

		$this->pdf->Output("ventas_todas.pdf", "I");
	}

	public function ventaConFechas($fechaInicial, $fechaFinal)
	{

		$ventas = $this->reporte_model->ventaFiltradaFechas($fechaInicial, $fechaFinal);
		$ventasMes = $this->reporte_model->sumaVentasPorMesFechas($fechaInicial, $fechaFinal);

		$totalVenta = 0;
		foreach ($ventas->result() as $row) {
			$totalVenta+=$row->precioUnitario;
		}

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Ventas Por Fechas'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Lista De Ventas', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Venta: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalVenta . " Bs.- ", 0, 0, 'L', 0);

		
			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Inicial: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaInicial), 0, 0, 'L', 0);

			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Final: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaFinal), 0, 0, 'L', 0);
		


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, 'Fecha', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Usuario', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Cliente', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 7);





		$num = 1;
		foreach ($ventas->result() as $row) {
			$fechaRegistro = $row->fr;
			$precioUnitario = $row->precioUnitario;
			$nombreCliente = $row->cNombre . " ". $row->cPA . " ". $row->cSA;
			$nombreEmpleado = $row->eNombre . " ". $row->ePA . " ". $row->eSA;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, formatearFecha($fechaRegistro), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreEmpleado)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreCliente)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $precioUnitario. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}



		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Ventas Por Mes ', 0, 0, 'L', 0);




		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, utf8_decode('Año'), 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Mes', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);



		$meses = array(
			1 => 'Enero',
			2 => 'Febrero',
			3 => 'Marzo',
			4 => 'Abril',
			5 => 'Mayo',
			6 => 'Junio',
			7 => 'Julio',
			8 => 'Agosto',
			9 => 'Septiembre',
			10 => 'Octubre',
			11 => 'Noviembre',
			12 => 'Diciembre'
		);




		$num = 1;
		foreach ($ventasMes->result() as $row) {
			$totalVentas = $row->totalVentas;
			$anio = $row->anio;
			$mes = $meses[$row->mes];

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, $anio, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, $mes, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalVentas. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}




		$this->pdf->Output("ventas_por_fechas.pdf", "I");
	}

	public function compraSinFechas()
	{

		$compras = $this->compra_model->listaCompras();
		$comprasMes = $this->reporte_model->sumaComprasPorMes();

		$totalCompra = 0;
		foreach ($compras->result() as $row) {
			$totalCompra+=$row->totalCompra;
		}

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Compra'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Lista De Compras', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Compras: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalCompra . " Bs.- ", 0, 0, 'L', 0);


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, 'Fecha', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Usuario', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Proveedor', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 7);
		$num = 1;
		foreach ($compras->result() as $row) {
			$fechaRegistro = $row->fechaRegistro;
			$totalCompra = $row->totalCompra;
			$nombreEmpleado = $row->nombreEmpleado . " ". $row->primerApellidoEmpleado . " ". $row->segundoApellidoEmpleado;
			$nombreProveedor = $row->nombreProveedor;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, formatearFecha($fechaRegistro), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreEmpleado)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreProveedor)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalCompra. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Compras Por Mes ', 0, 0, 'L', 0);




		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, utf8_decode('Año'), 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Mes', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);
		$num = 1;

		$meses = array(
			1 => 'Enero',
			2 => 'Febrero',
			3 => 'Marzo',
			4 => 'Abril',
			5 => 'Mayo',
			6 => 'Junio',
			7 => 'Julio',
			8 => 'Agosto',
			9 => 'Septiembre',
			10 => 'Octubre',
			11 => 'Noviembre',
			12 => 'Diciembre'
		);
		foreach ($comprasMes->result() as $row) {
			$totalComprasPorMes = $row->totalComprasPorMes;
			$anio = $row->anio;
			$mes = $meses[$row->mes];

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, $anio, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, $mes, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalComprasPorMes. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}

		$this->pdf->Output("compras_todas.pdf", "I");
	}

	public function compraConFechas($fechaInicial, $fechaFinal)
	{

		$compras = $this->reporte_model->compraFiltradaFechas($fechaInicial, $fechaFinal);
		$comprasMes = $this->reporte_model->sumaComprasPorMesFechas($fechaInicial, $fechaFinal);

		$totalCompra = 0;
		foreach ($compras->result() as $row) {
			$totalCompra+=$row->totalCompra;
		}

		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Reporte de Compras Por Fechas'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Lista De Compras', 0, 0, 'C', 1);
		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Total Compra: ', 0, 0, 'L', 0);

		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(25, 5, $totalCompra . " Bs.- ", 0, 0, 'L', 0);

		
			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Inicial: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaInicial), 0, 0, 'L', 0);

			$this->pdf->Ln(7); //espaciado luego del titulo del documento
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(27, 5, 'Fecha Final: ', 0, 0, 'L', 0);

			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(25, 5, formatearFechaSinHora($fechaFinal), 0, 0, 'L', 0);
		


		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, 'Fecha', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Usuario', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Cliente', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 7);





		$num = 1;
		foreach ($compras->result() as $row) {
			$fechaRegistro = $row->fechaRegistro;
			$totalCompras = $row->totalCompra;
			$nombreProveedor = $row->nombreProveedor;
			$nombreEmpleado = $row->nombreEmpleado . " ". $row->primerApellidoEmpleado . " ". $row->segundoApellidoEmpleado;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, formatearFecha($fechaRegistro), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreProveedor)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, utf8_decode(strtoupper($nombreEmpleado)), 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalCompras. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}



		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(27, 5, 'Compras Por Mes ', 0, 0, 'L', 0);




		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(27, 5, utf8_decode('Año'), 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(50, 5, 'Mes', 'TBLR', 0, 'C', 0);
		$this->pdf->Cell(33, 5, 'Monto En Bolivianos', 'TBLR', 0, 'C', 0);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);



		$meses = array(
			1 => 'Enero',
			2 => 'Febrero',
			3 => 'Marzo',
			4 => 'Abril',
			5 => 'Mayo',
			6 => 'Junio',
			7 => 'Julio',
			8 => 'Agosto',
			9 => 'Septiembre',
			10 => 'Octubre',
			11 => 'Noviembre',
			12 => 'Diciembre'
		);




		$num = 1;
		foreach ($comprasMes->result() as $row) {
			$totalComprasPorMes = $row->totalComprasPorMes;
			$anio = $row->anio;
			$mes = $meses[$row->mes];

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(27, 5, $anio, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 5, $mes, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(33, 5, $totalComprasPorMes. " ". " ". " ". " ". " "." ". " ". " ". " ". " ", 'TBLR', 0, 'R', 0);
			$this->pdf->Ln(5);
			$num++;
		}




		$this->pdf->Output("compras_por_fechas.pdf", "I");
	}



	public function insert()
	{
		$data['nombreCategoria'] = $_POST['txtNombreCategoria'];
		//$data['FechaRegistro']=$_POST['txtFechaRegistro'];

		$this->categoria_model->insert($data);
		redirect('categoria', 'refresh');
	}


	public function delete($id)
	{
		$data = array('estado' => 0);
		$this->categoria_model->delete($id, $data);
		redirect('categoria', 'refresh');
	}


	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getCategoria'] = $this->categoria_model->get($id);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('categoria/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			//regresar a index enviar parametro
			redirect('');
		}
	}

	public function update()
	{
		$id = $_POST['txtIdCategoria'];
		$data['nombreCategoria'] = $_POST['txtNombreCategoria'];
		//$data['fechaRegistro']=$_POST['txtFechaRegistro'];

		$this->categoria_model->update($id, $data);
		redirect('categoria', 'refresh');
	}
	/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/
}

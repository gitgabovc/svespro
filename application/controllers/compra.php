<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Compra extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("usuario_model");
		$this->load->model("empleado_model");
		$this->load->model("compra_model");
		$this->load->model("producto_model");
		$this->load->model("proveedor_model");
	}


	public function index()
	{

		$data['listaCompras'] = $this->compra_model->listaCompras();
		$data['listaProveedores'] = $this->compra_model->listaProveedores();
		$data['listaProductos'] = $this->compra_model->listaProductos();
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('compra/index', $data);
		$this->load->view('layouts/footer');
	}
	public function buscar_en_bd_cliente()
	{

		// aca empieza

		$palabra_buscar = $_POST['palabra'];

		$data = array(
			"opcion" => "buscadorCliente",
			"clientes" => $this->venta_model->buscar($palabra_buscar),

		);
		$this->load->view('venta/VO_venta', $data);
	}
	public function buscar_en_bd_producto()
	{

		// aca empieza

		$palabra_buscar = $_POST['palabraProducto'];

		$data = array(
			"opcion" => "buscadorProducto",
			"productos" => $this->venta_model->buscarProducto($palabra_buscar),

		);
		$this->load->view('venta/VO_venta', $data);
	}

	public function insertar()
	{


		$idProducto = ($this->input->post('idProducto'));
		$idProveedor = ($this->input->post('idProveedor'));
		$cantidad = ($this->input->post('cantidad'));
		$precioCompra = ($this->input->post('precioCompra'));
		$precioVenta = ($this->input->post('precioVenta'));
		$descripcion = ($this->input->post('descripcion'));
		$idEmpleado = $this->session->userdata('idEmpleado');
		$costoTotal = 0;

		for ($i = 0; $i < count($idProducto); $i++) {
			$subtotal = $cantidad[$i] * $precioCompra[$i];
			$costoTotal += $subtotal;
		}

		$this->db->trans_start();

		$idCompra = $this->compra_model->insertCompra($costoTotal, $descripcion, $idProveedor, $idEmpleado);

		for ($i = 0; $i < count($idProducto); $i++) {
			$this->compra_model->insertDetalleCompra($idCompra, $idProducto[$i], $cantidad[$i], $precioCompra[$i], $precioVenta[$i]);
			$this->compra_model->actualizarStock($idProducto[$i], $cantidad[$i]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo "false";
		} else {
			$this->db->trans_commit();
			echo "true";
		}
	}

	public function update()
	{


		$idCompra = ($this->input->post('idCompra'));
		$idProducto = ($this->input->post('idProducto'));
		$idProductoAnterior = ($this->input->post('idProductoAnterior'));
		$idProveedor = ($this->input->post('idProveedor'));
		$cantidad = ($this->input->post('cantidad'));
		$cantidadAnterior = ($this->input->post('cantidadAnterior'));
		$precioCompra = ($this->input->post('precioCompra'));
		$precioVenta = ($this->input->post('precioVenta'));
		$descripcion = ($this->input->post('descripcion'));
		$costoTotal = 0;

		for ($i = 0; $i < count($idProducto); $i++) {
			$subtotal = $cantidad[$i] * $precioCompra[$i];
			$costoTotal += $subtotal;
		}

		$this->db->trans_start();

		$this->compra_model->actualizarCompra($costoTotal, $descripcion, $idProveedor, $idCompra);

		$this->compra_model->eliminarDetalleCompraPorId($idCompra);

		for ($i = 0; $i < count($idProductoAnterior); $i++) {
			$this->compra_model->actualizarStock($idProductoAnterior[$i], $cantidadAnterior[$i], true);
		}

		for ($i = 0; $i < count($idProducto); $i++) {
			$this->compra_model->insertDetalleCompra($idCompra, $idProducto[$i], $cantidad[$i], $precioCompra[$i], $precioVenta[$i]);
			$this->compra_model->actualizarStock($idProducto[$i], $cantidad[$i]);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			redirect('');
		} else {
			$this->db->trans_commit();
			redirect('compra/index');
		}
	}


	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getCompra'] = $this->compra_model->getCompra($id);
			$data['getDetalleCompra'] = $this->compra_model->getDetalleCompra($id);
			$data['getProducto'] = $this->compra_model->listaProductos();
			$data['getProveedor'] = $this->proveedor_model->listarProveedores();
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('compra/edit', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			//regresar a index enviar parametro
			redirect('');
		}
	}

	public function delete($id)
	{

		$this->db->trans_start();

		$listaDetalleCompra =$this->compra_model->listaDetalleCompraPorIdSinJoin($id);

		foreach($listaDetalleCompra->result() as $row) {
			$this->compra_model->actualizarStock($row->idProducto, $row->cantidad, true);
		}

		$this->compra_model->eliminarDetalleCompraPorId($id);
		$this->compra_model->eliminarCompraPorId($id);


		$this->db->trans_complete();



		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			redirect('comdwapra/lodwag');
		} else {
			$this->db->trans_commit();
			redirect('compra');
		}


		
	}

	public function imprimir($id)
	{
		$ventas = $this->venta_model->listaventa($id);
		$detallesCliente = $this->venta_model->detallesCliente($id);
		foreach ($detallesCliente as $row) {
			$nombreCliente = $row->nombres . ' ' . $row->primerApellido . ' ' . $row->segundoApellido;
			$nit = $row->nit;
			$vf = $row->vf;
			$ttal = 'Bs.- ' . $row->precioUnitario;
		}
		//$nombreEmpleado = $this->session->userdata('usuario');
		$nombreEmpleado = 'Ariel Viamont Mamani';
		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages(); //numeracion
		$this->pdf->SetTitle('Recibo SVES'); //titulo de los plantas del documento o del pdf
		$this->pdf->SetLeftMargin(15); //margen izq.
		$this->pdf->SetRightMargin(15); //margen derecho
		$this->pdf->SetFillColor(210, 210, 210); //color de griss
		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
		$this->pdf->cell(30); //tamanio de la celda
		$this->pdf->Cell(120, 10, 'Recibo de Venta', 0, 0, 'C', 1);
		$this->pdf->Ln(15);
		$this->pdf->SetFillColor(255, 255, 255); //color de griss
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Cell(20, 8, 'Cliente:', 0, 0, 'L', 1);
		$this->pdf->Cell(10, 8, $nombreCliente, 0, 0, 'L', 0);
		$this->pdf->SetFont('Arial', 'B', 20);
		$this->pdf->Cell(65);
		$this->pdf->Cell(10, 8, $ttal, 0, 0, 'L', 1);
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->Ln(8);
		$this->pdf->Cell(20, 8, 'Nit:', 0, 0, 'L', 1);
		$this->pdf->Cell(10, 8, $nit, 0, 0, 'L', 1);
		$this->pdf->Ln(8);
		$this->pdf->Cell(20, 8, 'Usuario:', 0, 0, 'L', 1);
		$this->pdf->Cell(10, 8, $nombreEmpleado, 0, 0, 'L', 1);
		$this->pdf->Ln(8);
		$this->pdf->Cell(20, 8, 'Fecha :', 0, 0, 'L', 1);
		$this->pdf->Cell(10, 8, $vf, 0, 0, 'L', 1);


		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

		$this->pdf->Ln(15); //espaciado luego del titulo del documento
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(50, 5, 'Nombre', 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(30, 5, 'Precio', 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(30, 5, 'Cantidad', 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(30, 5, 'Total', 'TBLR', 0, 'L', 1);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 9);
		$num = 1;
		foreach ($ventas as $row) {
			$nombreProducto = $row->nombreProducto;
			$cantidad = $row->cantidad;
			$precioTotal = $row->precioTotal;
			$tt = $cantidad * $precioTotal;

			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(50, 5, $nombreProducto, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(30, 5, $precioTotal, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(30, 5, $cantidad, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(30, 5, $tt, 'TBLR', 0, 'L', 0);
			$this->pdf->Ln(5);
			$num++;
		}
		$this->pdf->Output("Listacarrito.pdf", "I");
	}
}

// $this->pdf = new Pdf();
// 		$this->pdf->AddPage();
// 		$this->pdf->AliasNbPages(); //numeracion
// 		$this->pdf->SetTitle('Lista de conductores'); //titulo de los plantas del documento o del pdf
// 		$this->pdf->SetLeftMargin(15); //margen izq.
// 		$this->pdf->SetRightMargin(15); //margen derecho
// 		$this->pdf->SetFillColor(210, 210, 210); //color de griss
// 		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
// 		$this->pdf->cell(30); //tamanio de la celda
// 		$this->pdf->Cell(120, 10, 'Lista de conductores', 0, 0, 'C', 1);
// 		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
// 		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

// 		$this->pdf->Ln(15); //espaciado luego del titulo del documento
// 		$this->pdf->SetFont('Arial', 'B', 9);
// 		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'L', 1);
// 		$this->pdf->Cell(50, 5, 'Nombre', 'TBLR', 0, 'L', 1);
// 		$this->pdf->Ln(5);
// 		$this->pdf->SetFont('Arial', '', 9);
// 		$num = 1;
// 		foreach($ventas as $row) {
// 			$producto = $row->producto;
			
// 			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'L', 0);
// 			$this->pdf->Cell(30, 5, $producto, 'TBLR', 0, 'L', 0);
// 			$this->pdf->Ln(5);
// 			$num++;
// 		}
// 		$this->pdf->Output("Listacarrito.pdf", "I");
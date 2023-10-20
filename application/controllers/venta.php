<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Venta extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("usuario_model");
		$this->load->model("cliente_model");
		$this->load->model("empleado_model");
		$this->load->model("venta_model");
		$this->load->model("compra_model");
		$this->load->model("categoria_model");
	}


	public function index()
	{

		$data['listaVentas'] = $this->venta_model->lista();
		$data['listaClientes'] = $this->cliente_model->listarCliente();
		$data['listaProductos'] = $this->compra_model->listaProductos();
		$data['listaCategoria'] = $this->categoria_model->listarCategoria();

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('venta/index', $data);
		$this->load->view('layouts/footer');
	}

	public function rc($id)
	{
		$this->imprimir($id);
		//redirect("venta");
	}


	/******************** DELETE  ***************************** */

	public function delete($id)
	{

		$this->db->trans_start();

		$listaDetalleVenta = $this->venta_model->listaDetalleVentaPorIdSinJoin($id);

		foreach ($listaDetalleVenta->result() as $row) {
			$this->compra_model->actualizarStock($row->idProducto, $row->cantidad);
		}

		$this->venta_model->eliminarDetalleVentaPorId($id);
		$this->venta_model->eliminarVentaPorId($id);


		$this->db->trans_complete();



		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			redirect('comdwapra/lodwag');
		} else {
			$this->db->trans_commit();
			redirect('venta');
		}
	}





	/******************** UPDATE  ***************************** */

	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getVenta'] = $this->venta_model->getVentaRow($id);
			$data['getDetalleVenta'] = $this->venta_model->getDetalleVentaConJoin
			
			
			($id);
			$data['listaProductos'] = $this->compra_model->listaProductos($id);
			$data['listaClientes'] = $this->cliente_model->listarCliente();
			$data['listaCategoria'] = $this->categoria_model->listarCategoria();

			// mostrar las vistas
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('venta/edit', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			//regresar a index enviar parametro
			redirect('venta');
		}
	}


	public function updateInDataBase()
	{
		//Datos que llegan por post
		$idProductoAnterior = ($this->input->post('idProductoAnterior'));
		$idProductoNuevo = ($this->input->post('idProductoNuevo'));
		$cantidadAnterior = ($this->input->post('cantidadAnterior'));
		$cantidadNuevo = ($this->input->post('cantidadNuevo'));
		// $precioVentaAnterior = ($this->input->post('precioVentaAnterior'));
		$precioVentaNuevo = ($this->input->post('precioVentaNuevo'));
		$descripcion = ($this->input->post('descripcion'));
		$idCliente = ($this->input->post('inputCliente'));
		$idVenta = ($this->input->post('idVenta'));
		$ventaTotal = 0;
		
		
		$this->db->trans_start();

		$this->venta_model->eliminarDetalleVentaPorId($idVenta);

		for ($i = 0; $i < count($idProductoAnterior); $i++) {
			$this->compra_model->actualizarStock($idProductoAnterior[$i], $cantidadAnterior[$i]);
		}

		for ($i = 0; $i < count($idProductoNuevo); $i++) {

			$this->venta_model->insertDetalleVenta($idVenta, $idProductoNuevo[$i], $cantidadNuevo[$i], $precioVentaNuevo[$i]);

			$this->compra_model->actualizarStock($idProductoNuevo[$i], $cantidadNuevo[$i], true);

			$subtotal = $cantidadNuevo[$i] * $precioVentaNuevo[$i];
			$ventaTotal += $subtotal;
		}

		$this->venta_model->actualizarVenta($ventaTotal, $descripcion, $idVenta, $idCliente);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			redirect("venta");
		} else {
			$this->db->trans_commit();
			redirect("venta");

		}
	}



	/******************** INSERT  ***************************** */


	public function insertar()
	{


		$idProducto = ($this->input->post('idProducto'));
		$cantidad = ($this->input->post('cantidad'));
		$precioVenta = ($this->input->post('precioVenta'));
		$descripcion = ($this->input->post('descripcion'));
		$idCliente = ($this->input->post('inputCliente'));
		$idEmpleado = $this->session->userdata('idEmpleado');
		$ventaTotal = 0;

		for ($i = 0; $i < count($idProducto); $i++) {
			$subtotal = $cantidad[$i] * $precioVenta[$i];
			$ventaTotal += $subtotal;
		}

		$this->db->trans_start();

		$idVenta = $this->venta_model->insertVenta($ventaTotal, $descripcion, $idCliente, $idEmpleado);

		for ($i = 0; $i < count($idProducto); $i++) {
			$this->venta_model->insertDetalleVenta($idVenta, $idProducto[$i], $cantidad[$i], $precioVenta[$i]);
			$this->compra_model->actualizarStock($idProducto[$i], $cantidad[$i], true);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo "false";
		} else {
			$this->db->trans_commit();
			echo $idVenta;
		}
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
	public function carrito()
	{
		$venta = json_decode($_POST["arreglo"]);
		$ventasTotal['precioUnitario'] = $_POST["ventasTotal"];
		$ventasTotal['idCliente'] = 1;
		$ventasTotal['idEmpleado'] = 2;
		$this->venta_model->insert($ventasTotal);
		$ventas = $this->venta_model->ultimoIdVenta();
		foreach ($ventas as $row) {
			$idVenta = $row->idVenta;
		};

		foreach ($venta as $prod) {
			$idCarrito = $prod->idCarrito;
			$cantidad = $prod->cantidad;
			$precio = $prod->precio;

			$data = array(
				"idProducto" => $idCarrito,
				"cantidad" => $cantidad,
				"precioTotal" => $precio,
				"idVenta" => $idVenta,
			);
			$idVenta = $data['idVenta'];
			$this->venta_model->Reg_venta($data);
		}
		echo $idVenta;
?>

		 
		  <?php
		}
		public function imprimir($id)
		{
			$listaProductosDetalle = $this->venta_model->getDetalleVentaJoinProducto($id);
			$venta = $this->venta_model->getVenta($id);
			foreach ($venta as $row) {
				$totalVenta = $row->precioUnitario;
				$fecha = formatearFechaSinHora($row->fechaRegistro);
				$hora = mostrarSoloHoraDeFecha($row->fechaRegistro);
				$codigoVenta = $row->idVenta;
			}
			// $detallesCliente = $this->venta_model->detallesCliente($id);
			// foreach ($detallesCliente as $row) {
			// 	$nombreCliente = $row->nombres . ' ' . $row->primerApellido . ' ' . $row->segundoApellido;
			// 	$nit = $row->nit;
			// 	$vf = $row->vf;
			// 	$ttal = 'Bs.- ' . $row->precioUnitario;
			// }
			$this->pdf = new Pdf('P', 'mm', array(80, 200));
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages(); //numeracion
			$this->pdf->SetTitle('Recibo Sariri'); //titulo de los plantas del documento o del pdf
			$this->pdf->SetLeftMargin(10); //margen izq.
			$this->pdf->SetRightMargin(10); //margen derecho
			$this->pdf->SetFont('Arial', 'B', 10); //tipo de letra y tama;o
			$this->pdf->Cell(60, 5, 'Sariri', 0, 0, 'C');



			// del video
			$this->pdf->Ln();
			$this->pdf->SetFont('Arial', '', 9); //tipo de letra y tama;o
			$this->pdf->Cell(60, 6, utf8_decode('Av Ayacucho 1223 - Oruro'), 0, 0, 'C');



			$this->pdf->Ln();
			$this->pdf->Cell(60, 6, utf8_decode('Tel: 78773939'), 0, 0, 'C');

			$this->pdf->Ln();
			$this->pdf->Cell(60, 6, utf8_decode('Cod.' . $codigoVenta), 0, 0, 'C');

			$this->pdf->Ln();
			$this->pdf->Cell(60, 6, utf8_decode('_______________________________'), 0, 0, 'C');


			$this->pdf->Ln();
			$this->pdf->Cell(20, 6, utf8_decode('Fecha: ' . $fecha), 0, 0);
			$this->pdf->Cell(40, 6, utf8_decode($hora), 0, 0, 'R');


			$this->pdf->Ln();
			$this->pdf->Cell(60, 2, utf8_decode('_______________________________'), 0, 0, 'C');


			$this->pdf->Ln();
			$this->pdf->SetFont('Arial', 'B', 9); //tipo de letra y tama;o

			$this->pdf->Cell(30, 10, utf8_decode('Producto'), 0, 0);
			$this->pdf->Cell(30, 10, utf8_decode('Total'), 0, 0, 'R');
			$this->pdf->Ln(2);



			$i = 1;
			foreach ($listaProductosDetalle as $row) {

				$this->pdf->Ln(5);
				$this->pdf->SetFont('Arial', '', 9); //tipo de letra y tama;o
				$this->pdf->Cell(37, 8,  utf8_decode(strtoupper($row->nombreProducto)), 0, 0);
				$this->pdf->Ln(6);
				$this->pdf->SetFont('Arial', '', 7); //tipo de letra y tama;o
				$this->pdf->Cell(30, 3, $row->cantidad . " uds a Bs " . $row->precioTotal . " c/u", 0, 0);
				$this->pdf->Cell(30, 3, ($row->cantidad) * ($row->precioTotal), 0, 0, 'R');



				$i++;


				// $this->pdf->Ln();
				// $this->pdf->SetFont('Arial', '', 8); //tipo de letra y tama;o
				// $this->pdf->Cell(8, 6, $row->cantidad, 0, 0);
				// $this->pdf->Cell(37, 6, utf8_decode($row->nombreProducto), 0, 0);
				// $this->pdf->Cell(15, 6, ($row->cantidad)*($row->precioTotal), 0, 0, 'R');
			}


			// $this->pdf->Ln();
			// $this->pdf->Cell(8, 6, utf8_decode('12'), 0, 0);
			// $this->pdf->Cell(37, 6, utf8_decode('goora print'), 0, 0);
			// $this->pdf->Cell(15, 6, utf8_decode('1330'), 0, 0, 'R');

			// $this->pdf->Ln();
			// $this->pdf->Cell(8, 6, utf8_decode('1222'), 0, 0);
			// $this->pdf->Cell(37, 6, utf8_decode('goora print'), 0, 0);
			// $this->pdf->Cell(15, 6, utf8_decode('1330'), 0, 0, 'R');

			$this->pdf->Ln();
			$this->pdf->Cell(60, 2, utf8_decode('_________________________________________'), 0, 0, 'C');

			$this->pdf->Ln();
			$this->pdf->SetFont('Arial', 'B', 9); //tipo de letra y tama;o
			$this->pdf->Cell(20, 8, utf8_decode('TOTAL'), 0, 0);
			$this->pdf->SetFont('Arial', 'B', 9); //tipo de letra y tama;o
			$this->pdf->Cell(40, 8, utf8_decode($totalVenta), 0, 0, 'R');

			$this->pdf->Ln();
			$this->pdf->SetFont('Arial', 'B', 15); //tipo de letra y tama;o
			$this->pdf->Cell(60, 10, utf8_decode('Gracias'), 0, 0, 'C');



			// $this->pdf->SetFillColor(210, 210, 210); //color de griss
			// $this->pdf->cell(30); //tamanio de la celda
			// $this->pdf->Cell(120, 10, 'Recibo de Venta', 0, 0, 'C', 1);
			// $this->pdf->Ln(15);
			// $this->pdf->SetFillColor(255, 255, 255); //color de griss
			// $this->pdf->SetFont('Arial', '', 9);
			// $this->pdf->Cell(20, 8, 'Cliente:', 0, 0, 'L', 1);
			// $this->pdf->Cell(10, 8, $nombreCliente, 0, 0, 'L', 0);
			// $this->pdf->SetFont('Arial', 'B', 20);
			// $this->pdf->Cell(65);
			// $this->pdf->Cell(10, 8, $ttal, 0, 0, 'L', 1);
			// $this->pdf->SetFont('Arial', '', 9);
			// $this->pdf->Ln(8);
			// $this->pdf->Cell(20, 8, 'Nit:', 0, 0, 'L', 1);
			// $this->pdf->Cell(10, 8, $nit, 0, 0, 'L', 1);
			// $this->pdf->Ln(8);
			// $this->pdf->Cell(20, 8, 'Usuario:', 0, 0, 'L', 1);
			// $this->pdf->Cell(10, 8, $nombreEmpleado, 0, 0, 'L', 1);
			// $this->pdf->Ln(8);
			// $this->pdf->Cell(20, 8, 'Fecha :', 0, 0, 'L', 1);
			// $this->pdf->Cell(10, 8, $vf, 0, 0, 'L', 1);


			//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
			//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

			// $this->pdf->Ln(15); //espaciado luego del titulo del documento
			// $this->pdf->SetFont('Arial', 'B', 9);
			// $this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'L', 1);
			// $this->pdf->Cell(50, 5, 'Nombre', 'TBLR', 0, 'L', 1);
			// $this->pdf->Cell(30, 5, 'Precio', 'TBLR', 0, 'L', 1);
			// $this->pdf->Cell(30, 5, 'Cantidad', 'TBLR', 0, 'L', 1);
			// $this->pdf->Cell(30, 5, 'Total', 'TBLR', 0, 'L', 1);
			// $this->pdf->Ln(5);
			// $this->pdf->SetFont('Arial', '', 9);
			// $num = 1;
			// foreach ($ventas as $row) {
			// 	$nombreProducto = $row->nombreProducto;
			// 	$cantidad = $row->cantidad;
			// 	$precioTotal = $row->precioTotal;
			// 	$tt = $cantidad * $precioTotal;

			// 	$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'L', 0);
			// 	$this->pdf->Cell(50, 5, $nombreProducto, 'TBLR', 0, 'L', 0);
			// 	$this->pdf->Cell(30, 5, $precioTotal, 'TBLR', 0, 'L', 0);
			// 	$this->pdf->Cell(30, 5, $cantidad, 'TBLR', 0, 'L', 0);
			// 	$this->pdf->Cell(30, 5, $tt, 'TBLR', 0, 'L', 0);
			// 	$this->pdf->Ln(5);
			// 	$num++;
			// }
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
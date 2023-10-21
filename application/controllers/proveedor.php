<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("proveedor_model");
	}


	public function index()
	{
		//$listaProductos=$this->producto_model->listarProducto();
		$listaproveedores = $this->proveedor_model->listarProveedores();
		//$listaMarca=$this->producto_model->listarMarca();
		//$data['productos']=$listaProductos;
		$data['proveedores'] = $listaproveedores;
		//$data['marcas']=$listaMarca;
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('proveedor/index', $data);
		$this->load->view('layouts/footer');
	}



	public function insert()
	{
		$data['nombreProveedor'] = $_POST['txtProveedor'];

		$this->proveedor_model->insert($data);
		redirect("proveedor");
	}


	public function delete($id)
	{
		$this->proveedor_model->delete($id);
		redirect('proveedor');
	}


	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getProveedor'] = $this->proveedor_model->get($id);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('proveedor/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			//regresar a index enviar parametro
			redirect('/');
		}
	}

	public function update()
	{
		$id = $_POST['idProveedor'];
		$data['nombreProveedor'] = $_POST['txtProveedor'];
		//$data['fechaRegistro']=$_POST['txtFechaRegistro'];

		$this->proveedor_model->update($id, $data);
		redirect("/proveedor");
	}
	/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/
}

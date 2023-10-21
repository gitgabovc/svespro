<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("material_model");
	}


	public function index()
	{
		//$listaProductos=$this->producto_model->listarProducto();
		$listaMaterial=$this->material_model->listarMaterial();
		//$listaMarca=$this->producto_model->listarMarca();
		//$data['productos']=$listaProductos;
		$data['material']=$listaMaterial;
		//$data['marcas']=$listaMarca;
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('material/index',$data );  
		$this->load->view('layouts/footer');
	}


	
	public function insert(){
		$data['material']=$_POST['material'];
	
		$this->material_model->insert($data);
		redirect("material");


	}
	

	public function delete($id){
		$this->material_model->delete($id);
		echo "<script>window.location.href = "."'".base_url("material")."'".";</script>";
	}


	public function edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
		$data['getMaterial'] = $this->material_model->get($id);
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('material/edit',$data);
		$this->load->view('layouts/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}
	
  	public function update(){
		$id=$_POST['idTipoMaterial'];
		$data['material']=$_POST['material'];
		//$data['fechaRegistro']=$_POST['txtFechaRegistro'];

		$this->material_model->update($id,$data);
		echo "<script>window.location.href = "."'".base_url("material")."'".";</script>";

	}
/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/


}
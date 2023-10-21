<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Talla extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("talla_model");
	}


	public function index()
	{
		//$listaProductos=$this->producto_model->listarProducto();
		$listatallas=$this->talla_model->listarTallas();
		//$listaMarca=$this->producto_model->listarMarca();
		//$data['productos']=$listaProductos;
		$data['tallas']=$listatallas;
		//$data['marcas']=$listaMarca;
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('talla/index',$data );  
		$this->load->view('layouts/footer');
	}


	
	public function insert(){
		$data['talla']=$_POST['talla'];
	
		$this->talla_model->insert($data);
		redirect("talla", "refresh");
		

	}
	

	public function delete($id){
		$this->talla_model->delete($id);
		echo "<script>window.location.href = "."'".base_url("talla")."'".";</script>";
		
	}


	public function edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
		$data['getTalla'] = $this->talla_model->get($id);
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('talla/edit',$data);
		$this->load->view('layouts/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}
	
  	public function update(){
		$id=$_POST['idTalla'];
		$data['talla']=$_POST['talla'];
		//$data['fechaRegistro']=$_POST['txtFechaRegistro'];

		$this->talla_model->update($id,$data);
		echo "<script>window.location.href = "."'".base_url("talla")."'".";</script>";

	}
/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/


}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Color extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("color_model");
	}


	public function index()
	{
		//$listaProductos=$this->producto_model->listarProducto();
		$listaColor=$this->color_model->listarColor();
		//$listaMarca=$this->producto_model->listarMarca();
		//$data['productos']=$listaProductos;
		$data['color']=$listaColor;
		//$data['marcas']=$listaMarca;
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('color/index',$data );  
		$this->load->view('layouts/footer');
	}


	
	public function insert(){
		$data['color']=$_POST['color'];
	
		$this->color_model->insert($data);
		redirect('color');

	}
	

	public function delete($id){
		$this->color_model->delete($id);
		redirect('color','refresh');
		
	}


	public function edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
		$data['getColor'] = $this->color_model->get($id);
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('color/edit',$data);
		$this->load->view('layouts/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}
	
  	public function update(){
		$id=$_POST['idColor'];
		$data['color']=$_POST['color'];
		//$data['fechaRegistro']=$_POST['txtFechaRegistro'];

		$this->color_model->update($id,$data);
		redirect('color','refresh');
	}
/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/


}
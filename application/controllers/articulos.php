<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("articulos_model");
	}


	public function index()
	{
		$listaArticulos=$this->articulos_model->listarArticulo();
		$listaEmpresa=$this->articulos_model->listarEmpresa();
		$data['articulos']=$listaArticulos;
		$data['empresas']=$listaEmpresa;
		$this->load->view('inic/header'); 
		$this->load->view('articulos/index',$data);
		$this->load->view('inic/footer');
	}

	function listarArticulo(){
		$result=$this->articulos_model->listarArticulo();
		echo json_encode($result);
	}


	public function insert(){
		$data['nombre']=$_POST['txtNombre'];
		$data['precioCompra']=$_POST['txtPrecioCompra'];
		$data['stock']=$_POST['txtStock'];
		$data['precioVenta']=$_POST['txtPrecioVenta'];
		$data['descripcion']=$_POST['txtDescripcion'];
		$data['idEmpresa']=$_POST['cbxEmpresa'];
		//copy($_FILES['Imagen']['tmp_name'],'assets/images/'.$data['nombre'].'.jpg');
		//$data['imagen']=$data['nombre'].".jpg";

		
		$this->articulos_model->insertArticulo($data);
		redirect('articulos','refresh');
		

		
	}



	public function delete($id){
			
		$this->articulos_model->deleteArticulo($id);
		redirect('articulos/index','refresh');
		
	}



	public function Edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos

			$listaEmpresa=$this->articulos_model->listarEmpresa();
			$data['getArticulo'] = $this->articulos_model->GetArticulo($id);
			$data['empresas']=$listaEmpresa;
			$this->load->view('inic/header');
			$this->load->view('articulos/edit',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}




	public function update(){
		$id=$_POST['txtIdArticulo'];
		$data['nombre']=$_POST['txtNombre'];
		$data['precioCompra']=$_POST['txtPrecioCompra'];
		$data['stock']=$_POST['txtStock'];
		$data['precioVenta']=$_POST['txtPrecioVenta'];
		$data['descripcion']=$_POST['txtDescripcion'];
		$data['idEmpresa']=$_POST['cbxEmpresa'];

		$this->articulos_model->updateArticulo($id,$data);
		redirect('articulos','refresh');
	}





}
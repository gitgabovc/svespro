<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("personas_model");
		$this->load->model("precios_model");
	}


	public function index()
	{
		$listapersonas=$this->personas_model->listarpersonas();
		$listaarticulos=$this->precios_model->listarArticulo();
		
		$data['personas']=$listapersonas;
		$data['articulos']=$listaarticulos;

		$this->load->view('inic/header');
		$this->load->view('precios/index',$data);
		$this->load->view('inic/footer');
	}



	public function insert(){

		$id=$_POST['cbxCliente'];

		// Array 
		$idArticulo=$_POST['idArticulo'];
		$precio=$_POST['txtPrecio'];
		$precioCredito=$_POST['txtPrecioCredito'];
		$precioPromo=$_POST['txtPrecioPromo'];

		$this->precios_model->insertPrecio($id, $idArticulo, $precio, $precioCredito,$precioPromo);
		redirect('precios','refresh');
	}

	public function Edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
			
			$data['getPersona'] = $this->personas_model->GetPersona($id);
			$data['preciosPer'] = $this->precios_model->listarPreciosPer($id);
		
			$this->load->view('inic/header');
			$this->load->view('precios/edit',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}

	public function update(){
		//array
		$idPrecio=$_POST['idPrecio'];
		$precio=$_POST['txtPrecio'];
		$precioCredito=$_POST['txtPrecioCredito'];
		$precioPromo=$_POST['txtPrecioPromo'];

		$this->precios_model->updatePrecio($idPrecio,$precio,$precioCredito,$precioPromo);
		redirect('precios','refresh');
	}

	


// borrar
	public function delete($id){
			
		$this->personas_model->deletePersona($id);
		redirect('personas/index','refresh');
		
	}











}
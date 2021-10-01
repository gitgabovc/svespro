<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("personas_model");
	}


	public function index()
	{
		$listapersonas=$this->personas_model->listarpersonas();
		
		$data['personas']=$listapersonas;

		$this->load->view('inic/header');
		$this->load->view('personas/index',$data);
		$this->load->view('inic/footer');
	}



	public function insert(){
		$data['nombre']=$_POST['txtNombre'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];
		$data['tipoDocumento']=$_POST['cbxTipoDocumento'];
		$data['numDocumento']=$_POST['txtNumDocumento'];
		$data['direccion']=$_POST['txtDireccion'];
		$data['telefono']=$_POST['txtTelefono'];
		$data['email']=$_POST['txtEmail'];
		//$data['tipoPersona']=$_POST['cbxTipoPersona'];
		$this->personas_model->insertPersona($data);
		redirect('clientes/index','refresh');
	}

	public function delete($id){
			
		$this->personas_model->deletePersona($id);
		redirect('personas/index','refresh');
		
	}


	public function Edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
			
			$data['getPersona'] = $this->personas_model->GetPersona($id);
		
			$this->load->view('inic/header');
			$this->load->view('personas/edit',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}



	public function update(){
		$id=$_POST['txtIdPersona'];
		$data['nombre']=$_POST['txtNombre'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];
		$data['tipoDocumento']=$_POST['cbxTipoDocumento'];
		$data['numDocumento']=$_POST['txtNumDocumento'];
		$data['direccion']=$_POST['txtDireccion'];
		$data['telefono']=$_POST['txtTelefono'];
		$data['email']=$_POST['txtEmail'];
		//$data['tipoPersona']=$_POST['cbxTipoPersona'];

		$this->personas_model->updatePersona($id,$data);
		redirect('personas/index','refresh');
	}

//borrador
	
	public function prueba()
	{
		$query=$this->db->get('clientes');
		$execonsulta=$query->result();
		print_r($execonsulta);
	}




}
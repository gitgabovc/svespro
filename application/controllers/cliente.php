<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("cliente_model");
	}


	public function index()
	{
		$listaClientes=$this->cliente_model->listarCliente();
		
		$data['cliente']=$listaClientes;
		
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('cliente/index',$data );  
		$this->load->view('layouts/footer');
	}
	
	public function insert(){
		$data['nombres']=$_POST['txtNombres'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];		
		$data['telefono']=$_POST['txtTelefono'];

		$this->cliente_model->insert($data);
		redirect('/');

	}
	

	public function delete($id){
		$data = array('estado' => 0 );
		$this->cliente_model->delete($id,$data);
		echo "<script>window.location.href = "."'".base_url("cliente")."'".";</script>";

		
	}

	public function edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
		$data['getCliente'] = $this->cliente_model->get($id);
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('cliente/edit',$data);
		$this->load->view('layouts/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}
	
	public function update(){
		$id=$_POST['txtIdCliente'];
		$data['nombres']=$_POST['txtNombres'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];		
		$data['telefono']=$_POST['txtTelefono'];

		$this->cliente_model->update($id,$data);
		echo "<script>window.location.href = "."'".base_url("cliente")."'".";</script>";
	}
/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/


}
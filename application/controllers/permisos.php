<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("permisos_model");
	}


	public function index()
	{
		$listaPermisos=$this->permisos_model->listarPermisos();
		$data['permisos']=$listaPermisos;
		$this->load->view('inic/header');
		$this->load->view('permisos/index',$data);
		$this->load->view('inic/footer');
		
	}

	



}


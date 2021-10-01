<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capital extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("capital_model");
		$this->load->model("reportes_model");
	}


	public function index()
	{
		$listaMovimientos=$this->capital_model->listarMovimientos();
		$data['movimientos']=$listaMovimientos;
		$this->load->view('inic/header'); 
		$this->load->view('capital/index',$data);
		$this->load->view('inic/footer');
	}

	

	public function insert(){

		$idUsuario = $this->session->userdata('idusuario'); // con minuscula

		$capitalPrincipal=$this->reportes_model->capitalPrincipal();
		$cp=$capitalPrincipal[0];
    	$capitalPrincipal=$cp->montoCapital; 

		$data['monto']=$_POST['txtMonto'];
		$data['capitalAnterior']=$capitalPrincipal;
		$data['capitalActual']=$capitalPrincipal+$_POST['txtMonto'];
		$data['descripcion']=$_POST['txtDescripcion'];
		$data['idUsuario']=$idUsuario;
		
		$this->capital_model->insertMovimiento($data);
		redirect('capital','refresh');
		

		
	}





}
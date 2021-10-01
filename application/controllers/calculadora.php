<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calculadora extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("ventas_model");
		$this->load->model("reportes_model");
	}


	public function index()
	{
		$listaArtEntel=$this->ventas_model->listarArtEntel();
		$data['artEntel']=$listaArtEntel;
		$this->load->view('inic/header'); 
		$this->load->view('calculadora/index',$data);
		$this->load->view('inic/footer');
	}

	

	public function insert(){

		$idUsuario = $this->session->userdata('idusuario'); // con minuscula

		$utilidad=$_POST['totalUtilidad'];
		$data['idUsuario']=$idUsuario;

		$capitalPrincipal=$this->reportes_model->capitalPrincipal(); 
		$cp=$capitalPrincipal[0];
   	 	$capitalPrincipal=$cp->montoCapital;

   	 	$capitalActual=$capitalPrincipal+$utilidad;
		
		$this->ventas_model->udateCapital($capitalActual);
		
		redirect('capital','refresh');
		

		
	}





}
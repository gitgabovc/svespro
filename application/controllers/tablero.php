<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablero extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("reportes_model");
	}


	public function index()
	{
		$totalVentasDia=$this->reportes_model->ventasHoy();
		$totalComprasDia=$this->reportes_model->comprasHoy();
		$capitalTarjetas=$this->reportes_model->capitalTarjetas();
		$capitalPrincipal=$this->reportes_model->capitalPrincipal();  
		$totalCreditos=$this->reportes_model->totalCreditos();
		
		$data['totalVentasDia']=$totalVentasDia;
		$data['totalComprasDia']=$totalComprasDia;
		$data['capitalTarjetas']=$capitalTarjetas;
		$data['capitalPrincipal']=$capitalPrincipal;
		$data['totalCredito']=$totalCreditos;
		
		$this->load->view('inic/header');
		$this->load->view('tablero/index',$data);
		$this->load->view('inic/footer');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
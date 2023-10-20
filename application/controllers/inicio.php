<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("inicio_model");
	}


	public function index()
	{
		$data['totalVentaDia'] = $this->inicio_model->totalVentaDia();
		$data['totalVentaMes'] = $this->inicio_model->totalVentaMes();
		$data['listaVentasHoy'] = $this->inicio_model->listaVentasHoy();
		$data['listaProductosMinimos'] = $this->inicio_model->listaProductosMinimos();
		$data['listaProductosTopMes'] = $this->inicio_model->listaProductosTopMes();
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('inicio/index', $data);
		$this->load->view('layouts/footer');
	}



	
}

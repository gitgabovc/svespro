<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diapromo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("precios_model");
	}


	public function index()
	{
		$diaPromo=$this->precios_model->diapromo(); 
		$dp=$diaPromo[0];
   	 	$promoActiva=$dp->activa;

		$data['promoActiva']=$promoActiva;
		$this->load->view('inic/header'); 
		$this->load->view('diapromo/index',$data);
		$this->load->view('inic/footer');
	}

	

	public function modificar(){

		$promoActiva=$_POST['txtpromoActiva'];
		$promoModif="";

		if ($promoActiva==0) {
			$promoModif=1;
		}else{
			$promoModif=0;
		}


		
		$this->precios_model->udateDiaPromo($promoModif);
		
		redirect('diapromo','refresh');
		

		
	}





}
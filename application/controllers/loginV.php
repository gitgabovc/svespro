<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginV extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("vendedorModel");
	}


	public function index()
	{
		$data['msg']=$this->uri->segment(3);
		if ($this->session->userdata('usuario')) 
		{
			redirect('venta','refresh'); // aqui entraba panel (loginV/panel)
		}
		else
		{
			$this->load->view('login/indexV',$data);
		}

	}




	public function validarVendedor()
	{
		$usuario=$_POST['txtUsuario'];
		$clave=md5($_POST['txtClave']);
		
		$consulta=$this->vendedorModel->validarVendedor($usuario,$clave);
		if ($consulta->num_rows()>0) 
		{
			foreach ($consulta->result() as $row) 
			{
				$this->session->set_userdata('idVendedor',$row->idVendedor);
				$this->session->set_userdata('usuario',$row->usuario);
				$this->session->set_userdata('credito',$row->credito);
				//$this->session->set_userdata('imagen',$row->imagen);
				//redirect('login/panel','refresh');// sesion exitosa
				
				redirect('venta','refresh');
			}
		}
		else
		{
			//redirect('login/index/1','refresh'); // del ing Pavel
			//redirect('login','refresh');
			header("location: loginV?fallo=true");
			//$data['msg']="Error de entrada";
			//$this->load->view('login/login',$data);
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('loginV','refresh');
		//redirect('login/index/3','refresh');

	}

	/*
	public function panel()
	{
		if ($this->session->userdata('usuario')) 
		{
			$this->load->view('inic/header'); 
			$this->load->view('tablero/index');
			$this->load->view('inic/footer');
			
		}
		else
		{
			//$this->load->view('loginform',$data);
			//redirect('login/index/2','refresh');
			redirect('login','refresh');
		}

	}




*/



}


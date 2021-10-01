<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("usuarios_model");
		$this->load->model("permisos_model");
	}


	public function index()
	{
		$data['msg']=$this->uri->segment(3);
		if ($this->session->userdata('login')) 
		{
			redirect('login/panel','refresh');
		}
		else
		{
			$this->load->view('login/login',$data);
		}
	}

	public function validarusuario()
	{
		$login=$_POST['login'];
		$clave=md5($_POST['clave']);
		
		$consulta=$this->usuarios_model->validar($login,$clave);
		if ($consulta->num_rows()>0) 
		{
			foreach ($consulta->result() as $row) 
			{
				$this->session->set_userdata('idusuario',$row->idUsuario);
				$this->session->set_userdata('login',$row->login);
				$this->session->set_userdata('cargo',$row->cargo);
				$this->session->set_userdata('imagen',$row->imagen);
				$this->session->set_userdata('email',$row->email);
				//redirect('login/panel','refresh');// sesion exitosa

				$listaPermisosUsu=$this->permisos_model->listarPermisosUsu($row->idUsuario);

				foreach ($listaPermisosUsu->result() as $row) {
					$this->session->set_userdata($row->nombre,1);
				}

				
				redirect('tablero','refresh');
			}
		}
		else
		{
			//redirect('login/index/1','refresh'); // del ing Pavel
			//redirect('login','refresh');
			header("location: login?fallo=true");
			//$data['msg']="Error de entrada";
			//$this->load->view('login/login',$data);
		}

	}

	public function panel()
	{
		if ($this->session->userdata('login')) 
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

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
		//redirect('login/index/3','refresh');

	}






}


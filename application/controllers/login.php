<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("empleado_model");
	}


	public function index()
	{
		$data['msg'] = $this->uri->segment(3);
		if ($this->session->userdata('idEmpleado')) {
			redirect('login/panel', 'refresh');
		} else {
			$this->load->view('login/login', $data);
		}
	}

	public function validarUsuario()
	{
		$usuario = ($this->input->post('txtUsuario'));
		$password = ($this->input->post('txtPassword'));


		$consulta = $this->empleado_model->validar($usuario, $password);
		// print_r($consulta);
		if ($consulta->num_rows() > 0) {
			foreach ($consulta->result() as $row) {
				$this->session->set_userdata('idEmpleado', $row->idEmpleado);
				$this->session->set_userdata('foto', $row->foto);
				$this->session->set_userdata('nombres', $row->nombres);
				$this->session->set_userdata('nombreCompleto', $row->nombres . " " . $row->primerApellido . " " . $row->segundoApellido);
				$this->session->set_userdata('primerApellido', $row->primerApellido);
				$this->session->set_userdata('segundoApellido', $row->segundoApellido);
				$this->session->set_userdata('tipo', $row->tipo);
				//redirect('login/panel','refresh');// sesion exitosa

				echo "true";
			}
		} else {
			//redirect('login/index/1','refresh'); // del ing Pavel
			//redirect('login','refresh');
			header("location: login?fallo=true");
			//$data['msg']="Error de entrada";
			//$this->load->view('login/login',$data);
		}
	}

	public function panel()
	{
		if ($this->session->userdata('idEmpleado')) {
			// $this->load->view('inic/header');
			// $this->load->view('tablero/index');
			// $this->load->view('inic/footer');
			redirect('producto', 'refresh');
		} else {
			//$this->load->view('loginform',$data);
			//redirect('login/index/2','refresh');
			redirect('login', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
		//redirect('login/index/3','refresh');

	}
}

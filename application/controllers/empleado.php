<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("empleado_model");
	}


	public function index()
	{
		$listaEmpleados = $this->empleado_model->listarEmpleado();

		$data['empleado'] = $listaEmpleados;

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('empleado/index', $data);
		$this->load->view('layouts/footer');
	}

	public function insert()
	{
		$data['nombres'] = $_POST['txtNombres'];
		$data['primerApellido'] = $_POST['txtPrimerApellido'];
		$data['segundoApellido'] = $_POST['txtSegundoApellido'];
		$data['fechaNacimiento'] = $_POST['txtFechaNacimiento'];
		$data['carnetIdentidad'] = $_POST['txtCarnetIdentidad'];
		$data['sexo'] = $_POST['cbxSexo'];
		$data['telefono'] = $_POST['txtTelefono'];
		$data['email'] = $_POST['txtEmail'];
		$data['usuario'] = $_POST['txtUsuario'];
		$data['password'] = $_POST['txtPassword'];
		$data['tipo'] = $_POST['cbxTipo'];

		$this->empleado_model->insert($data);
		redirect('empleado', 'refresh');
	}


	public function delete($id)
	{
		$data = array('estado' => 0);
		$this->empleado_model->delete($id, $data);
		redirect('empleado', 'refresh');
	}

	public function cambiarAcceso($id, $acceso)
	{

		if($acceso=="1")
		{
			$data = array('acceso' => "0");
			$this->empleado_model->update($id, $data);
			redirect('empleado', 'refresh');

		}else{
			$data = array('acceso' => "1");
			$this->empleado_model->update($id, $data);
			redirect('empleado', 'refresh');

		}
	}

	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getEmpleado'] = $this->empleado_model->get($id);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('empleado/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			//regresar a index enviar parametro
			redirect('');
		}
	}

	public function update()
	{
		$id = $_POST['txtIdEmpleado'];
		$data['nombres'] = $_POST['txtNombres'];
		$data['primerApellido'] = $_POST['txtPrimerApellido'];
		$data['segundoApellido'] = $_POST['txtSegundoApellido'];
		$data['fechaNacimiento'] = $_POST['txtFechaNacimiento'];
		$data['carnetIdentidad'] = $_POST['txtCarnetIdentidad'];
		$data['sexo'] = $_POST['cbxSexo'];
		$data['telefono'] = $_POST['txtTelefono'];
		$data['email'] = $_POST['txtEmail'];
		$data['usuario'] = $_POST['txtUsuario'];
		$data['password'] = $_POST['txtPassword'];
		$data['tipo'] = $_POST['cbxTipo'];

		$this->empleado_model->update($id, $data);
		redirect('empleado', 'refresh');
	}

	



	public function perfil()
	{
		$idUsuario = $this->session->userdata('idEmpleado');
		$data["usuario"] = $this->empleado_model->get($idUsuario);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('empleado/perfil', $data);
		$this->load->view('layouts/footer');
	}

	public function configuracion()
	{
		$idUsuario = $this->session->userdata('idEmpleado');
		$data["usuario"] = $this->empleado_model->get($idUsuario);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('empleado/configuracion', $data);
		$this->load->view('layouts/footer');
	}

	public function updateUsuario()
	{
		$id = $_POST['txtIdEmpleado'];
		$data['usuario'] = $_POST['txtUsuario'];
		$data['password'] = $_POST['txtPassword'];
		$verificador = $_POST['verificador'];



		if ($verificador == "con") {
			// // Configura la biblioteca de carga de archivos
			$config['upload_path'] = './fotosUsuario'; // Directorio donde deseas guardar la imagen
			$nombreArchivoNuevo = $id . ".png";

			$config['file_name'] = $nombreArchivoNuevo;

			$config['allowed_types'] = 'png'; // Tipos de archivo permitidos
			$config['max_size'] = 10048; // Tamaño máximo en kilobytes (10MB en este ejemplo)

			$this->load->library('upload', $config);

			$direccion = "./fotosUsuario/" . $nombreArchivoNuevo;
			if (file_exists($direccion)) {
				unlink($direccion);
				// echo"ead";
			}

			if (!$this->upload->do_upload('actualizacionImgFile')) {
				$data['error'] = $this->upload->display_errors();
				$this->empleado_model->update($id, $data);
				redirect('producto', 'refresh');


				// 	// Maneja el error como desees, por ejemplo, mostrar un mensaje al usuario
			} else {
				// 	// La imagen se cargó correctamente
				// 	// Actualiza la fila en la tabla con el nuevo nombre de la imagen
				$data['foto'] = $nombreArchivoNuevo;
				$this->upload->data();
				$this->empleado_model->update($id, $data);
				redirect('login/logout');




				// 	// Ahora tienes todos los datos, incluida la imagen
				// 	// Puedes insertar $data en la base de datos u realizar otras operaciones necesarias
			}
		} else {

			$this->empleado_model->update($id, $data);
			redirect('login/logout');

		}
	}
	/* funciones que pordrian servir  
	function buscarIDiden(){
		$ID=$_POST['idj'];

		$result=$this->clienteModel->buscarIDiden($ID);
		echo json_encode($result);
	}

*/
}

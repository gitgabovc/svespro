<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("usuarios_model");
		$this->load->model("permisos_model");
	}


	public function index()
	{
		$listaUsuarios=$this->usuarios_model->listarUsuarios();
		$listaPermisos=$this->permisos_model->listarPermisos();
		
		$data['usuarios']=$listaUsuarios;
		$data['permisos']=$listaPermisos;

		$this->load->view('inic/header');
		$this->load->view('usuarios/index',$data);
		$this->load->view('inic/footer');
		
	}

	public function delete($id){
			
		$this->usuarios_model->deleteUsuario($id);
		redirect('usuarios','refresh');
		
	}

	public function insert(){
		$data['nombre']=$_POST['txtNombre'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];
		$data['tipoDocumento']=$_POST['cbxTipoDocumento'];
		$data['numDocumento']=$_POST['txtNumDocumento'];
		$data['direccion']=$_POST['txtDireccion'];
		$data['telefono']=$_POST['txtTelefono'];
		$data['email']=$_POST['txtEmail'];
		$data['cargo']=$_POST['cbxCargo'];
		$data['login']=$_POST['txtLogin'];
		$data['clave']= md5($_POST['txtClave']);

		//recuperacion de datos de la imagen
		$nombreImagen=$_FILES['imagen']['name'];
		$rutaOrigen=$_FILES['imagen']['tmp_name'];
		$rutaDestino='materialart/assets/images/users/'.$nombreImagen;
		copy($rutaOrigen,$rutaDestino);
		$data['imagen']=$rutaDestino;

		//array
		$idPermiso=$_POST['checkIdPermiso'];

		$this->usuarios_model->insertUsuario($data,$idPermiso);
		redirect('usuarios/index','refresh');
	}

	public function Edit($id=NULL){
		//funcion GET
		if ($id!=NULL) {
			//mostrar datos
			$data['getUsuario'] = $this->usuarios_model->GetUsuario($id);
			$listaPermisosUsu=$this->permisos_model->listarPermisosUsu($id);
			$listaPermisos=$this->permisos_model->listarPermisos();

			$data['permisosUsu']=$listaPermisosUsu;
			$data['permisos']=$listaPermisos;
		
			$this->load->view('inic/header');
			$this->load->view('usuarios/edit',$data);
			$this->load->view('inic/footer');
		}
		else
		{
			//regresar a index enviar parametro
			redirect('');
		}
	}

	public function update(){
		$id=$_POST['txtIdUsuario'];
		$data['nombre']=$_POST['txtNombre'];
		$data['primerApellido']=$_POST['txtPrimerApellido'];
		$data['segundoApellido']=$_POST['txtSegundoApellido'];
		$data['tipoDocumento']=$_POST['cbxTipoDocumento'];
		$data['numDocumento']=$_POST['txtNumDocumento'];
		$data['direccion']=$_POST['txtDireccion'];
		$data['telefono']=$_POST['txtTelefono'];
		$data['email']=$_POST['txtEmail'];
		$data['cargo']=$_POST['cbxCargo'];
		$data['login']=$_POST['txtLogin'];
		$data['clave']= md5($_POST['txtClave']);
		//array
		$idPermiso=$_POST['checkIdPermiso'];
		
		$this->usuarios_model->updateUsuario($id,$data,$idPermiso);
		redirect('usuarios/index','refresh');
	}


}


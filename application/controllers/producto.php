<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("producto_model");
		$this->load->model("color_model");
		$this->load->model("talla_model");
		$this->load->model("material_model");
	}


	public function index()
	{
		$listaProductos = $this->producto_model->listarProducto();
		$listaCategoria = $this->producto_model->listarCategoria();
		$listaMarca = $this->producto_model->listarMarca();
		$listaColores = $this->color_model->listarColor();
		$listaTalla = $this->talla_model->listarTallas();
		$listaMaterial = $this->material_model->listarMaterial();
		$data['producto'] = $listaProductos;
		$data['categorias'] = $listaCategoria;
		$data['marcas'] = $listaMarca;
		$data['color'] = $listaColores;
		$data['tallas'] = $listaTalla;
		$data['materiales'] = $listaMaterial;
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('producto/index', $data);
		$this->load->view('layouts/footer');
	}



	public function inserta()
	{
		$data['codigo'] = $_POST['txtCodigo'];
		$data['nombreProducto'] = $_POST['txtNombreProducto'];
		$data['precioNormal'] = $_POST['txtPrecioNormal'];
		$data['stock'] = $_POST['txtStock'];
		$data['descripcion'] = $_POST['txtDescripcion'];
		$data['idCategoria'] = $_POST['cbxCategoria'];
		$data['idMarca'] = $_POST['cbxMarca'];
		$data['idColor'] = $_POST['cbxColor'];
		$data['idMaterial'] = $_POST['cbxMaterial'];
		$data['idTalla'] = $_POST['cbxTalla'];
		$this->producto_model->insert($data);
		redirect('producto/index');
	}

	public function insert()
	{
		// Recopila los datos del formulario
		$data = array(
			'codigo' => $_POST['txtCodigo'],
			'nombreProducto' => $_POST['txtNombreProducto'],
			'precioNormal' => $_POST['txtPrecioNormal'],
			'stock' => $_POST['txtStock'],
			'descripcion' => $_POST['txtDescripcion'],
			'idCategoria' => $_POST['cbxCategoria'],
			'idMarca' => $_POST['cbxMarca'],
			'idColor' => $_POST['cbxColor'],
			'idMaterial' => $_POST['cbxMaterial'],
			'idTalla' => $_POST['cbxTalla'],
		);

		// Inserta los datos en la base de datos y obtén el ID generado automáticamente
		$idInsertado = $this->producto_model->insert($data);

		// // Configura la biblioteca de carga de archivos
		$config['upload_path'] = './fotosProducto'; // Directorio donde deseas guardar la imagen
		$nombreArchivoNuevo = $idInsertado . ".png";

		$config['file_name'] = $nombreArchivoNuevo;

		$config['allowed_types'] = 'png'; // Tipos de archivo permitidos
		$config['max_size'] = 10048; // Tamaño máximo en kilobytes (10MB en este ejemplo)

		$this->load->library('upload', $config);



		// Obtén la extensión del archivo
		// $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

		// Genera un nuevo nombre de archivo basado en el ID insertado y la extensión

		// Comprueba si el archivo ya existe y elimina el archivo anterior
		$direccion = "./fotosProducto/" . $nombreArchivoNuevo;
		if (file_exists($direccion)) {
			unlink($direccion);
			// echo"ead";
		}

		// // Comprueba si se cargó la imagen correctamente
		if (!$this->upload->do_upload('productfile')) {
			$ata['error'] = $this->upload->display_errors();
			$this->producto_model->actualizarNombreImagen($idInsertado, $ata);

			echo "no";
			// 	// Maneja el error como desees, por ejemplo, mostrar un mensaje al usuario
		} else {
			// 	// La imagen se cargó correctamente
			// 	// Actualiza la fila en la tabla con el nuevo nombre de la imagen
			$ata['foto'] = $nombreArchivoNuevo;
			$this->upload->data();
			$this->producto_model->actualizarNombreImagen($idInsertado, $ata);

			echo "si";

			// 	// Ahora tienes todos los datos, incluida la imagen
			// 	// Puedes insertar $data en la base de datos u realizar otras operaciones necesarias
		}

		// Redirige a la página deseada después de la inserción y actualización
		//redirect('producto/index');
	}




	public function delete($id)
	{
		$data = array('estado' => 0);
		$this->producto_model->delete($id, $data);
		redirect('producto', 'refresh');
	}


	public function edit($id = NULL)
	{
		//funcion GET
		if ($id != NULL) {
			//mostrar datos
			$data['getProducto'] = $this->producto_model->get($id);
			$listaCategoria = $this->producto_model->listarCategoria();
			$listaMarca = $this->producto_model->listarMarca();
			$listaColores = $this->color_model->listarColor();
			$listaTalla = $this->talla_model->listarTallas();
			$listaMaterial = $this->material_model->listarMaterial();
			$data['color'] = $listaColores;
			$data['tallas'] = $listaTalla;
			$data['materiales'] = $listaMaterial;
			$data['categorias'] = $listaCategoria;
			$data['marcas'] = $listaMarca;
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('producto/edit', $data);
			$this->load->view('layouts/footer');
		} else {
			//regresar a index enviar parametro
			redirect('');
		}
	}


	public function update()
	{
		$id = $_POST['txtIdProducto'];
		$data['codigo'] = $_POST['txtCodigo'];
		$data['nombreProducto'] = $_POST['txtNombreProducto'];
		$data['precioNormal'] = $_POST['txtPrecioNormal'];
		$data['stock'] = $_POST['txtStock'];
		$data['descripcion'] = $_POST['txtDescripcion'];
		$data['idCategoria'] = $_POST['cbxCategoria'];
		$data['idMarca'] = $_POST['cbxMarca'];
		$data['idColor'] = $_POST['cbxColor'];
		$data['idMaterial'] = $_POST['cbxMaterial'];
		$data['idTalla'] = $_POST['cbxTalla'];
		$verificador = $_POST['verificador'];


		if ($verificador == "con") {
			// // Configura la biblioteca de carga de archivos
			$config['upload_path'] = './fotosProducto'; // Directorio donde deseas guardar la imagen
			$nombreArchivoNuevo = $id . ".png";

			$config['file_name'] = $nombreArchivoNuevo;

			$config['allowed_types'] = 'png'; // Tipos de archivo permitidos
			$config['max_size'] = 10048; // Tamaño máximo en kilobytes (10MB en este ejemplo)

			$this->load->library('upload', $config);

			$direccion = "./fotosProducto/" . $nombreArchivoNuevo;
			if (file_exists($direccion)) {
				unlink($direccion);
				// echo"ead";
			}

			if (!$this->upload->do_upload('actualizacionImgFile')) {
				$data['error'] = $this->upload->display_errors();
				$this->producto_model->update($id, $data);
				redirect('producto', 'refresh');
	
				
				// 	// Maneja el error como desees, por ejemplo, mostrar un mensaje al usuario
			} else {
				// 	// La imagen se cargó correctamente
				// 	// Actualiza la fila en la tabla con el nuevo nombre de la imagen
				$data['foto'] = $nombreArchivoNuevo;
				$this->upload->data();
				$this->producto_model->update($id, $data);
				redirect('producto', 'refresh');
	
	
				
	
				// 	// Ahora tienes todos los datos, incluida la imagen
				// 	// Puedes insertar $data en la base de datos u realizar otras operaciones necesarias
			}
		

		}else
		{

			$this->producto_model->update($id, $data);
			redirect('producto', 'refresh');
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

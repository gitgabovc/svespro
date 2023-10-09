<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Compra_model extends CI_Model
{


	public function listaCompras()
	{



		$this->db->select('compra.*, proveedor.nombreProveedor, empleado.nombres as nombreEmpleado, empleado.primerApellido as primerApellidoEmpleado, , empleado.segundoApellido as segundoApellidoEmpleado');
		$this->db->from('compra');
		$this->db->join('proveedor', 'proveedor.idProveedor = compra.idProveedor');
		$this->db->join('empleado', 'empleado.idEmpleado = compra.idEmpleado');
		$this->db->where('compra.estado', 1);
		$this->db->order_by('idCompra', 'desc');

		return $this->db->get(); //devolucion del resultado de la consulta

	}

	public function listaProveedores()
	{

		$this->db->select("*"); //select*
		$this->db->from('proveedor'); //tabla
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function listaProductos()
	{
		$this->db->select('producto.*, marca.nombreMarca, categoria.nombreCategoria, tipocolor.color, material.material, talla.talla');
		$this->db->from('producto');
		$this->db->join('marca', 'marca.idMarca = producto.idMarca');
		$this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
		$this->db->join('tipocolor', 'tipocolor.idColor = producto.idColor');
		$this->db->join('tipoMaterial material', 'material.idTipoMaterial = producto.idMaterial');
		$this->db->join('tipotalla talla', 'talla.idTalla = producto.idTalla');
		return $this->db->get();
	}

	public function buscar($palabra)
	{
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->like('nombres', $palabra);
		$this->db->or_like('primerApellido', $palabra);
		$this->db->or_like('segundoApellido', $palabra);


		return $this->db->get();
	}
	public function buscarProducto($palabra)
	{
		$this->db->select('*');
		$this->db->from('producto');
		$this->db->like('codigo', $palabra);
		$this->db->or_like('nombreProducto', $palabra);


		return $this->db->get();
	}




	public function insert($data)
	{
		$this->db->insert('venta', $data);
	}
	public function Reg_venta($data)
	{
		$this->db->insert('detalleventa', $data);
	}
	public function detallesCliente($id) //select
	{
		$this->db->select('venta.idVenta, c.nombres, c.primerApellido, c.segundoApellido, c.nit, venta.precioUnitario, venta.fechaRegistro as vf'); //select *
		$this->db->from('cliente c');
		$this->db->where('venta.idVenta', $id);
		$this->db->join('venta', 'venta.idCliente=c.idCliente');
		// $this->db->order_by(1);
		return $this->db->get()->result(); //devolucion del resultado de la consulta
	}


	public function delete($id, $data)
	{
		$this->db->where('idCompra', $id);
		$this->db->update('compra', $data);
	}
	public function ultimoIdVenta() //select
	{
		$this->db->select('*'); //select *
		$this->db->from('venta');
		$this->db->where('venta.estado', '1');
		$this->db->order_by('idVenta', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result(); //devolucion del resultado de la consulta
	}

	public function getCompra($id)
	{

		$this->db->select('*');
		$this->db->from('compra');
		$this->db->where('idCompra', $id);
		return $this->db->get();
	}

	public function getDetalleCompra($id)
	{

		$this->db->select('detallecompra.*, producto.nombreProducto, tipotalla.talla AS nombreTalla, marca.nombreMarca, tipocolor.color AS nombreColor, tipomaterial.material AS nombreMaterial, categoria.nombreCategoria');
		$this->db->from('detallecompra');
		$this->db->join('producto', 'producto.idProducto = detallecompra.idProducto');
		$this->db->join('tipotalla', 'tipotalla.idTalla = producto.idTalla');
		$this->db->join('marca', 'marca.idMarca = producto.idMarca');
		$this->db->join('tipocolor', 'tipocolor.idColor = producto.idColor');
		$this->db->join('tipomaterial', 'tipomaterial.idTipoMaterial = producto.idMaterial');
		$this->db->join('categoria', 'categoria.idCategoria = producto.idCategoria');
		$this->db->where('detallecompra.idCompra', $id); // Cambia 35 por el valor deseado para idCompra

		return $this->db->get();
	}

	public function listaDetalleCompraPorIdSinJoin($id)
	{

		$this->db->select('*');
		$this->db->from('detallecompra');
		$this->db->where('detallecompra.idCompra', $id); // Cambia 35 por el valor deseado para idCompra

		return $this->db->get();
	}

	public function listaventa($id) //select
	{
		$this->db->select('producto.nombreProducto ,cantidad,precioTotal'); //select *
		$this->db->from('detalleventa dv');
		$this->db->where('dv.idVenta', $id);
		$this->db->join('producto', 'dv.idProducto = producto.idProducto');
		return $this->db->get()->result(); //devolucion del resultado de la consulta
	}

	public function update($id, $data)
	{
		$this->db->where('idCategoria', $id);
		$this->db->update('categoria', $data);
	}
	/*
	public function buscarID($ID)
	{
		$this->db->like('IDjugador',$ID);
		$this->db->or_like('nombre',$ID);
		$this->db->or_like('usuario',$ID);
		$query = $this->db->get('cliente');
		return $query->result();
	}

	public function buscarIDiden($ID)
	{
		$this->db->select('*');
		$this->db->from('cliente c');
		$this->db->where('c.IDjugador', $ID);
		$this->db->where('c.estado', 1);
		return $this->db->get()->result();
	}

*/
	public function insertCompra($totalCompra, $descripcion, $idProveedor, $idEmpleado)
	{
		$data = array(
			'totalCompra' => $totalCompra,
			'descripcion' => $descripcion,
			'idProveedor' => $idProveedor,
			'idEmpleado' => $idEmpleado,


		);
		$this->db->insert('compra', $data);
		return $this->db->insert_id();
	}

	public function insertDetalleCompra($idCompra, $idProducto, $cantidad, $precioCompra, $precioVenta)
	{
		$data = array(
			'idCompra' => $idCompra,
			'idProducto' => $idProducto,
			'cantidad' => $cantidad,
			'precioCompra' => $precioCompra,
			'precioVenta' => $precioVenta
		);
		$this->db->insert('detallecompra', $data);
	}

	public function listarProductoNombre($tu_id_de_compra)
	{

		$this->db->select('detallecompra.*, producto.nombreProducto as nombre_producto');
		$this->db->from('detallecompra');
		$this->db->join('producto', 'producto.idProducto = detallecompra.idProducto');
		$this->db->where('detallecompra.idCompra', $tu_id_de_compra);

		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function actualizarStock($id, $cantidad, $cambio=false)
	{
		if ($cambio) {
			$this->db->set('stock', 'stock - ' . $cantidad, false);
			
		}else {
			$this->db->set('stock', 'stock + ' . $cantidad, false);
		}
		$this->db->where('idProducto', $id);
		$this->db->update('producto');
	}

	public function actualizarCompra($costoTotal, $descripcion, $idProveedor, $idCompra) {
        // Datos a actualizar
		$fechaActual = date("Y-m-d");
        $data = array(
            'totalCompra' => $costoTotal,
            'descripcion' => $descripcion,
            'idProveedor' => $idProveedor,
			'fechaActualizacion' => $fechaActual
        );

        // Realizar la actualización en la tabla compra
        $this->db->where('idCompra', $idCompra);
        $this->db->update('compra', $data);
    }

	public function eliminarDetalleCompraPorId($idCompra)
	{
        $this->db->where('idCompra', $idCompra);
        $this->db->delete('detallecompra');
    }
	
	public function eliminarCompraPorId($idCompra)
	{
        $this->db->where('idCompra', $idCompra);
        $this->db->delete('compra');
    }


}

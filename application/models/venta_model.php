<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Venta_model extends CI_Model
{


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


	public function insertVenta($ventaTotal, $descripcion, $idCliente, $idEmpleado)
	{
		$data = array(
			'precioUnitario' => $ventaTotal,
			'descripcion' => $descripcion,
			'idCliente' => $idCliente,
			'idEmpleado' => $idEmpleado,


		);
		$this->db->insert('venta', $data);
		return $this->db->insert_id();
	}

	public function insertDetalleVenta($idVenta, $idProducto, $cantidad, $precioVenta)
	{
		$data = array(
			'idVenta' => $idVenta,
			'idProducto' => $idProducto,
			'cantidad' => $cantidad,
			'precioTotal' => $precioVenta
		);
		$this->db->insert('detalleventa', $data);
	}

	public function lista()
	{


		$this->db->select('v.idVenta as idV,cliente.nombres as cNombre,cliente.primerApellido as cPA,cliente.segundoApellido as cSA,empleado.nombres as eNombre,empleado.primerApellido as ePA,empleado.segundoApellido as eSA  , precioUnitario, v.fechaRegistro as fr'); //select *
		$this->db->from('venta v');
		$this->db->join('cliente', 'cliente.idCliente=v.idCliente');
		$this->db->join('empleado', 'empleado.idEmpleado=v.idEmpleado');
		$this->db->order_by('v.idVenta', "desc");
		return $this->db->get(); //devolucion del resultado de la consulta


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
		$this->db->where('idCategoria', $id);
		$this->db->update('categoria', $data);
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

	public function get($id)
	{

		$this->db->select('*');
		$this->db->from('detalleventa');
		$this->db->where('idVenta', $id);
		return $this->db->get()->result();
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
}

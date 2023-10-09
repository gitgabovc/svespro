<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_model extends CI_Model
{
 
	public function listarProveedores()
	{

		$this->db->select("*"); //select*
		$this->db->from('proveedor'); //tabla
		$this->db->where('estado', 1); //tabla
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function insert($data)
	{
		$this->db->insert('proveedor',$data);
	}


	public function delete($id)
	{	
		$this->db->where('idProveedor',$id);
		$this->db->delete('proveedor');
	}

	
	public function get($id)
	{

		$this->db->select('*');
		$this->db->from('proveedor');
		$this->db->where('idProveedor', $id);
		return $this->db->get();
	}
	
	public function update($id, $data)
	{
		$this->db->where('idProveedor',$id);
		$this->db->update('proveedor',$data);

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
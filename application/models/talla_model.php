<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Talla_model extends CI_Model
{
 
	public function listarTallas()
	{

		$this->db->select("*"); //select*
		$this->db->from('tipotalla'); //tabla
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function insert($data)
	{
		$this->db->insert('tipotalla',$data);
	}


	public function delete($id)
	{	
		$this->db->where('idTalla',$id);
		$this->db->delete('tipotalla');
	}

	
	public function get($id)
	{

		$this->db->select('*');
		$this->db->from('tipotalla t');
		$this->db->where('t.idTalla', $id);
		return $this->db->get();
	}
	
	public function update($id, $data)
	{
		$this->db->where('idTalla',$id);
		$this->db->update('tipotalla',$data);

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
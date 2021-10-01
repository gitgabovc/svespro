<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personas_model extends CI_Model
{
	public function listarpersonas()
	{
		$this->db->select('*');
		$this->db->from('persona p');
		$this->db->where('p.estado','1');
		return $this->db->get();
	}

	public function insertPersona($data)
	{
		$this->db->insert('persona',$data);
	}

	public function deletePersona($id)
	{	
		$data = array('estado' => 0 );
		$this->db->where('idPersona',$id);
		$this->db->update('persona',$data);
	}

	public function GetPersona($id)
	{

		$this->db->select('*');
		$this->db->from('persona');
		$this->db->where('idPersona',$id);
		return $this->db->get();
	}

	public function updatePersona($id, $data)
	{
		$this->db->where('idPersona',$id);
		$this->db->update('persona',$data);

	}

	public function buscarCi($ci)
	{
		$this->db->like('nombre',$ci);
		$query = $this->db->get('persona');
		return $query->result();

		/*
		$this->db->select('*');
		$this->db->from('persona p');
		$this->db->where('p.numDocumento',$ci);
		return $this->db->get();
		*/
	}

	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulos_model extends CI_Model
{
 
	public function listarArticulo()
	{
		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('a.estado','1');
		return $this->db->get();
	}

	public function listarEmpresa()
	{
		$this->db->select('*');
		$this->db->from('empresa');
		return $this->db->get();
	}


	public function deleteArticulo($id)
		{	
			$data = array('estado' => 0 );
			$this->db->where('idArticulo',$id);
			$this->db->update('articulo',$data);
		}

	public function GetArticulo($id)
	{

		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('a.idArticulo',$id);
		return $this->db->get();
	}

	public function updateArticulo($id, $data)
	{
		$this->db->where('idArticulo',$id);
		$this->db->update('articulo',$data);

	}

	public function insertArticulo($data)
	{
		$this->db->insert('articulo',$data);
	}

	public function buscarArticuloRep($nombre)
	{
		$this->db->select('*');
		$this->db->from('articulo');
		$this->db->where('nombre',$nombre);
		return $this->db->get();
	}




	

	

 

	
	
}
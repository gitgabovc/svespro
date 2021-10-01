<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos_model extends CI_Model
{

	

	public function listarPermisos()
	{
		$this->db->select('*');
		$this->db->from('permiso p');
		return $this->db->get();
	}

	public function listarPermisosUsu($id)
	{
		$this->db->select('*');
		$this->db->from('usuario u');
		$this->db->join('usuariopermiso s','u.idUsuario=s.idUsuario');
		$this->db->join('permiso p','s.idPermiso=p.idPermiso');
		$this->db->where('u.idUsuario',$id);
		return $this->db->get();
	}

// Borrar
	public function GetUsuario($id)
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('idUsuario',$id);
		return $this->db->get();
	}

	
	
	
}
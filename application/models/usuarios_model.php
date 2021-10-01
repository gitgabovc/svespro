<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{

	public function validar($login,$clave)
	{
		$this->db->select('*');
		$this->db->from('usuario u');
		$this->db->where('u.login',$login);
		$this->db->where('u.clave',$clave);
		$this->db->where('u.estado',1);
		return $this->db->get();

	}

	public function listarUsuarios()
	{
		$this->db->select('*');
		$this->db->from('usuario u');
		$this->db->where('u.estado','1');
		return $this->db->get();
	}

	public function deleteUsuario($id)
	{	
		$data = array('estado' => 0 );
		$this->db->where('idUsuario',$id);
		$this->db->update('usuario',$data);
	}

	public function insertUsuario($data,$idPermiso)
	{
		$this->db->insert('usuario',$data);

		$ultIdUsuario = $this->db->insert_id();

		$numE=count($idPermiso);

		for ($i=0; $i < $numE; $i++) { 
		 	$data = array(
			'idUsuario' => $ultIdUsuario,
			'idPermiso' => $idPermiso[$i]
			);
			$this->db->insert('usuariopermiso',$data);
		 }

	}

	public function GetUsuario($id)
	{
		$this->db->select('*');
		$this->db->from('usuario u');
		//$this->db->join('usuariopermiso s','u.idUsuario=s.idUsuario');
		//$this->db->join('permiso p','s.idPermiso=p.idPermiso');
		$this->db->where('u.idUsuario',$id);
		return $this->db->get();
	}

	public function updateUsuario($id, $data, $idPermiso)
	{
		$this->db->where('idUsuario', $id);
		$this->db->update('usuario', $data);

		// elminar del usuariopermiso los permisos del usuario
		$this->db->where('idUsuario', $id);
		$this->db->delete('usuariopermiso');

		$numE=count($idPermiso);

		 for ($i=0; $i < $numE; $i++) { 
		 	$data = array(
			'idUsuario' => $id,
			'idPermiso' => $idPermiso[$i]
			);
			$this->db->insert('usuariopermiso',$data);
		 }

	}
 
	
	
	
}
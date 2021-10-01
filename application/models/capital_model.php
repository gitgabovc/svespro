<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capital_model extends CI_Model
{
 
	public function listarMovimientos()
	{
		$this->db->select('*');
		$this->db->from('movimientocapital m');
		$this->db->join('usuario u','m.idUsuario=u.idUsuario');
		$this->db->order_by('m.idMovimientoCapital','desc');
		return $this->db->get();
	}

	public function insertMovimiento($data)
	{
		$this->db->insert('movimientocapital',$data);
	}



	
	
}
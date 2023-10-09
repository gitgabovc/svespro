<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado_model extends CI_Model
{
 
	public function listarEmpleado()
	{

		$this->db->select("idEmpleado,foto,nombres,primerApellido,segundoApellido,fechaNacimiento,carnetIdentidad,sexo,telefono,email, DATE_FORMAT((fechaRegistro),('%d/%m/%Y')) as fechaRegistro, DATE_FORMAT((fechaActualizacion),('%d/%m/%Y')) as fechaActualizacion, usuario, password, tipo, acceso"); //select*
		$this->db->from('empleado');
		$this->db->where('estado','1');
		
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function validar($usuario, $password)
	{

		$this->db->select("*"); //select*
		$this->db->from('empleado');
		$this->db->where('usuario',$usuario);
		$this->db->where('password',$password);
		$this->db->where('estado',"1");
		$this->db->where('acceso',"1");
		
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function insert($data)
	{
		$this->db->insert('empleado',$data);
	}

	public function delete($id,$data)
	{	
		$this->db->where('idEmpleado',$id);
		$this->db->update('empleado',$data);
	}
	
	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('empleado');
		$this->db->where('idEmpleado', $id);
		return $this->db->get();
	}
	
	public function update($id, $data)
	{
		$this->db->where('idEmpleado',$id);
		$this->db->update('empleado',$data);
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
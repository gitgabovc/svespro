<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precios_model extends CI_Model
{
	public function listarpersonas()
	{
		$this->db->select('*');
		$this->db->from('persona p');
		$this->db->where('p.estado','1');
		return $this->db->get();
	}

	public function listarArticulo()
	{
		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('a.estado','1');
		return $this->db->get();
	}

	public function listarPreciosPer($id)
	{
		$this->db->select('*');
		$this->db->from('precio p');
		$this->db->join('articulo a','p.idArticulo=a.idArticulo');
		$this->db->where('p.idPersona',$id);
		return $this->db->get()->result();

	}




// borrar
	public function insertPrecio($id, $idArticulo, $precio, $precioCredito,$precioPromo)
	{
		// elminar del precios usuario si las hubiera, para evitar duplicidad
		$this->db->where('idPersona', $id);
		$this->db->delete('precio');

		$numE=count($idArticulo);

		 for ($i=0; $i < $numE; $i++) { 
		 	$data = array(
			'precio' => $precio[$i],
			'precioCredito' => $precioCredito[$i],
			'precioPromo' => $precioPromo[$i],
			'idPersona' => $id,
			'idArticulo' => $idArticulo[$i]
			);
			$this->db->insert('precio',$data);
		 }

		
	}

	

	public function GetPersona($id)
	{

		$this->db->select('*');
		$this->db->from('persona');
		$this->db->where('idPersona',$id);
		return $this->db->get();
	}

	public function updatePrecio($idPrecio,$precio,$precioCredito,$precioPromo)
	{
		$numE=count($idPrecio);


		 for ($i=0; $i < $numE; $i++) { 
		 	$data = array(
			'precio' => $precio[$i],
			'precioCredito' => $precioCredito[$i],
			'precioPromo' => $precioPromo[$i]
			);
			$this->db->where('idPrecio',$idPrecio[$i]);
			$this->db->update('precio',$data);
		 }


		

	}

	public function buscarCi($ci)
	{
		$this->db->like('numDocumento',$ci);
		$query = $this->db->get('persona');
		return $query->result();

		/*
		$this->db->select('*');
		$this->db->from('persona p');
		$this->db->where('p.numDocumento',$ci);
		return $this->db->get();
		*/
	}


	public function diapromo()
	{
		
		$query=$this->db->select('activa')
						->from('diapromo')
						->get();
		return $query->result();	
	}

	function udateDiaPromo($promoModif)
	{
		$data = array(
			'activa' => $promoModif
			);

		$this->db->update('diapromo',$data);
	}

	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditos_model extends CI_Model
{


	public function listarCreditos()
	{
		$this->db->select("p.idPersona, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, p.saldoDeuda ");
		$this->db->from('persona p');
		$this->db->where('p.estado',1);
		$this->db->where('p.saldoDeuda >0');
		return $this->db->get();
	}

	public function updateCredito($id, $data)
	{
		$this->db->where('idPersona',$id);
		$this->db->update('persona',$data);

	}

	public function insertHistorial($data)
	{
		$this->db->insert('historialcredito',$data);
	}

	public function listarPagosCredito($id)
	{
		$this->db->select("h.idHistorialCredito, h.saldoAnterior, h.aCuenta, h.saldoActual, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, DATE_FORMAT((h.fecha),('%d/%m/%Y')) as fecha");
		$this->db->from('historialcredito h');
		$this->db->join('persona p','h.idPersona=p.idPersona');
		$this->db->where('h.idPersona',$id);
		$this->db->order_by('h.idHistorialCredito', 'desc');
		$this->db->limit('20');
		return $this->db->get();
	}


/*
	public function listarCreditos()
	{
		$this->db->select("c.idCredito, c.montoCredito, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, v.idVenta, DATE_FORMAT((v.fechaHora),('%d/%m/%Y')) as fechaHora");
		$this->db->from('credito c');
		$this->db->join('persona p','c.idPersona=p.idPersona');
		$this->db->join('venta v','c.idVenta=v.idVenta');
		$this->db->where('c.estado',1);
		return $this->db->get();
	}
*/
	public function deleteCredito($id,$data)
		{	
			$data1 = array('saldoDeuda' => 0 );
			$this->db->where('idPersona',$id);
			$this->db->update('persona',$data1);

			$this->db->insert('historialcredito',$data);
		}

	
	
	
}
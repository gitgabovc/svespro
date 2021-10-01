<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras_model extends CI_Model
{
 

	public function listarCompra()
	{
		$this->db->select("c.idCompra, DATE_FORMAT((c.fechaHora),('%d/%m/%Y')) as fecha, CONCAT((u.nombre),(' '),(u.primerApellido)) As usuario,c.totalCompra,c.estado");
		$this->db->from('compra c');
		$this->db->join('usuario u','c.idUsuario=u.idUsuario');
		$this->db->order_by('c.idCompra', 'DESC');
		$this->db->where('c.estado','1');
		return $this->db->get();
	}




	public function insertCompra($data,$idArticulo,$cantidad,$precioCompra)
	{
		$this->db->insert('compra',$data);

		$ultIdCompra = $this->db->insert_id();

		$numE=count($idArticulo);


		 for ($i=0; $i < $numE; $i++) { 
		 	$data = array(
			'idCompra' => $ultIdCompra,
			'idArticulo' => $idArticulo[$i], 
			'cantidad' => $cantidad[$i],
			'precioCompra' => $precioCompra[$i]
			);
			$this->db->insert('detallecompra',$data);
		 } 

	}

	public function ultimoIdCompra(){
		
		$query  = $this->db->select('idCompra')
                   ->from('compra')
                   ->limit(1) // Maximum 10 rows 
                   ->order_by('idCompra','DESC') // Order data descending 
                   ->get();
		return $query->result();
		

	}

	

	public function deleteCompra($id)
	{	
		$data = array('estado' => 0 );
		$this->db->where('idCompra',$id);
		$this->db->update('compra',$data);
	}

	public function detalleCompra($id)
	{
		$this->db->select("c.idCompra, DATE_FORMAT((c.fechaHora),('%d/%m/%Y')) as fecha, c.totalCompra, d.cantidad, d.precioCompra, a.nombre as nombreArticulo, CONCAT((u.nombre),(' '),(u.primerApellido)) As usuario");
		$this->db->from('compra c');
		$this->db->join('detallecompra d','c.idCompra=d.idCompra');
		$this->db->join('articulo a','d.idArticulo=a.idArticulo');
		$this->db->join('usuario u','c.idUsuario=u.idUsuario');
		$this->db->where('c.estado',1);
		$this->db->where('c.idCompra',$id);
		return $this->db->get();
	}

	public function listaCompraPer($id)
	{
		$this->db->select("c.idCompra, c.totalCompra, d.cantidad, a.idArticulo, a.stock");
		$this->db->from('compra c');
		$this->db->join('detallecompra d','c.idCompra=d.idCompra');
		$this->db->join('articulo a','d.idArticulo=a.idArticulo');
		$this->db->where('c.idCompra',$id);
		return $this->db->get();
	}

	public function updateStock($idArticulo, $stockActual)
	{	
		$data = array('stock' => $stockActual );
		$this->db->where('idArticulo',$idArticulo);
		$this->db->update('articulo',$data);
	}


//borrar

	public function GetArticulo($id)
	{

		$this->db->select('*');
		$this->db->from('articulo');
		$this->db->where('idArticulo',$id);
		return $this->db->get();
	}

		

	public function buscarArticuloRep($nombre)
	{
		$this->db->select('*');
		$this->db->from('articulo');
		$this->db->where('nombre',$nombre);
		return $this->db->get();
	}




	

	

 

	
	
}
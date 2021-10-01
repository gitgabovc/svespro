<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventas_model extends CI_Model
{
 
	public function listarVenta()
	{
		$this->db->select("v.idVenta, DATE_FORMAT((v.fechaHora),('%d/%m/%Y')) as fecha, CONCAT((p.nombre),(' '),(p.primerApellido),(' '),(p.segundoApellido)) As persona, CONCAT((u.nombre),(' '),(u.primerApellido)) As usuario, v.totalVenta, v.tipoVenta, v.estado");
		$this->db->from('venta v');
		$this->db->join('persona p','v.idCliente=p.idPersona');
		$this->db->join('usuario u','v.idUsuario=u.idUsuario');
		$this->db->order_by('v.idVenta', 'DESC');
		$this->db->limit(100);
		$this->db->where('v.estado','1');
		return $this->db->get();
	}

	public function listaVentaPer($id)
	{
		$this->db->select("v.idVenta, v.totalVenta, v.utilidad, d.cantidad, a.idArticulo, a.stock");
		$this->db->from('venta v');
		$this->db->join('detalleventa d','v.idVenta=d.idVenta');
		$this->db->join('articulo a','d.idArticulo=a.idArticulo');
		$this->db->where('v.idVenta',$id);
		return $this->db->get();
	}

	function listarArtEntel()
	{
		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('e.idEmpresa','1'); //entel empresa 1
		$this->db->where('a.estado','1');
		return $this->db->get();
	}

	function listarArtViva()
	{
		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('e.idEmpresa','2'); //viva empresa 2
		$this->db->where('a.estado','1');
		return $this->db->get();
	}

	function listarArtTigo()
	{
		$this->db->select('*');
		$this->db->from('articulo a');
		$this->db->join('empresa e','a.idEmpresa=e.idEmpresa');
		$this->db->where('e.idEmpresa','3'); //tigo empresa 3
		$this->db->where('a.estado','1');
		return $this->db->get();
	}

	public function insertVenta($data,$idArticulo,$cantidad,$precioVenta,$tipoVenta,$saldoActual)
	{
		$this->db->insert('venta',$data);

		$ultIdVenta = $this->db->insert_id();

		$numE=count($idArticulo);

		 for ($i=0; $i < $numE; $i++) { 
		 	$data1 = array(
			'idVenta' => $ultIdVenta,
			'idArticulo' => $idArticulo[$i], 
			'cantidad' => $cantidad[$i],
			'precioVenta' => $precioVenta[$i]
			);
			$this->db->insert('detalleventa',$data1);
		 }

		 if ($tipoVenta!=0) {

		 	$data2 = array(
			'saldoDeuda' => $saldoActual
			);
			$id=$data['idCliente'];
			$this->db->where('idPersona',$id);
			$this->db->update('persona',$data2);
		 }

		 //return $ultIdVenta; // verificar si es necesario retornar creo que si
	}


	public function ultimoIdVenta(){
		
		$query  = $this->db->select('idVenta')
                   ->from('venta')
                   ->limit(1) // Maximum 10 rows 
                   ->order_by('idVenta','DESC') // Order data descending 
                   ->get();
		return $query->result();
		

	}

	

	public function deleteVenta($id)
	{	
		$data = array('estado' => 0 );
		$this->db->where('idVenta',$id);
		$this->db->update('venta',$data);

		$this->db->where('idVenta',$id);
		$this->db->update('credito',$data);
	}

	
	public function udateCapital($capitalActual)
	{	
		$data = array('montoCapital' => $capitalActual );
		//$this->db->where('idCapital',$id);
		$this->db->update('capital',$data);
	}

	public function updateStock($idArticulo, $stockActual)
	{	
		$data = array('stock' => $stockActual );
		$this->db->where('idArticulo',$idArticulo);
		$this->db->update('articulo',$data);
	}

	public function detalleVendido($id)
	{
		$this->db->select("v.idVenta, DATE_FORMAT((v.fechaHora),('%d/%m/%Y')) as fechaHora, v.totalVenta, p.nombre, p.primerApellido,p.segundoApellido, p.numDocumento, d.cantidad, d.precioVenta, a.nombre as nombreArticulo");
		$this->db->from('venta v');
		$this->db->join('persona p','v.idCliente=p.idPersona');
		$this->db->join('detalleventa d','v.idVenta=d.idVenta');
		$this->db->join('articulo a','d.idArticulo=a.idArticulo');
		$this->db->where('v.estado',1);
		$this->db->where('v.idVenta',$id);
		return $this->db->get();
	}

	public function buscarDeudas($id)
	{
		$this->db->select('p.saldoDeuda as totalDeuda');
		$this->db->from('persona p');
		$this->db->where('p.idPersona',$id);
		//$this->db->where('p.estado',1);
		return $this->db->get()->result();

	}

//borrar

	public function GetArticulo($id)
	{

		$this->db->select('*');
		$this->db->from('articulo');
		$this->db->where('idArticulo',$id);
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
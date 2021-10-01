<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_model extends CI_Model
{
	// para reportes ventas
	public function dbreporfechas($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("u.login, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, a.nombre as articulo, d.cantidad, d.precioVenta, (d.cantidad* d.precioVenta) as subTotal ,a.precioCompra, (d.cantidad*(d.precioVenta- a.precioCompra)) as utilidad , DATE_FORMAT((v.fechaHora),('%d/%m/%Y')) as fechaHora")
						->from('venta v')
						->join('persona p','v.idCliente=p.idPersona')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(v.fechaHora)>=',$fechaInicio)
						->where('DATE(v.fechaHora)<=',$fechaFinal)
						->where('v.estado',1)
						->get();
		return $query->result();	
	}
// para reportes ventas del Cliente
	public function dbreporfechasvc($fechaInicio,$fechaFinal,$idCliente)
	{
		
		$query=$this->db->select("u.login, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, a.nombre as articulo, d.cantidad, d.precioVenta, (d.cantidad* d.precioVenta) as subTotal ,a.precioCompra, (d.cantidad*(d.precioVenta- a.precioCompra)) as utilidad , DATE_FORMAT((v.fechaHora),('%d/%m/%Y')) as fechaHora, p.numDocumento as ci")
						->from('venta v')
						->join('persona p','v.idCliente=p.idPersona')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(v.fechaHora)>=',$fechaInicio)
						->where('DATE(v.fechaHora)<=',$fechaFinal)
						->where('p.idPersona',$idCliente)
						->where('v.estado',1)
						->get();
		return $query->result();	
	}

	// para reportes compras
	public function dbreporfechasC($fechaInicio,$fechaFinal)
	{
		$query=$this->db->select("u.login, a.nombre as articulo, d.cantidad, d.precioCompra, (d.cantidad* d.precioCompra) as subTotal, DATE_FORMAT((c.fechaHora),('%d/%m/%Y')) as fechaHora")
						->from('compra c')
						->join('usuario u','c.idUsuario=u.idUsuario')
						->join('detallecompra d','c.idCompra=d.idCompra')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(c.fechaHora)>=',$fechaInicio)
						->where('DATE(c.fechaHora)<=',$fechaFinal)
						->where('c.estado',1)
						->get();
		return $query->result();	
	}

	
	// para reportes ventas
	public function dbreporfechasXarticulos($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("a.nombre as articulo, sum(d.cantidad) as cantidad, d.precioVenta, sum(d.cantidad* d.precioVenta) as subTotal ,a.precioCompra, sum(d.cantidad*(d.precioVenta- a.precioCompra)) as utilidad")
						->from('venta v')
						->join('persona p','v.idCliente=p.idPersona')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(v.fechaHora)>=',$fechaInicio)
						->where('DATE(v.fechaHora)<=',$fechaFinal)
						->where('v.estado',1)
						->group_by('a.nombre')
						->get();
		return $query->result();	
	}

	// para reportes ventas para cliente
	public function dbreporfechasXarticulosVC($fechaInicio,$fechaFinal,$idCliente)
	{
		
		$query=$this->db->select("a.nombre as articulo, sum(d.cantidad) as cantidad, d.precioVenta, sum(d.cantidad* d.precioVenta) as subTotal ,a.precioCompra, sum(d.cantidad*(d.precioVenta- a.precioCompra)) as utilidad, concat((p.nombre),(' '), IFNULL((p.primerApellido),('')),(' '), IFNULL((p.segundoApellido),(''))) as cliente, p.numDocumento as ci")
						->from('venta v')
						->join('persona p','v.idCliente=p.idPersona')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(v.fechaHora)>=',$fechaInicio)
						->where('DATE(v.fechaHora)<=',$fechaFinal)
						->where('v.idCliente',$idCliente)
						->where('v.estado',1)
						->group_by('a.nombre')
						->get();
		return $query->result();	
	}

	// para reportes compras
	public function dbreporfechasXarticulosC($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("a.nombre as articulo, sum(d.cantidad) as cantidad, d.precioCompra, sum(d.cantidad* d.precioCompra) as subTotal")
						->from('compra c')
						->join('usuario u','c.idUsuario=u.idUsuario')
						->join('detallecompra d','c.idCompra=d.idCompra')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(c.fechaHora)>=',$fechaInicio)
						->where('DATE(c.fechaHora)<=',$fechaFinal)
						->where('c.estado',1)
						->group_by('a.nombre')
						->get();
		return $query->result();	
	
	}


	public function ventasHoy()
	{
		//$hoy=date_default_timezone_get();
		$hoy = date('Y-m-d');

		
		$query=$this->db->select('sum(d.cantidad* d.precioVenta) as totalVentaDia , sum(d.cantidad*(d.precioVenta- a.precioCompra)) as utilidadDia')
						->from('venta v')
						->join('persona p','v.idCliente=p.idPersona')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(v.fechaHora)',$hoy)
						->where('v.estado',1)
						->get();
		return $query->result();	
	}

	public function ventasmes($fechaInicio,$fechaFinal)
	{
		$query=$this->db->select(' sum(v.totalVenta) as totalmes')
						->from('venta v')
						->where('DATE(v.fechaHora)>=',$fechaInicio)
						->where('DATE(v.fechaHora)<=',$fechaFinal)
						->where('v.estado',1)
						->get();
		return $query->result();	
			
	}


	public function comprasHoy()
	{
		$hoy = date('Y-m-d');

		
		$query=$this->db->select('sum(d.cantidad* d.precioCompra) as totalCompraDia')
						->from('compra c')
						->join('usuario u','c.idUsuario=u.idUsuario')
						->join('detallecompra d','c.idCompra=d.idCompra')
						->join('articulo a','d.idArticulo=a.idArticulo')
						->where('DATE(c.fechaHora)',$hoy)
						->where('c.estado',1)
						->get();
		return $query->result();	
	}


	public function capitalTarjetas()
	{
		
		$query=$this->db->select('sum(stock*precioCompra) as capitalTarjetas')
						->from('articulo')
						->where('estado',1)
						->get();
		return $query->result();	
	}

	public function capitalPrincipal()
	{
		
		$query=$this->db->select('montoCapital')
						->from('capital')
						->get();
		return $query->result();	
	}

	public function totalCreditos()
	{
		
		$query=$this->db->select('sum(p.saldoDeuda) as montoCredito')
						->from('persona p')
						->where('p.estado',1)
						->get();
		return $query->result();	
	}





	

	
	
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model
{

	public function listarVentaPorClienteFecha($cliente_id = 'ID_DEL_CLIENTE', $fecha_inicio = 'FECHA_INICIAL', $fecha_fin = 'FECHA_FINAL')
	{


		if ($cliente_id != 0) {
			$this->db->select('venta.*, cliente.nombres, cliente.primerApellido, cliente.segundoApellido');
			$this->db->from('venta');
			$this->db->join('cliente', 'venta.idCliente = cliente.idCliente');
			$this->db->where('cliente.idCliente', $cliente_id);
			$this->db->where('venta.fechaRegistro >=', $fecha_inicio);
			$this->db->where('venta.fechaRegistro <=', $fecha_fin);
			return $this->db->get();
		}

		$this->db->select('cliente.nombres, cliente.primerApellido, cliente.segundoApellido, SUM(venta.precioUnitario) AS totalVentas');
		$this->db->from('venta');
		$this->db->join('cliente', 'venta.idCliente = cliente.idCliente');
		$this->db->group_by('cliente.idCliente');

		return $this->db->get();
	}

	public function listarVentasClientePorId($cliente_id, $fecha_inicio, $fecha_fin)
	{


		$this->db->select('*');
		$this->db->from('venta');
		$this->db->where('venta.idCliente', $cliente_id);

		if ($fecha_inicio != NULL) {

			$fecha_inicio = date($fecha_inicio . " " . "00:00:00");
			$fecha_fin = date($fecha_fin . " " . "23:59:59");

			$this->db->where('venta.fechaRegistro >=', $fecha_inicio);
			$this->db->where('venta.fechaRegistro <=', $fecha_fin);
		}





		return $this->db->get();
	}

	public function listarVentasCliente($fecha_inicio, $fecha_fin)
	{




		$sql = "SELECT c.idCliente, c.nombres, c.primerApellido, c.segundoApellido, IFNULL(SUM(IFNULL(v.precioUnitario, 0)), 0) AS importeTotalVenta
		FROM cliente c
		LEFT JOIN venta v ON c.idCliente = v.idCliente";

		if ($fecha_inicio != NULL) {
			$fecha_inicio = $fecha_inicio . " 00:00:00";
			$fecha_fin = $fecha_fin . " 23:59:59";
			$sql .= " AND ((v.fechaRegistro >= '$fecha_inicio' AND v.fechaRegistro <= '$fecha_fin') OR v.fechaRegistro IS NULL)";
		}

		$sql .= " GROUP BY c.idCliente";
		$sql .= " ORDER BY importeTotalVenta DESC";

		return $this->db->query($sql);
	}

	public function ventaFiltradaFechas($fechaInicio, $fechaFin)
	{
		$fechaInicio = date($fechaInicio . " " . "00:00:00");
		$fechaFin = date($fechaFin . " " . "23:59:59");

		$this->db->select('v.idVenta as idV,cliente.nombres as cNombre,cliente.primerApellido as cPA,cliente.segundoApellido as cSA,empleado.nombres as eNombre,empleado.primerApellido as ePA,empleado.segundoApellido as eSA, precioUnitario, v.fechaRegistro as fr, v.descripcion as descripcion');
		$this->db->from('venta v');
		$this->db->join('cliente', 'cliente.idCliente=v.idCliente');
		$this->db->join('empleado', 'empleado.idEmpleado=v.idEmpleado');
		$this->db->where('v.fechaRegistro >=', $fechaInicio);
		$this->db->where('v.fechaRegistro <=', $fechaFin);
		$this->db->order_by('v.idVenta', 'desc');
		return $this->db->get();
	}

	public function sumaVentasPorMesFechas($fechaInicio, $fechaFin)
	{
		$this->db->select('YEAR(v.fechaRegistro) AS anio, MONTH(v.fechaRegistro) AS mes, SUM(precioUnitario) AS totalVentas');
		$this->db->from('venta v');
		$this->db->join('cliente', 'cliente.idCliente = v.idCliente');
		$this->db->join('empleado', 'empleado.idEmpleado = v.idEmpleado');
		$this->db->where('v.fechaRegistro >=', $fechaInicio);
		$this->db->where('v.fechaRegistro <=', $fechaFin);
		$this->db->group_by('anio, mes');
		$this->db->order_by('anio, mes', 'asc');
		return $this->db->get();
	}

	public function ventaConFechasPorMes($fechaInicio, $fechaFin)
	{
		$fechaInicio = date($fechaInicio . " " . "00:00:00");
		$fechaFin = date($fechaFin . " " . "23:59:59");

		$this->db->select('YEAR(v.fechaRegistro) AS anio, MONTH(v.fechaRegistro) AS mes, SUM(precioUnitario) AS totalVentas');
		$this->db->from('venta v');
		$this->db->where('v.fechaRegistro >=', $fechaInicio);
		$this->db->where('v.fechaRegistro <=', $fechaFin);
		$this->db->group_by('anio, mes');
		$this->db->order_by('anio, mes', 'asc');
		return $this->db->get();
	}

	public function ventaSinFechasPorMes()
	{


		$this->db->select('YEAR(v.fechaRegistro) AS anio, MONTH(v.fechaRegistro) AS mes, SUM(precioUnitario) AS totalVentas');
		$this->db->from('venta v');

		$this->db->group_by('anio, mes');
		$this->db->order_by('anio, mes', 'asc');
		return $this->db->get();
	}

	public function sumaComprasPorMes()
	{
		$this->db->select('YEAR(fechaRegistro) AS anio, MONTH(fechaRegistro) AS mes, SUM(totalCompra) AS totalComprasPorMes');
		$this->db->from('compra');
		$this->db->where('estado', 1); // Filtra por compras en estado 1 (si es necesario)
		$this->db->group_by('anio, mes');
		$this->db->order_by('anio, mes', 'asc');

		return $this->db->get();
	}

	public function compraFiltradaFechas($fechaInicial, $fechaFinal)
	{
		$fechaInicial = date($fechaInicial . " " . "00:00:00");
		$fechaFinal = date($fechaFinal . " " . "23:59:59");
		$this->db->select('compra.*, proveedor.nombreProveedor, empleado.nombres as nombreEmpleado, empleado.primerApellido as primerApellidoEmpleado, empleado.segundoApellido as segundoApellidoEmpleado');
		$this->db->from('compra');
		$this->db->join('proveedor', 'proveedor.idProveedor = compra.idProveedor');
		$this->db->join('empleado', 'empleado.idEmpleado = compra.idEmpleado');
		$this->db->where('compra.estado', 1);
		$this->db->where('compra.fechaRegistro >=', $fechaInicial);
		$this->db->where('compra.fechaRegistro <=', $fechaFinal);
		$this->db->order_by('idCompra', 'desc');

		return $this->db->get();
	}

	public function sumaComprasPorMesFechas($fechaInicial, $fechaFinal)
	{
		$fechaInicial = date($fechaInicial . " " . "00:00:00");
		$fechaFinal = date($fechaFinal . " " . "23:59:59");
		
		$this->db->select('YEAR(compra.fechaRegistro) AS anio, MONTH(compra.fechaRegistro) AS mes, SUM(totalCompra) AS totalComprasPorMes');
		$this->db->from('compra');
		$this->db->join('proveedor', 'proveedor.idProveedor = compra.idProveedor');
		$this->db->join('empleado', 'empleado.idEmpleado = compra.idEmpleado');
		$this->db->where('compra.estado', 1);
		$this->db->where('compra.fechaRegistro >=', $fechaInicial);
		$this->db->where('compra.fechaRegistro <=', $fechaFinal);
		$this->db->group_by('anio, mes');
		$this->db->order_by('anio, mes', 'asc');

		
		return $this->db->get();
	}


	public function insert($data)
	{
		$this->db->insert('categoria', $data);
	}


	public function delete($id, $data)
	{
		$this->db->where('idCategoria', $id);
		$this->db->update('categoria', $data);
	}


	public function get($id)
	{

		$this->db->select('*');
		$this->db->from('categoria c');
		$this->db->where('c.idCategoria', $id);
		return $this->db->get();
	}

	public function update($id, $data)
	{
		$this->db->where('idCategoria', $id);
		$this->db->update('categoria', $data);
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

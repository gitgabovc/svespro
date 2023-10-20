<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inicio_model extends CI_Model
{

	public function totalVentaDia()
	{

		$fechaHoy = date('Y-m-d');
		$sql = $this->db->query("SELECT IFNULL(SUM(precioUnitario), 0) as sumaVentasHoy FROM venta WHERE DATE(fechaRegistro) = '$fechaHoy'");
		return $sql;
	}


	public function totalVentaMes()
	{

		$mesActual = date('Y-m');

		$sql = $this->db->query("SELECT IFNULL(SUM(precioUnitario), 0) as sumaVentasMesActual 
                            FROM venta 
                            WHERE DATE_FORMAT(fechaRegistro, '%Y-%m') = '$mesActual'");

		return $sql;
	}

	public function listaVentasHoy()
	{
		$fechaHoy = date('Y-m-d');

		$this->db->select('v.*, c.nombres, c.primerApellido');
		$this->db->from('venta v');
		$this->db->join('cliente c', 'v.idCliente = c.idCliente');
		$this->db->where('DATE(v.fechaRegistro)', $fechaHoy);
		return  $this->db->get();
	}

	public function listaProductosMinimos()
	{
		$sql = $this->db->query("SELECT p.*, c.nombreCategoria FROM producto p JOIN categoria c ON p.idCategoria = c.idCategoria  WHERE p.stock <= p.stockMinimo AND p.estado = 1");
		return $sql;
	}

	// public function listaProductosTopMes()
	// {
	// 	$sql = $this->db->query("SELECT dv.idProducto, SUM(dv.cantidad) AS totalCantidad, p.nombreProducto, c.nombreCategoria
	// 								FROM detalleventa dv
	// 								JOIN producto p ON dv.idProducto = p.idProducto
	// 								JOIN categoria c ON p.idCategoria = c.idCategoria
	// 								GROUP BY dv.idProducto
	// 								ORDER BY totalCantidad DESC
	// 								LIMIT 5;");
	// 	return $sql;
	// }
	public function listaProductosTopMes()
	{
		$sql = $this->db->query("SELECT dv.idProducto, SUM(dv.cantidad) AS totalCantidad, p.nombreProducto, c.nombreCategoria
		FROM detalleventa dv
		JOIN producto p ON dv.idProducto = p.idProducto
		JOIN categoria c ON p.idCategoria = c.idCategoria
		JOIN venta v ON v.idVenta = dv.idVenta
		WHERE DATE_FORMAT(v.fechaRegistro, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
		GROUP BY dv.idProducto
		ORDER BY totalCantidad DESC
		LIMIT 5;");
		return $sql;
	}
}

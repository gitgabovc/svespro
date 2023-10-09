<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model
{

	public function listarProducto()
	{

		$this->db->select('p.idProducto, p.foto, p.codigo, p.nombreProducto,p.precioNormal,p.stock, p.descripcion, c.nombreCategoria, m.nombreMarca, p.idColor, p.idMaterial, p.idTalla'); //select*
		$this->db->from('producto p');
		$this->db->where('p.estado', '1');
		$this->db->join('categoria c', 'p.idCategoria=c.idCategoria');
		$this->db->join('marca m', 'p.idMarca=m.idMarca');

		return $this->db->get();	//devolucion del resultado de la consulta
	}
	public function listarProductoNombre($tu_id_de_compra)
	{

		$this->db->select('detalleproductos.*, productos.nombreProducto as nombre_producto');
		$this->db->from('detalleproductos');
		$this->db->join('productos', 'productos.idProducto = detalleproductos.idProducto');
		$this->db->where('detalleproductos.idCompra', $tu_id_de_compra);

		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function listarCategoria()
	{

		$this->db->select("*"); //select*
		$this->db->from('categoria c'); //tabla
		$this->db->where('c.estado', '1');
		return $this->db->get();	//devolucion del resultado de la consulta
	}

	public function listarMarca()
	{

		$this->db->select("*"); //select*
		$this->db->from('marca m'); //tabla
		$this->db->where('m.estado', '1');
		return $this->db->get();	//devolucion del resultado de la consulta
	}


	public function insert($data)
    {
        $this->db->insert('producto', $data);
        return $this->db->insert_id(); // Devuelve el ID generado automáticamente
    }

	public function actualizarNombreImagen($idProducto, $data)
    {
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }


	public function delete($id, $data)
	{
		$this->db->where('idProducto', $id);
		$this->db->update('producto', $data);
	}


	public function get($id)
	{

		$this->db->select('*');
		$this->db->from('producto p');
		$this->db->where('p.idProducto', $id);
		return $this->db->get();
	}

	public function update($id, $data)
	{
		$this->db->where('idProducto', $id);
		$this->db->update('producto', $data);
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

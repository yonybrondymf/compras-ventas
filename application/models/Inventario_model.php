<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_model extends CI_Model {
	public function save($data){
		if ($this->db->insert("inventarios", $data)) {
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
	public function saveDetalleInventario($data){
		return $this->db->insert("inventario_producto", $data);
	}

	public function getInventario($month, $year){
		$this->db->where("month",$month);
		$this->db->where("year", $year);
		$resultado = $this->db->get("inventarios");
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}
		return false;
	}	

	public function getProductos($idinventario){
		$this->db->select("p.nombre, m.nombre as marca,ip.*");
		$this->db->from("inventario_producto ip");
		$this->db->join("productos p", "ip.producto_id = p.id");
		$this->db->join("marca m", "p.marca_id = m.id");
		$this->db->where("ip.inventario_id", $idinventario);
		$query = $this->db->get();
	    $return = array();

	    foreach ($query->result() as $producto)
	    {
	        $return[$producto->id] = $producto;
	        $return[$producto->id]->venta = $this->sumaVentas($producto->producto_id);
	        $return[$producto->id]->compra = $this->sumaCompras($producto->producto_id); // Get the categories sub categories
	    }

	    return $return;
	}
	public function sumaVentas($producto_id)
	{
	    $this->db->select("SUM(dv.cantidad) as total");
	    $this->db->from("detalle_venta dv");
	    $this->db->join("ventas v", "dv.venta_id = v.id");
	    $this->db->where("v.fecha >=","2018-10-01");
	    $this->db->where("v.fecha <=","2018-10-31");
	    $this->db->where("v.estado !=","0");
	    $this->db->where("dv.producto_id", $producto_id);
	    $this->db->group_by("dv.producto_id");
	    $resultado = $this->db->get();
	    if ($resultado->num_rows() > 0) {
	    	return $resultado->row()->total;
	    }
	    return 0;
	}

	public function sumaCompras($producto_id)
	{
	    $this->db->select("SUM(dc.cantidad) as total");
	    $this->db->from("detalle_compra dc");
	    $this->db->join("compras c", "dc.compra_id = c.id");
	    $this->db->where("c.fecha >=","2018-10-01");
	    $this->db->where("c.fecha <=","2018-10-31");
	    $this->db->where("dc.producto_id", $producto_id);
	    $this->db->group_by("dc.producto_id");
	    $resultado = $this->db->get();
	    if ($resultado->num_rows() > 0) {
	    	return $resultado->row()->total;
	    }

	    return 0;

	}

	public function years(){
		$this->db->select("year");
		$this->db->group_by("year");
		$this->db->order_by("year","desc");
		$resultados = $this->db->get("inventarios");
		return $resultados->result();
	}
}

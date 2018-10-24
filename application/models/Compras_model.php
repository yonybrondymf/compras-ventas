<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model {

	public function getCompras($fecha = false){
		$this->db->select("c.*,p.nit,p.nombre as proveedor,tp.nombre as tipopago, u.nombres");
		$this->db->from("compras c");
		$this->db->join("proveedor p","c.proveedor_id = p.id");
		$this->db->join("tipo_pago tp","c.tipo_pago_id = tp.id");
		$this->db->join("usuarios u","c.usuario_id = u.id");
		
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else
		{
			return false;
		}
	}

	public function getCompra($id){
		$this->db->select("c.*,p.nombre as proveedor,p.nit,p.direccion,tp.nombre as tipopago");
		$this->db->from("compras c");
		$this->db->join("proveedor p","c.proveedor_id = p.id");
		$this->db->join("tipo_pago tp","c.tipo_pago_id = tp.id");
		$this->db->where("c.id",$id);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else
		{
			return false;
		}
	}

	public function getDetalle($id){
		$this->db->select("dc.*,p.codigo_barras,p.nombre,p.stock");
		$this->db->from("detalle_compra dc");
		$this->db->join("productos p","dc.producto_id = p.id");
		$this->db->where("dc.compra_id",$id);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getComprobantes(){
		$resultados = $this->db->get("tipo_comprobante");
		return $resultados->result();
	}

	public function getComprobante($idcomprobante){
		$this->db->where("id",$idcomprobante);
		$resultado = $this->db->get("tipo_comprobante");
		return $resultado->row();
	}

	public function getproductos($valor){
		$this->db->select("p.id,CONCAT(p.codigo_barras,' - ',p.nombre) as label,p.nombre,p.codigo_barras,p.precio_compra,m.nombre as marca,p.stock");
		$this->db->from("productos p");
		$this->db->join("marca m", "p.marca_id = m.id");
		$this->db->like("CONCAT(p.codigo_barras,'',p.nombre)",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}

	public function getProductoByCode($codigo_barra){
		$this->db->select("p.id,p.nombre,p.codigo_barras,p.precio_compra,m.nombre as marca,p.stock");
		$this->db->from("productos p");
		$this->db->join("marca m", "p.marca_id = m.id");
		$this->db->where("p.codigo_barras", $codigo_barra);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
		
	}

	public function getproductosA($valor){
		$this->db->select("id,codigo_barras,nombre as label,precio,stock,condicion");
		$this->db->from("productos");
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}

	public function save($data){
		$this->db->trans_start();

        if ($this->db->insert("compras", $data)) {
			$compra_id =  $this->db->insert_id();
		}
		$idproductos = $this->input->post("idproductos");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$precios = $this->input->post("precios");
		for ($i=0; $i < count($idproductos); $i++) {
			$dataDetalle = array(
				"compra_id" => $compra_id,
				"producto_id" => $idproductos[$i],
				"precio" => $precios[$i],
				"cantidad" => $cantidades[$i],
				"importe" => $importes[$i]
			); 
			$this->db->insert("detalle_compra",$dataDetalle);
			$this->updateStock($idproductos[$i],$cantidades[$i]);
		}

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            $this->set_flash_error();
            return FALSE;  
        }
        return TRUE; //everything worked
	}

	public function set_flash_error()
    {
        $error = $this->db->error();
        $this->session->set_flashdata('Error', $error["message"]);
    }
    protected function updateStock($idproducto, $cantidad){
    	$infoProducto = $this->getProducto($idproducto);
    	$data = array(
    		"stock" => $infoProducto->stock + $cantidad
    	);
    	$this->db->where("id",$idproducto);
    	$this->db->update("productos",$data);
    }

    protected function getProducto($id){
    	$this->db->where('id', $id);

    	return $this->db->get('productos')->row();
    }

	public function lastID(){
		return $this->db->insert_id();
	}

	public function updateComprobante($idcomprobante,$data){
		$this->db->where("id",$idcomprobante);
		$this->db->update("tipo_comprobante",$data);
	}

	public function save_detalle($data){
		$this->db->insert("detalle_venta",$data);
	}

	public function years(){
		$this->db->select("YEAR(fecha) as year");
		$this->db->from("ventas");
		$this->db->group_by("year");
		$this->db->order_by("year","desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function montos(){
		$this->db->select("fecha, SUM(total) as monto");
		$this->db->from("ventas");
		$this->db->where("estado","1");
		$this->db->group_by("fecha");
		$this->db->order_by("fecha");
		$resultados = $this->db->get();
		return $resultados->result();
	}


	public function savecliente($data){
		if ($this->db->insert("clientes",$data)) {
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}

	public function stockminimo(){
		$this->db->where("estado","1");
		$query = $this->db->get("productos");
		$return = array();

	    foreach ($query->result() as $producto)
	    {
	    	if ($producto->stock <= $producto->stock_minimo) {
	    		$return[$producto->id] = $producto;
	    	}
	        
	    }

	    return $return;

	}

	public function deleteDetail($id){
		$this->db->where("venta_id",$id);
		return $this->db->delete("detalle_venta");
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("ventas",$data);
	}

	public function comprobarPassword($password){
		$this->db->where("clave_permiso", $password);
		$resultados  = $this->db->get("configuraciones");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function saveNotificacion($data){
		$this->db->insert("notificaciones",$data);
	}

	public function updateNotificacion($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("notificaciones",$data);
	}

	public function getProducts(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();

		$productos = array();
		foreach ($resultados->result_array() as $resultado) {
			$productos[$resultado['id']] = $resultado;
		}

		return $productos;
	}

	public function productosVendidos($fechainicio, $fechafin){
		$this->db->select("p.id, p.nombre, p.condicion, p.stock, p.precio,SUM(dv.cantidad) as totalVendidos");
		$this->db->from("detalle_venta dv");
		$this->db->join("productos p", "dv.producto_id = p.id");
		$this->db->join("ventas v", "dv.venta_id = v.id");
		$this->db->where("v.fecha >=", $fechainicio);
		$this->db->where("v.fecha <=", $fechafin);
		$this->db->group_by("dv.producto_id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getLastProductos(){
		$this->db->select("p.*, c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->order_by('id',"desc");
		$this->db->limit(5);
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	public function getProductosStockMinimo(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$this->db->where("p.condicion","1");
		$this->db->where("stock <", 10);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProductosmasVendidos(){
		$this->db->select("p.id, p.codigo_barras, p.nombre, p.condicion, p.stock, p.precio,SUM(dv.cantidad) as totalVendidos, c.nombre as categoria");
		$this->db->from("detalle_venta dv");
		$this->db->join("productos p", "dv.producto_id = p.id");
		$this->db->join("ventas v", "dv.venta_id = v.id");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->order_by("totalVendidos", "desc"); 
		$this->db->limit(10);
		$this->db->group_by("dv.producto_id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getTipoPagos(){
		return $this->db->get("tipo_pago")->result();
	}

	public function getProveedores($valor){
		$this->db->select("id,nit,nombre as label");
		$this->db->from("proveedor");
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}
}
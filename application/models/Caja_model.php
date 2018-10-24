<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_model extends CI_Model {

	public function getCajaByDate($operacion){
		$this->db->select("c.*, u.nombres, u.apellidos");
		$this->db->from("caja c");
		$this->db->join("usuarios u", "c.usuario_id = u.id");
		$this->db->where("c.operacion",$operacion);
		$this->db->where("c.fecha >=",date("Y-m-d 00:00:00"));
		$this->db->where("c.fecha <=",date("Y-m-d 23:59:59"));
		$resultados = $this->db->get("caja");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function save($data){
		return $this->db->insert("caja",$data);
	}
	public function getCategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("categorias");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("caja",$data);
	}


	public function sumaVentasHoy(){
		$this->db->select("SUM(total) as total");
		$this->db->where("fecha", date("Y-m-d"));
		$this->db->where("estado","1");
		$resultados = $this->db->get("ventas");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacen_model extends CI_Model {

	public function getAlmacenes(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("almacen");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("almacen",$data);
	}
	public function getAlmacen($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("almacen");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("almacen",$data);
	}
}

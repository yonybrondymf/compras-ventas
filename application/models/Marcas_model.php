<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas_model extends CI_Model {

	public function getMarcas(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("marca");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("marca",$data);
	}
	public function getMarca($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("marca");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("marca",$data);
	}
}

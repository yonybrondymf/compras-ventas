<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contribuyente_model extends CI_Model {

	public function getContribuyentes(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("tipo_contribuyente");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tipo_contribuyente",$data);
	}
	public function getContribuyente($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("tipo_contribuyente");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("tipo_contribuyente",$data);
	}
}

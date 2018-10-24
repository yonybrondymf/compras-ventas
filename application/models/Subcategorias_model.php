<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias_model extends CI_Model {

	public function getSubcategorias(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("subcategorias");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("subcategorias",$data);
	}
	public function getSubcategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("subcategorias");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("subcategorias",$data);
	}
}

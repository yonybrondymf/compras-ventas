<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends CI_Model {

	public function getEmpresas(){
	//	$this->db->where("estado","1");
		$resultados = $this->db->get("empresa");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("empresa",$data);
	}
	public function getEmpresa($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("empresa");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("empresa",$data);
	}
}

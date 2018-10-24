<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {

	public function getDocumentos(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("tipo_documento");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tipo_documento",$data);
	}
	public function getDocumento($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("tipo_documento");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("tipo_documento",$data);
	}
}

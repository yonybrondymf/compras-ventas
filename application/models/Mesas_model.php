<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas_model extends CI_Model {

	public function getMesas($estado=false){
		if ($estado!=false) {
			$this->db->where("estado",$estado); 
		}
		
		$resultados = $this->db->get("mesas");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("mesas",$data);
	}
	public function getCategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("mesas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("mesas",$data);
	}
	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("mesas");
	}
}

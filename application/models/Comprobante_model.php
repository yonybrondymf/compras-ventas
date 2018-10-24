<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobante_model extends CI_Model {

	public function getComprobantes(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("tipo_comprobante");
		return $resultados->result();
	}

	public function getPredeterminado(){
		$this->db->where("predeterminado", 1);
		$this->db->where("estado","1");
		return $this->db->get("tipo_comprobante")->row();
	}

	public function save($data){
		return $this->db->insert("tipo_comprobante",$data);
	}
	public function getComprobante($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("tipo_comprobante");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("tipo_comprobante",$data);
	}

	public function changeValuePredeterminado($id,$data){
		$this->db->where("id !=",$id);
		return $this->db->update("tipo_comprobante",$data);
	}
}

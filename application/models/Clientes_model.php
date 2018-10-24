<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
	public function getClientes(){
		$this->db->select("c.*,tc.nombre as tipocontribuyente, td.nombre as tipodocumento");
		$this->db->from("clientes c");
		$this->db->join("tipo_contribuyente tc", "c.tipo_contribuyente_id = tc.id");
		$this->db->join("tipo_documento td", "c.tipo_documento_id = td.id");
		$this->db->where("c.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	public function getSoloClientes(){
		$this->db->select("c.*");
		$this->db->from("clientes c");
		$this->db->where("c.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getCliente($id){
		$this->db->select("c.*,tc.nombre as tipocontribuyente, td.nombre as tipodocumento");
		$this->db->from("clientes c");
		$this->db->join("tipo_contribuyente tc", "c.tipo_contribuyente_id = tc.id");
		$this->db->join("tipo_documento td", "c.tipo_documento_id = td.id");
		$this->db->where("c.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();

	}
	public function save($data){
		return $this->db->insert("clientes",$data);
	}
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("clientes",$data);
	}

	public function getTipoClientes(){
		$resultados = $this->db->get("tipo_contribuyente");
		return $resultados->result();
	}

	public function getTipoDocumentos(){
		$resultados = $this->db->get("tipo_documento");
		return $resultados->result();
	}
}
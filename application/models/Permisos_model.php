<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos_model extends CI_Model {
	public function getPermisos(){
		$this->db->select("p.*,m.nombre as menu, r.nombre as rol");
		$this->db->from("permisos p");
		$this->db->join("roles r", "p.rol_id = r.id");
		$this->db->join("menus m", "p.menu_id = m.id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getMenus(){
		$resultados = $this->db->get("menus");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("permisos",$data);
	}

	public function getPermiso($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("permisos");
		return $resultado->row();
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("permisos",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("permisos");
	}

	public function clave(){
		$resultados = $this->db->get("configuraciones");
		if ($resultados->num_rows() > 0 ) {
			return $resultados->row();
		}else{
			return false;
		}
	}

	public function saveClave($data){
		return $this->db->insert("configuraciones", $data);
	}

	public function updateClave($id, $data){
		$this->db->where("id", $id);
		return $this->db->update("configuraciones",$data);
	}

	public function checkClave($clave){
		$this->db->where("clave_permiso", $clave);
		$resultados = $this->db->get("configuraciones");
		if ($resultados->num_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}	
}
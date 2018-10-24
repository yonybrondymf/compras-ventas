<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Mesas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'mesas' => $this->Mesas_model->getMesas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/mesas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$numero = $this->input->post("numero");
		$idMesa = $this->input->post("idMesa");

		$data  = array(
			'numero' => $numero, 
			'estado' => "1"
		);

		if (!empty($idMesa)) {
			$this->Mesas_model->update($idMesa,$data);
		}else{
			$this->Mesas_model->save($data);
		}

		redirect(base_url()."mantenimiento/mesas");


		
	}

	public function edit($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idCategoria = $this->input->post("idCategoria");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$categoriaactual = $this->Categorias_model->getCategoria($idCategoria);

		if ($nombre == $categoriaactual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[categorias.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'descripcion' => $descripcion,
			);

			if ($this->Categorias_model->update($idCategoria,$data)) {
				redirect(base_url()."mantenimiento/categorias");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/categorias/edit/".$idCategoria);
			}
		}else{
			$this->edit($idCategoria);
		}

		
	}

	public function view($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("admin/categorias/view",$data);
	}

	public function delete($id){
		/*$data  = array(
			'estado' => "0", 
		);*/
		$this->Mesas_model->delete($id);
		echo "mantenimiento/mesas";
	}
	
	public function activar($id){
		$data  = array(
			'estado' => "1", 
		);
		$this->Mesas_model->update($id,$data);
		redirect(base_url()."mantenimiento/mesas");
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Subcategorias_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'subcategorias' => $this->Subcategorias_model->getSubcategorias(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/subcategorias/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/subcategorias/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[subcategorias.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'estado' => "1"
			);

			if ($this->Subcategorias_model->save($data)) {
				redirect(base_url()."mantenimiento/subcategorias");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/subcategorias/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'subcategoria' => $this->Subcategorias_model->getSubcategoria($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/subcategorias/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idSubcategoria = $this->input->post("idSubcategoria");
		$nombre = $this->input->post("nombre");

		$subcategoriaactual = $this->Subcategorias_model->getSubcategoria($idSubcategoria);

		if ($nombre == $subcategoriaactual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[subcategorias.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
			);

			if ($this->Subcategorias_model->update($idSubcategoria,$data)) {
				redirect(base_url()."mantenimiento/subcategorias");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/subcategorias/edit/".$idSubcategoria);
			}
		}else{
			$this->edit($idCategoria);
		}

		
	}

	public function view($id){
		$data  = array(
			'subcategoria' => $this->Subcategorias_model->getSubcategoria($id), 
		);
		$this->load->view("admin/subcategorias/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Subcategorias_model->update($id,$data);
		echo "mantenimiento/subcategorias";
	}
}

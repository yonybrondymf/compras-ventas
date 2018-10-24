<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contribuyente extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Contribuyente_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'contribuyentes' => $this->Contribuyente_model->getContribuyentes(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/contribuyente/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/contribuyente/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[tipo_contribuyente.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'descripcion' => $descripcion,
				'estado' => "1"
			);

			if ($this->Contribuyente_model->save($data)) {
				redirect(base_url()."mantenimiento/contribuyente");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/contribuyente/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'contribuyente' => $this->Contribuyente_model->getContribuyente($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/contribuyente/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idContribuyente = $this->input->post("idContribuyente");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$contribuyenteActual = $this->Contribuyente_model->getContribuyente($idContribuyente);

		if ($nombre == $contribuyenteActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[tipo_contribuyente.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'descripcion' => $descripcion,
			);

			if ($this->Contribuyente_model->update($idContribuyente,$data)) {
				redirect(base_url()."mantenimiento/contribuyente");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/contribuyente/edit/".$idCategoria);
			}
		}else{
			$this->edit($idCategoria);
		}

		
	}

	public function view($id){
		$data  = array(
			'contribuyente' => $this->Contribuyente_model->getContribuyente($id), 
		);
		$this->load->view("admin/contribuyente/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Contribuyente_model->update($id,$data);
		echo "mantenimiento/contribuyente";
	}
}

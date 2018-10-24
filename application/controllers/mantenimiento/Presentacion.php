<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presentacion extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Presentacion_model");
		//$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'presentaciones' => $this->Presentacion_model->getPresentaciones(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/presentacion/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/presentacion/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
	//	$descripcion = $this->input->post("descripcion");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[presentacion.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'estado' => "1"
			);

			if ($this->Presentacion_model->save($data)) {
				redirect(base_url()."mantenimiento/presentacion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/presentacion/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/marcas/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'presentacion' => $this->Presentacion_model->getPresentacion($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/presentacion/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idMarca = $this->input->post("idMarca");
		$nombre = $this->input->post("nombre");
		//$descripcion = $this->input->post("descripcion");

		$marcaactual = $this->Presentacion_model->getPresentacion($idMarca);

		if ($nombre == $marcaactual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[presentacion.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'descripcion' => $descripcion,
			);

			if ($this->Presentacion_model->update($idMarca,$data)) {
				redirect(base_url()."mantenimiento/presentacion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/presentacion/edit/".$idMarca);
			}
		}else{
			$this->edit($idMarca);
		}

		
	}

	public function view($id){
		$data  = array(
			'presentacion' => $this->Presentacion_model->getPresentacion($id), 
		);
		$this->load->view("admin/presentacion/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Presentacion_model->update($id,$data);
		echo "mantenimiento/presentacion";
	}
}

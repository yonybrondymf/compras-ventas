<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Marcas_model");
		//$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'marcas' => $this->Marcas_model->getMarcas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
	//	$descripcion = $this->input->post("descripcion");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[marca.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'estado' => "1"
			);

			if ($this->Marcas_model->save($data)) {
				redirect(base_url()."mantenimiento/marcas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/marcas/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/marcas/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'marca' => $this->Marcas_model->getMarca($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idMarca = $this->input->post("idMarca");
		$nombre = $this->input->post("nombre");
		//$descripcion = $this->input->post("descripcion");

		$marcaactual = $this->Marcas_model->getMarca($idMarca);

		if ($nombre == $marcaactual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[marca.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'descripcion' => $descripcion,
			);

			if ($this->Marcas_model->update($idMarca,$data)) {
				redirect(base_url()."mantenimiento/marcas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/marcas/edit/".$idMarca);
			}
		}else{
			$this->edit($idMarca);
		}

		
	}

	public function view($id){
		$data  = array(
			'marca' => $this->Marcas_model->getMarca($id), 
		);
		$this->load->view("admin/marcas/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Marcas_model->update($id,$data);
		echo "mantenimiento/marcas";
	}
}

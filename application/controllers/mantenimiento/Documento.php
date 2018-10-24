<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Documento_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'documentos' => $this->Documento_model->getDocumentos(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/documento/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/documento/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");


		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[tipo_documento.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'estado' => "1"
			);

			if ($this->Documento_model->save($data)) {
				redirect(base_url()."mantenimiento/documento");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/documento/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'documento' => $this->Documento_model->getDocumento($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/documento/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idDocumento = $this->input->post("idDocumento");
		$nombre = $this->input->post("nombre");

		$documentoActual = $this->Documento_model->getDocumento($idDocumento);

		if ($nombre == $documentoActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[tipo_documento.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
			);

			if ($this->Documento_model->update($idDocumento,$data)) {
				redirect(base_url()."mantenimiento/documento");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/documento/edit/".$idCategoria);
			}
		}else{
			$this->edit($idDocumento);
		}

		
	}

	public function view($id){
		$data  = array(
			'documento' => $this->Documento_model->getDocumento($id), 
		);
		$this->load->view("admin/documento/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Documento_model->update($id,$data);
		echo "mantenimiento/documento";
	}
}

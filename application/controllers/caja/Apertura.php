<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apertura extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Caja_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{

		$data  = array(
			'permisos' => $this->permisos,
			'apertura' => $this->Caja_model->getCajaByDate(1), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/caja/apertura",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$monto = $this->input->post("monto");

		$data  = array(
			'monto' => $monto, 
			'operacion' => "1",
			'fecha' => date("Y-m-d H:i:s"),
			'usuario_id' => $this->session->userdata("id"),
		);

		if ($this->Caja_model->save($data)) {
			redirect(base_url()."caja/apertura");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."caja/apertura");
		}
	
		
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
		$idapertura = $this->input->post("idapertura");
		$monto = $this->input->post("monto");

		$data = array(
			"monto" => $monto,
		);

		if ($this->Caja_model->update($idapertura,$data)) {
			redirect(base_url()."caja/apertura");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."mantenimiento/categorias/edit/".$idCategoria);
		}

		
	}

	public function view($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("admin/categorias/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}
}

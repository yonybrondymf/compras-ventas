<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ventas_model");
	}

	public function index(){
		$fechainicio = $this->input->post("fechainicio");
		$fechafin = $this->input->post("fechafin");
		if ($this->input->post("buscar")) {
			$productos = $this->Ventas_model->productosVendidos($fechainicio,$fechafin);
		}
		else{
			$productos = "";
		}
		$data = array(
			"productos" => $productos,
			"fechainicio" => $fechainicio,
			"fechafin" => $fechafin
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/productos",$data);
		$this->load->view("layouts/footer");
	}
}
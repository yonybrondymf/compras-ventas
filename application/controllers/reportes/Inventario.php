<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {
	private $permisos;

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Categorias_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'productos' => $this->Productos_model->getProductosConStock(), 
		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/inventario",$data);
		$this->load->view("layouts/footer");

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Inventario_model");
		$this->load->model("Productos_model");
		$this->load->library('user_agent');
	}

	public function registro_mensual(){
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/inventario/view");
		$this->load->view("layouts/footer");
	}

	public function seguimiento(){
		$productos = "";
		$month = "";
		$year ="";
		$mensaje ="";

		if ($this->input->post("filtrar")) {
			$month = $this->input->post("month");
			$year = $this->input->post("year");
			$infoinventario = $this->Inventario_model->getInventario($month, $year);
			if ($infoinventario != false) {
				$productos = $this->Inventario_model->getProductos($infoinventario->id);
			}else{
				$productos = "";
				$mensaje = "error";
			}
			
		}
		$data = array(
			'productos' => $productos, 
			'month' => $month,
			"year" => $year,
			"mensaje" => $mensaje,
			"years" => $this->Inventario_model->years()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/inventario/seguimiento", $data);
		$this->load->view("layouts/footer");
	}

}

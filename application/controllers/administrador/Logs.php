<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Empresa_model");
		
	}

	public function index(){
		$data = array(
			'permisos' => $this->permisos,
			"logs" => $this->Backend_model->getLogs()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/logs/list",$data);
		$this->load->view("layouts/footer");
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafico extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Ventas_model");
	}
	public function getData(){
		
		$resultados = $this->Ventas_model->montos();
		echo json_encode($resultados);
	}

}

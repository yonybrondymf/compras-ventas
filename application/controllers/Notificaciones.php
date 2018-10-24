<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Ventas_model");
	}


	public function delete(){
		$id = $this->input->post("id");
		$data = array(
			'estado' => "1", 
		);
		$this->Ventas_model->updateNotificacion($id, $data);

		$products = $this->Backend_model->getNotificaciones();

		if (!$products) {
			$total = 0;
		}else{
			$total = count($products); 
		}


		echo $total;
		
	}

}

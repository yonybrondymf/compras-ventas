<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monedas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Monedas_model");
		//$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'monedas' => $this->Monedas_model->getMonedas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/monedas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/monedas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$simbolo = $this->input->post("simbolo");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[tipo_moneda.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'simbolo' => $simbolo,
				'estado' => "1"
			);

			if ($this->Monedas_model->save($data)) {
				redirect(base_url()."mantenimiento/monedas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/monedas/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'moneda' => $this->Monedas_model->getMoneda($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/monedas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idMoneda = $this->input->post("idMoneda");
		$nombre = $this->input->post("nombre");
		$simbolo = $this->input->post("simbolo");

		$monedaactual = $this->Monedas_model->getMoneda($idMoneda);

		if ($nombre == $monedaactual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[tipo_moneda.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'simbolo' => $simbolo,
			);

			if ($this->Monedas_model->update($idMoneda,$data)) {
				redirect(base_url()."mantenimiento/monedas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/monedas/edit/".$idMoneda);
			}
		}else{
			$this->edit($idMoneda);
		}

		
	}

	public function view($id){
		$data  = array(
			'moneda' => $this->Monedas_model->getMoneda($id), 
		);
		$this->load->view("admin/monedas/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Monedas_model->update($id,$data);
		echo "mantenimiento/monedas";
	}
}

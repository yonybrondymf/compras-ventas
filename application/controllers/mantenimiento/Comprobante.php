<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobante extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Comprobante_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'comprobantes' => $this->Comprobante_model->getComprobantes(), 
			'comprobantePredeterminado' => $this->Comprobante_model->getPredeterminado(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/comprobante/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/comprobante/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$iva = $this->input->post("iva");
		$fecha_creacion = $this->input->post("fecha_creacion");
		$serie = $this->input->post("serie");
		$no_inicial = $this->input->post("no_inicial");
		$no_final = $this->input->post("no_final");
		$resolucion = $this->input->post("resolucion");
		$fecha_resolucion = $this->input->post("fecha_resolucion");


		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[tipo_comprobante.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre,
				'iva' => $iva,
				'fecha_registro' => $fecha_creacion,
				'serie' => $serie,
				'no_inicial' => $no_inicial,
				'no_final' => $no_final, 
				'resolucion' => $resolucion,
				'fecha_resolucion' => $fecha_resolucion,
				'estado' => "1"
			);

			if ($this->Comprobante_model->save($data)) {
				redirect(base_url()."mantenimiento/comprobante");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/comprobante/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'comprobante' => $this->Comprobante_model->getComprobante($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/comprobante/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idComprobante = $this->input->post("idComprobante");
		$nombre = $this->input->post("nombre");
		$iva = $this->input->post("iva");
		$fecha_registro = $this->input->post("fecha_registro");
		$serie = $this->input->post("serie");
		$no_inicial = $this->input->post("no_inicial");
		$no_final = $this->input->post("no_final");
		$resolucion = $this->input->post("resolucion");
		$fecha_resolucion = $this->input->post("fecha_resolucion");

		$comprobanteActual = $this->Comprobante_model->getComprobante($idComprobante);

		if ($nombre == $comprobanteActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[tipo_comprobante.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre,
				'iva' => $iva,
				'fecha_registro' => $fecha_registro,
				'serie' => $serie,
				'no_inicial' => $no_inicial,
				'no_final' => $no_final, 
				'resolucion' => $resolucion,
				'fecha_resolucion' => $fecha_resolucion,
				'estado' => "1"
			);

			if ($this->Comprobante_model->update($idComprobante,$data)) {
				redirect(base_url()."mantenimiento/comprobante");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/comprobante/edit/".$idComprobante);
			}
		}else{
			$this->edit($idComprobante);
		}

		
	}

	public function view($id){
		$data  = array(
			'comprobante' => $this->Comprobante_model->getComprobante($id), 
		);
		$this->load->view("admin/comprobante/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Comprobante_model->update($id,$data);
		echo "mantenimiento/comprobante";
	}

	public function setPredeterminado(){
		$comprobante = $this->input->post("comprobante");
		$data = array('predeterminado' => 1);
		if ($this->Comprobante_model->update($comprobante, $data)) {
			//setear los demas comprobante como no predeterminado
			$data = array('predeterminado' => 0);
			$this->Comprobante_model->changeValuePredeterminado($comprobante, $data);
		}
		redirect(base_url()."mantenimiento/comprobante");
		
	}
}

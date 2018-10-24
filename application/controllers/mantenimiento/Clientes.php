<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Clientes_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'clientes' => $this->Clientes_model->getClientes(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/clientes/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){

		$data = array(
			"tipocontribuyentes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos()
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/clientes/add",$data);
		$this->load->view("layouts/footer");
	}
	public function store(){

		$nombre = $this->input->post("nombre");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocontribuyente = $this->input->post("tipocontribuyente");

		$this->form_validation->set_rules("nombre","Nombre del Cliente","required");
		

		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombre, 
				'direccion' => $direccion,
				'telefono' => $telefono,
				'tipo_documento_id' => $tipodocumento,
				'tipo_contribuyente_id' => $tipocontribuyente,
				'num_documento' => $num_documento,
				'estado' => "1"
			);

			if ($this->Clientes_model->save($data)) {
				redirect(base_url()."mantenimiento/clientes");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/clientes/add");
			}
		}
		else{
			$this->add();
		}

		
	}
	public function edit($id){
		$data  = array(
			'cliente' => $this->Clientes_model->getCliente($id), 
			"tipocontribuyentes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/clientes/edit",$data);
		$this->load->view("layouts/footer");
	}


	public function update(){
		$idcliente = $this->input->post("idcliente");
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocontribuyente = $this->input->post("tipocontribuyente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$clienteActual = $this->Clientes_model->getCliente($idcliente);

		if ($num_documento == $clienteActual->num_documento) {
			$is_unique = "";
		}else{
			$is_unique= '|is_unique[clientes.num_documento]';
		}

		$this->form_validation->set_rules("nombre","Nombre del Cliente","required");
		$this->form_validation->set_rules("tipocontribuyente","Tipo de Contribuyente","required");
		$this->form_validation->set_rules("tipodocumento","Tipo de Documento","required");
		$this->form_validation->set_rules("numero","Numero del Documento","required".$is_unique);

		if ($this->form_validation->run()) {
			$data = array(
				'nombre' => $nombre, 
				'tipo_documento_id' => $tipodocumento,
				'tipo_contribuyente_id' => $tipocontribuyente,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'num_documento' => $num_documento,
			);

			if ($this->Clientes_model->update($idcliente,$data)) {
				redirect(base_url()."mantenimiento/clientes");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/clientes/edit/".$idcliente);
			}
		}else{
			$this->edit($idcliente);
		}

		

	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Clientes_model->update($id,$data);
		echo "mantenimiento/clientes";
	}
}
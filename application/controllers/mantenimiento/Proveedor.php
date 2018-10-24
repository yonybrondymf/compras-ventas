<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Proveedor_model");
		$this->load->model("Ventas_model");
		$this->load->model("Contribuyente_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'proveedores' => $this->Proveedor_model->getProveedores(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedor/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){
		$data  = array(
			'tipo_contribuyentes' => $this->Contribuyente_model->getContribuyentes(), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedor/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$nit = $this->input->post("nit");
		$tipo_contribuyente = $this->input->post("tipo_contribuyente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$contacto = $this->input->post("contacto");
		$tel_contacto = $this->input->post("tel_contacto");
		$banco = $this->input->post("banco");
		$no_cuenta = $this->input->post("no_cuenta");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[proveedor.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre, 
				'nit' => $nit,
				'contribuyente_id' => $tipo_contribuyente,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'email' => $email,
				'contacto' => $contacto,
				'tel_contacto' => $tel_contacto,
				'banco' => $banco,
				'no_cuenta' => $no_cuenta,
				'estado' => "1"
			);

			if ($this->Proveedor_model->save($data)) {
				redirect(base_url()."mantenimiento/proveedor");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/proveedor/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'tipo_contribuyentes' => $this->Contribuyente_model->getContribuyentes(),
			'proveedor' => $this->Proveedor_model->getProveedor($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/proveedor/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idProveedor = $this->input->post("idProveedor");
		$nombre = $this->input->post("nombre");
		$nit = $this->input->post("nit");
		$tipo_contribuyente = $this->input->post("tipo_contribuyente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$contacto = $this->input->post("contacto");
		$tel_contacto = $this->input->post("tel_contacto");
		$banco = $this->input->post("banco");
		$no_cuenta = $this->input->post("no_cuenta");

		$proveedorActual = $this->Proveedor_model->getProveedor($idProveedor);

		if ($nombre == $proveedorActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[proveedor.nombre]";

		}


		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
				'nit' => $nit,
				'contribuyente_id' => $tipo_contribuyente,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'email' => $email,
				'contacto' => $contacto,
				'tel_contacto' => $tel_contacto,
				'banco' => $banco,
				'no_cuenta' => $no_cuenta,
			);

			if ($this->Proveedor_model->update($idProveedor,$data)) {
				redirect(base_url()."mantenimiento/proveedor");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/proveedor/edit/".$idProveedor);
			}
		}else{
			$this->edit($idProveedor);
		}

		
	}

	public function view($id){
		$data  = array(
			'proveedor' => $this->Proveedor_model->getProveedor($id), 
		);
		$this->load->view("admin/proveedor/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Proveedor_model->update($id,$data);
		echo "mantenimiento/proveedor";
	}
}

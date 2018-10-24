<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Usuarios_model");
		$this->load->model("Ventas_model");
	}

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
			'usuarios' => $this->Usuarios_model->getUsuarios(), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/list",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){
		$data  = array(
			'roles' => $this->Usuarios_model->getRoles(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$rol = $this->input->post("rol");

		$data  = array(
			'nombres' => $nombres, 
			'apellidos' => $apellidos,
			'telefono' => $telefono,
			'email' => $email,
			'username' => $username,
			'password' => sha1($password),
			'rol_id' => $rol,
			'estado' => "1"
		);

		if ($this->Usuarios_model->save($data)) {
			redirect(base_url()."administrador/usuarios");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/usuarios/add");
		}

		
	}

	public function view(){
		$idusuario = $this->input->post("idusuario");
		$data = array(
			"usuario" => $this->Usuarios_model->getUsuario($idusuario)
		);
		$this->load->view("admin/usuarios/view",$data);
	}

	public function edit($id){
		$data  = array(
			'roles' => $this->Usuarios_model->getRoles(), 
			'usuario' => $this->Usuarios_model->getUsuario($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idusuario = $this->input->post("idusuario");
		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$username = $this->input->post("username");

		$rol = $this->input->post("rol");

		$data  = array(
			'nombres' => $nombres, 
			'apellidos' => $apellidos,
			'telefono' => $telefono,
			'email' => $email,
			'username' => $username,

			'rol_id' => $rol,
		);

		if ($this->Usuarios_model->update($idusuario,$data)) {
			redirect(base_url()."administrador/usuarios");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/usuarios/edit/".$idusuario);
		}

		
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Usuarios_model->update($id,$data);
		echo "administrador/usuarios";
	}

	public function changepassword(){
		$id = $this->input->post("idusuario");
		$newpassword = $this->input->post("newpassword");
		$repeatpassword = $this->input->post("repeatpassword");
		$data = array(
			"password" => sha1($newpassword)
		);

		if ($this->Usuarios_model->update($id,$data)) {
			echo "administrador/usuarios";
		}

	}

}
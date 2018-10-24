<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	private $modulo = "Usuarios";
	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	public function index()
	{
		if ($this->session->userdata("login")) {
			redirect(base_url()."dashboard");
		}
		else{
			$this->load->view("admin/login");
		}
		

	}

	public function login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res = $this->Usuarios_model->login($username, sha1($password));

		if (!$res) {
			/*$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");*/
			//redirect(base_url());
			echo "0";
		}
		else{
			$data  = array(
				'id' => $res->id, 
				'nombre' => $res->nombres,
				'rol' => $res->rol_id,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			$this->backend_lib->savelog($this->modulo,"Inicio de sesión");
			//redirect(base_url()."dashboard");
			echo "1";
		}
	}

	public function logout(){
		$this->backend_lib->savelog($this->modulo,"Cierre de sesión");
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$this->cerrar_sesion();
		$this->load->view('login');
	}

	public function ingresar()
	{
		$email = addslashes($this->input->post('email'));
		$contrasenia = addslashes($this->input->post('contrasenia'));

		$result = $this->usuario_model->login($email, $contrasenia);
		if($result)
		{
			$this->session->set_userdata('id_usuario', $result['id_usuario']);
			$this->session->set_userdata('u_rut', $result['u_rut']);
			$this->session->set_userdata('u_nombres', $result['u_nombres']);
			$this->session->set_userdata('u_apellidos', $result['u_apellidos']);

			$usuario = $this->session->userdata();
			redirect('Home');
		}else{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			$this->load->view('Login', $data);
		}
	}

	public function cerrar_sesion()
	{
		$usuario = $this->session->userdata();
		if($usuario)
		{
			$this->session->sess_destroy();
		}
	}
}
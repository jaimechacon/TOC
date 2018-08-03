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

			echo $this->session->id_usuario.'</br>';
			echo $this->session->u_rut.'</br>';
			echo $this->session->u_nombres.'</br>';
			echo $this->session->u_apellidos.'</br>';


			$usuario = $this->session->userdata();
			/*if($usuario)
			{
				echo 'bien ctmre!!!!';
				echo $usuario['id_usuario'];
				echo $usuario['u_rut'];
				echo $usuario['u_nombres'];
				echo $usuario['u_apellidos'];
			}*/

			//$this->session->('user', $result);
			redirect('home');
		}else{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			$this->load->view('login', $data);
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
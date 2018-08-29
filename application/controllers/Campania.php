<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campania extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarCampania', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function asignarCampania()
	{
		echo 'asdf';
		$usuario = $this->session->userdata();
		if($usuario){
			$campanias = $this->usuario_model->listarCampaniasUsu($usuario["id_usuario"]);
			var_dump($campanias);
			$usuario['campanias'] = $campanias;
			mysqli_next_result($this->db->conn_id);
			$usuarios = $this->usuario_model->listarAnalistaUsu();
			var_dump($usuarios);
			$usuario['usuarios'] = $usuarios;
				
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('asignarCampania', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}
}

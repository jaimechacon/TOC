<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('equipo_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarEquipos', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarEquipos()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$equipos = $this->equipo_model->listarEquipos();
			$usuario['equipos'] = $equipos;

			//var_dump($equipos);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarEquipos', $usuario);
			$this->load->view('temp/footer');
		}
	}

	public function buscarEquipo()
	{
		$usuario = $this->session->userdata();

		if($usuario){
			if($this->input->POST('equipo'))
			{
				$equipo = $this->input->POST('equipo');
				echo json_encode($this->equipo_model->buscarEquipo($equipo));
			}else
			{
				echo json_encode($this->equipo_model->buscarEquipo(""));
			}
		}
		/*
		$usuario = $this->session->userdata();

		if($usuario){
			if($this->input->POST('equipo'))
			{
				echo json_encode($this->equipo_model->buscarEquipo($equipo));
			}else
			{
				echo json_encode($this->equipo_model->buscarEquipo(""));
			}
		}*/
	}
	
}
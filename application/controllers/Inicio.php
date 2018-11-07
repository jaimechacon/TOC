<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('inicio_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();

		if($this->session->has_userdata('id_usuario'))
		{			
			$perfil = $this->usuario_model->traerPerfilUsu($usuario["id_usuario"]);
			//$resultados = $this->inicio_model->listarPromedioEvaluacioCampania(5);
			//var_dump($resultados);
			$usuario['controller'] = 'inicio';
			$usuario['perfil'] = $perfil[0];
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('inicioSesion', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			$this->session->sess_destroy();
			$login['login'] = 0;
			$this->load->view('temp/header_index', $login);
			$this->load->view('temp/menu_index');
			$this->load->view('inicio');
			$this->load->view('temp/footer');
		}
	}

	public function inicio()
	{
		$usuario = $this->session->userdata();
		if(!$usuario){
			$this->session->sess_destroy();
			echo 'asdfsadf';
		}else
		{
			$login['login'] = 0;
			$this->load->view('temp/header_index', $login);
			$this->load->view('temp/menu_index');
			$this->load->view('inicio');
			$this->load->view('temp/footer');
		}

	}

	public function listarPromedioEvaluacionesCampanias()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$resultado = $this->inicio_model->listarPromedioEvaluacionesCampanias();
			if(count($resultado) > 0)
				for ($i=0; $i < count($resultado); $i++) {
					$id_campania = $resultado[$i]["id_campania"];
					$eacs = $this->inicio_model->listarPromedioEvaluacioCampania($id_campania);
					$resultado[$i]["eacs"] = $eacs;				
				}			
		}
		echo json_encode($resultado);
	}

}

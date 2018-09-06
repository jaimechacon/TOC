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
			$equipo = "";
			if($this->input->POST('equipo'))
				$equipo = $this->input->POST('equipo');
			echo json_encode($this->equipo_model->buscarEquipo($equipo));
		}
	}

	public function agregarEquipo()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eacs = $this->equipo_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;

		if(isset($this->session->listaEAC))
			$this->session->unset_userdata('listaEAC');
		$this->load->view('temp/header');
		$this->load->view('temp/menu', $usuario);
		$this->load->view('agregarEquipo', $usuario);
		$this->load->view('temp/footer');
		}
	}

	public function eliminarEquipo()
	{
		/*$usuario = $this->session->userdata();
		if($usuario){*/
			$idEquipo = null;
			if($this->input->POST('idEquipo'))
				$idEquipo = $this->input->POST('idEquipo');
			echo json_encode($this->equipo_model->eliminarEquipo($idEquipo, 1));
		//}
	}

	public function buscarEAC()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eac = "";
			if($this->input->POST('eac'))
				$eac = $this->input->POST('eac');
			echo json_encode($this->equipo_model->buscarEAC($eac));
		}
	}

	public function listaEAC()
	{
		$usuario = $this->session->userdata();
		if($usuario){

			$eacs[] = array();
			unset($eacs);
			$idEac = "";
			$checked = false;

			$respuesta = "";
			if($this->input->POST('idEac') && $this->input->POST('checked'))
			{
				$idEac = $this->input->POST('idEac');
				$checked = $this->input->POST('checked');

				$checked = $this->input->POST('checked') === 'true'? true : false;

				if(isset($usuario['listaEAC']))
				{
					$eacs = $usuario['listaEAC'];
					
					if($checked)
					{
						
					}else{
						echo 'hay que eliminarlo';
						var_dump($respuesta);
						var_dump($checked);
					}
					
					//$eacs[] = array('asdf', 'asdf');
					//$usuario['listaEAC'] = $eacs;
					//var_dump($usuario['listaEAC']);
					//$this->session->mark_as_flash('listaEAC');
					//$this->session->set_flashdata('listaEAC');
				}else
				{
					$eacs = array('idEAC' => $idEac);

					$this->session->set_userdata('listaEAC', $eacs);

					echo 'la variable no esta definida';				
					//var_dump($usuario);
					//$eac = "";
					//if($this->input->POST('eac'))
					//	$eac = $this->input->POST('eac');
					//echo json_encode($this->equipo_model->buscarEAC($eac));
				}

			}

			
		}
	}
	
	
}
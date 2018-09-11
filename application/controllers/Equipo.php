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
			$equipos = $this->equipo_model->buscarEquipo('');
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
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarEquipo', $usuario);
			$this->load->view('temp/footer');
		}
	}

	public function guardarEquipo()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombreEquipo')))
			{
				if(!is_null($this->input->POST('abreviacionEquipo')))
				{
					$nombre = trim($this->input->POST('nombreEquipo'));
					$abreviacion = trim($this->input->POST('abreviacionEquipo'));
					$observaciones = "";
					$eacs[] = array();
					unset($eacs);
					if(!is_null($this->input->POST('observacionesEquipo')))
						$observaciones = trim($this->input->POST('observacionesEquipo'));
					if(!is_null($this->input->POST('eacsEquipo')))
						$eacs = $this->input->POST('eacsEquipo');
					$resultado = $this->equipo_model->guardarEquipo($nombre, $abreviacion, $observaciones, $eacs, $usuario["id_usuario"]);
					if($resultado > 0)
					{
						if($resultado[0] > 0)
						{
							if($resultado[0]['idEquipo'])
							{
								$idEquipo = (int)$resultado[0]['idEquipo'];								
								$respuesta = 1;
								$cantEAC = sizeof($eacs);
								if($cantEAC > 0)
								{
									$cantEACA = 0;							
									foreach ($eacs as $eac) {
										if(is_numeric($eac))
										{
											mysqli_next_result($this->db->conn_id);
											$resultadoEAC = $this->equipo_model->guardarEACEquipo($idEquipo, (int)$eac, $usuario["id_usuario"]);	
											if($resultadoEAC > 0)
											{
												//var_dump($resultadoEAC);
												$cantEAC ++;
											}else{
												$respuesta = 0;							
											}
										}

										/*
										$resultadoEAC = $this->equipo_model->guardarEACEquipo($idEquipo, $eac, $usuario["id_usuario"]);
										if($resultadoEAC > 0)
										{
											$cantEAC ++;
										}else{
											$respuesta = 0;							
										}*/
									}
								}
							}
						}
						
						
						
					
					}
					echo json_encode($respuesta);
				}
			}
		}
	}

	public function eliminarEquipo()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$idEquipo = null;
			if($this->input->POST('idEquipo'))
				$idEquipo = $this->input->POST('idEquipo');
			$resultado = $this->equipo_model->eliminarEquipo($idEquipo, $usuario['id_usuario']);
			$respuesta = 0;
			if($resultado > 0)
				$respuesta = 1;
			echo json_encode($respuesta);
		}
	}

	public function buscarEAC()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eac = "";
			if($this->input->POST('eac'))
				$eac = $this->input->POST('eac');
			
			$eacs = $this->equipo_model->buscarEAC($eac);
		}
		echo json_encode($eacs);		
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
						if(!in_array($idEac, $eacs))
						{
							$eacs[count($eacs)] = $idEac;
							$this->session->set_flashdata('listaEAC', $eacs);
							$this->session->keep_flashdata('listaEAC');
							echo json_encode(array('idEAC' => $idEac, 'checked' => true));
						}
					}else{
						if(in_array($idEac, $eacs))
						{
							$posicion = array_search($idEac, $eacs);
							unset($eacs[$posicion]);
							$this->session->set_flashdata('listaEAC', $eacs);
							$this->session->keep_flashdata('listaEAC');
							echo json_encode(array('idEAC' => $idEac, 'checked' => false));
						}
					}
				}else
				{
					$eacs = array(0 => $idEac);
					$this->session->set_userdata('listaEAC', $eacs);
					$this->session->mark_as_flash('listaEAC');
					echo json_encode(array('idEAC' => $idEac, 'checked' => true));
				}
			}
		}
	}	
	
}
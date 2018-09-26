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
			$usuario['controller'] = 'equipo';

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarEquipos', $usuario);
			$this->load->view('temp/footer', $usuario);
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
			$usuario['controller'] = 'equipo';
			//var_dump($equipos);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarEquipos', $usuario);
			$this->load->view('temp/footer', $usuario);
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
		$usuario['titulo'] = 'Agregar Equipo';
		$usuario['controller'] = 'equipo';

		$this->load->view('temp/header');
		$this->load->view('temp/menu', $usuario);
		$this->load->view('agregarEquipo', $usuario);
		$this->load->view('temp/footer', $usuario);
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
					$accion = 'agregado';
					unset($eacs);
					if(!is_null($this->input->POST('observacionesEquipo')))
						$observaciones = trim($this->input->POST('observacionesEquipo'));
					if(!is_null($this->input->POST('eacsEquipo')))
						$eacs = $this->input->POST('eacsEquipo');
					$idEquipo = 'null';
/*
					var_dump($this->input->POST('idEquipo'));
					echo '----';
					var_dump(is_null($this->input->POST('idEquipo')));
					echo '----';
					var_dump(is_numeric($this->input->POST('idEquipo')));
					echo '----';*/
					if(!is_null($this->input->POST('idEquipo')) && is_numeric($this->input->POST('idEquipo')))
					{
						$idEquipo = $this->input->POST('idEquipo');
						$accion = 'modificado';
					}

					$respuesta = 0;
					$cantEacs = 0;
					$mensaje = '';

					//var_dump($idEquipo, $nombre, $abreviacion, $observaciones);
					//mysqli_next_result($this->db->conn_id);

					$resultado = $this->equipo_model->guardarEquipo($idEquipo, $nombre, $abreviacion, $observaciones, $usuario["id_usuario"]);
					//var_dump($resultado);
					if($resultado[0] > 0)
					{
						//var_dump($resultado[0]);
						if($resultado[0]['idEquipo'])
						{
							if($idEquipo == 'null')
								$idEquipo = (int)$resultado[0]['idEquipo'];

							//var_dump($resultado[0]);
							$respuesta = 1;
							$mensaje = 'Se ha '.$accion.' el equipo exitosamente.';
							if(isset($eacs))
							{
								$cantEAC = sizeof($eacs);
								if($cantEAC > 0)
								{
									mysqli_next_result($this->db->conn_id);
									$resultadoEEAC = $this->equipo_model->eliminarEACEquipo($idEquipo, $usuario["id_usuario"]);

									if($resultadoEEAC > 0)
									{
										foreach ($eacs as $eac) {
										if(is_numeric($eac))
										{
											mysqli_next_result($this->db->conn_id);
											$resultadoEAC = $this->equipo_model->guardarEACEquipo($idEquipo, (int)$eac, $usuario["id_usuario"]);
											//var_dump($resultadoEAC);
											if($resultadoEAC > 0)
											{
												$cantEacs ++;
											}else{
												$respuesta = 0;
											}
										}	
									}

									$mensaje = $mensaje.' Se han insertado '.$cantEacs.' EAC al equipo.';
									}
								}
							}
						}
					}else
					{
						if($resultado === 0)
						{
							$mensaje = 'Ha ocurrido un error al modificar el equipo, el equipo no se encuentra registrado.';
						}
					}
					$data['respuesta'] = $respuesta;
					$data['eacs'] = $cantEacs;
					$data['mensaje'] = $mensaje;
					echo json_encode($data);
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

	public function modificarEquipo()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eacs = $this->equipo_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;

			$usuario['titulo'] = 'Modificar Equipo';
			$usuario['controller'] = 'equipo';
			if($this->input->GET('idEquipo') && $this->input->GET('idEquipo'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idEquipo = $this->input->GET('idEquipo');
				$equipo =  $this->equipo_model->obtenerEquipo($idEquipo);
				$usuario['equipo'] = $equipo[0];
				//var_dump($equipo[0]);
				$eacsEquipo = array_unique(array_column($equipo, 'id_usuario'));
				$usuario['eacsEquipo'] = $eacsEquipo;
				//$eacs = array_unique(array_column($equipo, 'nombre'), array_column($equipo, 'abreviacion'), array_column($equipo, 'descripcion'));
				//$eacs = array_unique(array_map("serialize", $equipo));
				//var_dump($temp);
				/*$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;*/
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarEquipo', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}
	
}
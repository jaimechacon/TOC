<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('evaluacion_model');
		$this->load->model('grabacion_model');
		$this->load->library('ftp');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarEvaluaciones', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarEvaluaciones()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$rango = 2;
			if($this->input->post('rango'))
			{
				$rango = $this->input->post('rango');
				echo json_encode($this->evaluacion_model->listar_evaluaciones($usuario["id_usuario"], $rango));		
			}else{				
				$evaluaciones = $this->evaluacion_model->listar_evaluaciones($usuario["id_usuario"], $rango);

				if($evaluaciones)
				{
					$usuario['evaluaciones'] = $evaluaciones;
					mysqli_next_result($this->db->conn_id);
					$empresas =  $this->usuario_model->obtenerEmpresasUsu($usuario["id_usuario"]);
					if($empresas)
					{
						$usuario['empresas'] = $empresas;
					}
				}

				$usuario['controller'] = 'evaluacion';
				
				//var_dump($empresas);d
				//var_dump($evaluaciones);d
				/*if($empresas)
				{
					$usuario['empresas'] = $empresas;
				}*/
				$this->load->view('temp/header');
				$this->load->view('temp/menu', $usuario);
				$this->load->view('listarEvaluaciones', $usuario);
				$this->load->view('temp/footer', $usuario);
			}

			
		}else
		{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Login');
		}
	}

	public function filtros()
	{
		if($this->input->post('data'))
		{
			echo $this->input->post('data');
		}
	}

	public function agregarEvaluacion()
	{
		$usuario = $this->session->userdata();
		$usuario['controller'] = 'evaluacion';

		$config['hostname'] = '192.168.158.5';
		$config['username'] = 'client1';
		$config['password'] = 'neopass';
		$config['debug']    = TRUE;
		$config['port']     = 21;
		$config['passive']  = FALSE;

		//mysqli_next_result($this->db->conn_id);
		//$resultado = $this->ftp->connect($config);
		//echo $resultado;

		//$list = $this->ftp->list_files('/MONITOREO/');
		//print_r($list);
		//$this->ftp->upload('/local/path/to/myfile.html', '/public_html/myfile.html', 'ascii', 0775);
		//$this->ftp->download('/MONITOREO/930096559-1151769-20180810190847.mp3', '/grabaciones/MP3.mp3', 'ascii');
		//$url = (base_url().'grabaciones/MP3.mp3');
		//echo $url;
		//$this->ftp->upload($url, '/MONITOREO/931700224-1154462-20180814132148.mp3', 'ascii', 0775);
		//$this->ftp->download('/MONITOREO/931748754-1150859-20180809203635.mp3', 'grabaciones/MP3.mp3');
		//$this->ftp->close();
		//mysqli_next_result($this->db->conn_id);
		
		if($usuario){
			//mysqli_next_result($this->db->conn_id);
			//mysqli_next_result($this->db->conn_id);
			if($this->input->GET('idCamp') && $this->input->GET('idEAC'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idCampania = $this->input->GET('idCamp');
				$idEAC = $this->input->GET('idEAC');

				$pauta =  $this->evaluacion_model->obtenerPlantillaEAC($idEAC, $idCampania);
				$usuario['pauta'] = $pauta;
				$temp = array_unique(array_column($pauta, 'cat_nombre'));
				$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;

				$grabaciones = $this->grabacion_model->listarGrabacionesUsu($idEAC, $idCampania);
				if(sizeof($grabaciones) > 0)
					$usuario['grabacion'] = $grabaciones[0];

				$ruta = base_url().'grabaciones/';
				$usuario['ruta'] = $ruta;
			}else{
				$campanias = $this->usuario_model->listarCampaniasUsu($usuario["id_usuario"]);
				$usuario['campanias'] = $campanias;
			}
			
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarEvaluacion', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Login');
		}
	}

	public function guardarEvaluacion()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('idGrabacion')))
			{
				$idGrabacion = trim($this->input->POST('idGrabacion'));
				$observaciones = "";
				
				$accion = 'agregado';
				if(!is_null($this->input->POST('observacionesEvaluacion')))
					$observacionesEvaluacion = trim($this->input->POST('observacionesEvaluacion'));
				
				$idEvaluacion = 'null';
				$preguntas[] = array();
				unset($preguntas);

				if(!is_null($this->input->POST('preguntasEvaluacion')))
					$preguntas = $this->input->POST('preguntasEvaluacion');

				
				//echo ($this->input->POST('preguntas'));
				/*if(!is_null($this->input->POST('idEvaluacion')) && is_numeric($this->input->POST('idEvaluacion')))
					$idEvaluacion = $this->input->POST('idEvaluacion');*/

				if(!is_null($this->input->POST('idEvaluacion')) && is_numeric($this->input->POST('idEvaluacion')) && (int)$this->input->POST('idEvaluacion') != 1)
				{
					$idEvaluacion = (int)$this->input->POST('idEvaluacion');
					$accion = 'modificado';
				}
					



				$respuesta = 0;
				$cantPre = 0;
				$mensaje = '';
				$cantRes = 0;

				//var_dump($idPlantilla, $nombre, $abreviacion, $observaciones);
				//mysqli_next_result($this->db->conn_id);

				$resultado = $this->evaluacion_model->guardarEvaluacion($idEvaluacion, $idGrabacion, $observacionesEvaluacion, $usuario["id_usuario"]);
				//var_dump($resultado);
				if($resultado[0] > 0)
				{
					//var_dump($resultado[0]);
					if($resultado[0]['idEvaluacion'])
					{
						if($idEvaluacion == 'null')
							$idEvaluacion = (int)$resultado[0]['idEvaluacion'];

						//var_dump($resultado[0]);
						$respuesta = 1;
						$mensaje = 'Se ha '.$accion.' la evaluaci&oacute;n exitosamente.';

						//echo $resultado[0]['idEvaluacion'];
						if(isset($preguntas))
						{
							$cantPre = sizeof($preguntas);
							if($cantPre > 0)
							{
								//var_dump($cantPre);
								//mysqli_next_result($this->db->conn_id);
								//$resultadoAPE = $this->plantilla_model->eliminarCatPrePlantilla($idPlantilla, $usuario["id_usuario"]);

								//if($resultadoAE > 0)
								//{
								foreach ($preguntas as $pregunta) {
									
									$pregunta = explode(",", $pregunta);
									//var_dump($pregunta);
									if(is_numeric($pregunta[0]))
									{
										$idplacatpre = (int)$pregunta[0];
										$respuesta = $pregunta[1];
										//var_dump($idEvaluacion.' - '.$idplacatpre.' - '.$respuesta);
										mysqli_next_result($this->db->conn_id);
										$resultadoARE = $this->evaluacion_model->guardarRespuestaPreguntaEvaluacion($idEvaluacion, $idplacatpre, $respuesta, $usuario["id_usuario"]);

										if($resultadoARE > 0)
										{
											$cantRes ++;
										}else{
											$respuesta = 0;
										}	
									}
								}

								$mensaje = $mensaje.' Se han insertado '.$cantRes.' respuestas a la Evaluacion.';
								//}
							}
						}
					}
				}else
				{
					if($resultado === 0)
					{
						$mensaje = 'Ha ocurrido un error al modificar el plantilla, la plantilla no se encuentra registrada.';
					}
				}
				$data['respuesta'] = $respuesta;
				$data['cantPre'] = $cantPre;
				$data['cantRes'] = $cantRes;
				$data['mensaje'] = $mensaje;
				echo json_encode($data);
			}
		}
	}

	public function modificarEvaluacion()
	{
		$usuario = $this->session->userdata();
			
		

		$config['hostname'] = '192.168.158.5';
		$config['username'] = 'client1';
		$config['password'] = 'neopass';
		$config['debug']    = TRUE;
		$config['port']     = 21;
		$config['passive']  = FALSE;

		//$resultado = $this->ftp->connect($config);
		//echo $resultado;

		//$list = $this->ftp->list_files('/MONITOREO/');
		//print_r($list);
		//$this->ftp->upload('/local/path/to/myfile.html', '/public_html/myfile.html', 'ascii', 0775);
		//$this->ftp->download('/MONITOREO/930096559-1151769-20180810190847.mp3', '/grabaciones/MP3.mp3', 'ascii');
		//$url = (base_url().'grabaciones/MP3.mp3');
		//echo $url;
		//$this->ftp->upload($url, '/MONITOREO/931700224-1154462-20180814132148.mp3', 'ascii', 0775);
		//$this->ftp->download('/MONITOREO/931748754-1150859-20180809203635.mp3', 'grabaciones/MP3.mp3');
		//$this->ftp->close();
		$campanias = $this->usuario_model->listarCampaniasUsu($usuario["id_usuario"]);
		$usuario['campanias'] = $campanias;
		if($usuario){
			//mysqli_next_result($this->db->conn_id);
			//mysqli_next_result($this->db->conn_id);

				mysqli_next_result($this->db->conn_id);
				$idCampania = 2;
				$idEAC = 87;
				$pauta =  $this->evaluacion_model->obtenerPlantillaEAC($idEAC, $idCampania);
				$usuario['pauta'] = $pauta;

			
				$temp = array_unique(array_column($pauta, 'CAT_NOMBRE'));
				$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;			
			
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('modificarEvaluacion', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Login');
		}
	}
}
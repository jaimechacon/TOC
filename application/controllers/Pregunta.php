<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pregunta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pregunta_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPreguntas', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarPreguntas()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$preguntas = $this->pregunta_model->listarPreguntas();
			$usuario['preguntas'] = $preguntas;
			$usuario['controller'] = 'pregunta';
			//var_dump($preguntas);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPreguntas', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function buscarPregunta()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$pregunta = "";
			if($this->input->POST('pregunta'))
				$pregunta = $this->input->POST('pregunta');
			echo json_encode($this->pregunta_model->buscarPregunta($pregunta));
		}
	}

	public function agregarPregunta()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['titulo'] = 'Agregar Pregunta';
			$usuario['controller'] = 'pregunta';

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarPregunta', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function guardarPregunta()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombrePregunta')))
			{
				$nombre = trim($this->input->POST('nombrePregunta'));
				$observaciones = "";
				$accion = 'agregado';
				if(!is_null($this->input->POST('observacionesPregunta')))
					$observaciones = trim($this->input->POST('observacionesPregunta'));
				$idPregunta = 'null';

				if(!is_null($this->input->POST('idPregunta')) && is_numeric($this->input->POST('idPregunta')))
				{
					$idPregunta = $this->input->POST('idPregunta');
					$accion = 'modificado';
				}

				$respuesta = 0;
				$mensaje = '';

				$resultado = $this->pregunta_model->guardarPregunta($idPregunta, $nombre, $observaciones, $usuario["id_usuario"]);

				if($resultado[0] > 0)
				{

					if($resultado[0]['idPregunta'])
					{
						if($idPregunta == 'null')
							$idPregunta = (int)$resultado[0]['idPregunta'];
						
						$respuesta = 1;
						$mensaje = 'Se ha '.$accion.' la pregunta exitosamente.';
					}
				}else
				{
					if($resultado === 0)
					{
						$mensaje = 'Ha ocurrido un error al '.$accion.' la pregunta, la pregunta no se encuentra registrado.';
					}
				}
				$data['respuesta'] = $respuesta;
				$data['mensaje'] = $mensaje;
				echo json_encode($data);
				
			}
		}
	}

	public function eliminarPregunta()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$idPregunta = null;
			if($this->input->POST('idPregunta'))
				$idPregunta = $this->input->POST('idPregunta');
			$resultado = $this->pregunta_model->eliminarPregunta($idPregunta, $usuario['id_usuario']);
			$respuesta = 0;
			if($resultado > 0)
				$respuesta = 1;
			echo json_encode($respuesta);
		}
	}

	public function modificarPregunta()
	{
		$usuario = $this->session->userdata();
		if($usuario){

			$usuario['titulo'] = 'Modificar Pregunta';
			$usuario['controller'] = 'pregunta';
			
			if($this->input->GET('idPregunta') && $this->input->GET('idPregunta'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idPregunta = $this->input->GET('idPregunta');
				$pregunta =  $this->pregunta_model->obtenerPregunta($idPregunta);
				$usuario['pregunta'] = $pregunta[0];
				
				//var_dump($equipo[0]);
				
				//$eacs = array_unique(array_column($equipo, 'nombre'), array_column($equipo, 'abreviacion'), array_column($equipo, 'descripcion'));
				//$eacs = array_unique(array_map("serialize", $equipo));
				//var_dump($temp);
				/*$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;*/
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarPregunta', $usuario);
			$this->load->view('temp/footer');
		}
	}
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campania extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('campania_model');
		$this->load->model('plantilla_model');
		$this->load->model('equipo_model');
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
		$usuario = $this->session->userdata();			
		if($usuario)
		{
			$analistas = $this->usuario_model->obtenerUsuariosAnalista($usuario["id_usuario"]);
			$usuario['analistas'] = $analistas;
			$usuario['controller'] = 'campania';
			mysqli_next_result($this->db->conn_id);
			$campanias = $this->usuario_model->listarCampaniasUsu($usuario["id_usuario"]);
			$usuario['campanias'] = $campanias;
			
			mysqli_next_result($this->db->conn_id);
			$equipos = $this->equipo_model->listarEquipos();
			$usuario['equipos'] = $equipos;

			$campanasUsuariosEquipos = $this->campania_model->listarCampaniasUsuariosEquipos($usuario["id_usuario"], 'null', 'null', 'null');
			$usuario['campanasUsuariosEquipos'] = $campanasUsuariosEquipos;
			//var_dump($campanasUsuariosEquipos);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('asignarCampania', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarCampanias()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$campanias = $this->campania_model->buscarCampania('');
			
			$usuario['campanias'] = $campanias;
			$usuario['controller'] = 'campania';
			//var_dump($campanias);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarCampanias', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function buscarCampania()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$campania = "";
			if($this->input->POST('campania'))
				$campania = $this->input->POST('campania');
			echo json_encode($this->campania_model->buscarCampania($campania));
		}
	}

	public function agregarCampania()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eacs = $this->campania_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;
		
		$plantillas = $this->plantilla_model->buscarPlantilla('');
		$usuario['plantillas'] = $plantillas;
		$usuario['titulo'] = 'Agregar Campania';
		$usuario['controller'] = 'campania';

		mysqli_next_result($this->db->conn_id);
		$tipoCampanias = $this->campania_model->buscarTipoCampania('');
		$usuario['tipoCampanias'] = $tipoCampanias;

		mysqli_next_result($this->db->conn_id);
		$empresas =  $this->usuario_model->obtenerEmpresasUsu($usuario["id_usuario"]);
		if($empresas)
		{
			$usuario['empresas'] = $empresas;
		}

		$this->load->view('temp/header');
		$this->load->view('temp/menu', $usuario);
		$this->load->view('agregarCampania', $usuario);
		$this->load->view('temp/footer', $usuario);
		}
	}

	public function guardarCampania()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombreCampania')) && trim($this->input->POST('nombreCampania')) != "")
			{
				if(!is_null($this->input->POST('idEmpresa')) && trim($this->input->POST('idEmpresa')) != "")
				{
					if(!is_null($this->input->POST('idTipoCampania')) && trim($this->input->POST('idTipoCampania')) != "")
					{
						$nombre = trim($this->input->POST('nombreCampania'));

						$tituloCampania = "null";
						if(!is_null($this->input->POST('tituloCampania')) && trim($this->input->POST('tituloCampania')) != "")
							$tituloCampania = trim($this->input->POST('tituloCampania'));

						$fechaInicio = "null";
						if(!is_null($this->input->POST('fechaInicio')) && trim($this->input->POST('fechaInicio')) != "")
							$fechaInicio = trim($this->input->POST('fechaInicio'));

						$fechaFin = "null";
						if(!is_null($this->input->POST('fechaFin')) && trim($this->input->POST('fechaFin')) != "")
							$fechaFin = trim($this->input->POST('fechaFin'));

						$cantEAC = "null";
						if(!is_null($this->input->POST('cantEAC')) && trim($this->input->POST('cantEAC')) != "")
							$cantEAC = trim($this->input->POST('cantEAC'));

						$cantDiasFase = "null";
						if(!is_null($this->input->POST('cantDiasFase')) && trim($this->input->POST('cantDiasFase')) != "")
							$cantDiasFase = trim($this->input->POST('cantDiasFase'));
						
						$cantDiasCiclo = "null";
						if(!is_null($this->input->POST('cantDiasCiclo')) && trim($this->input->POST('cantDiasCiclo')) != "")
							$cantDiasCiclo = trim($this->input->POST('cantDiasCiclo'));
						
						$cantCiclos = "null";
						if(!is_null($this->input->POST('cantCiclos')) && trim($this->input->POST('cantCiclos')) != "")
							$cantCiclos = trim($this->input->POST('cantCiclos'));

						$TMO = "null";
						if(!is_null($this->input->POST('TMO')) && trim($this->input->POST('TMO')) != "")
							$TMO = trim($this->input->POST('TMO'));
						
						$cantDiasdAntiguedadGab = "null";
						if(!is_null($this->input->POST('cantDiasdAntiguedadGab')) && trim($this->input->POST('cantDiasdAntiguedadGab')) != "")
							$cantDiasdAntiguedadGab = trim($this->input->POST('cantDiasdAntiguedadGab'));
						
						$cantGestionesCiclo = "null";
						if(!is_null($this->input->POST('cantGestionesCiclo')) && trim($this->input->POST('cantGestionesCiclo')) != "")
							$cantGestionesCiclo = trim($this->input->POST('cantGestionesCiclo'));
						
						$cantLlamados = "null";
						if(!is_null($this->input->POST('cantLlamados')) && trim($this->input->POST('cantLlamados')) != "")
							$cantLlamados = trim($this->input->POST('cantLlamados'));
						
						$muestra = "null";
						if(!is_null($this->input->POST('muestra')) && trim($this->input->POST('muestra')) != "")
							$muestra = trim($this->input->POST('muestra'));
						
						$codCampania = "null";
						if(!is_null($this->input->POST('codCampania')) && trim($this->input->POST('codCampania')) != "")	
							$codCampania = trim($this->input->POST('codCampania'));
						
						$observaciones = "null";
						if(!is_null($this->input->POST('observaciones')) && trim($this->input->POST('observaciones')) != "")
							$observaciones = trim($this->input->POST('observaciones'));
						
						$idPlantilla = "null";
						if(!is_null($this->input->POST('idPlantilla')) && trim($this->input->POST('idPlantilla')) != "")
							$idPlantilla = trim($this->input->POST('idPlantilla'));
						
						if(!is_null($this->input->POST('observacionesCampania')) && trim($this->input->POST('observacionesCampania')) != "")
							$observaciones = trim($this->input->POST('observacionesCampania'));
						
						$idTipoCampania = trim($this->input->POST('idTipoCampania'));
						$idEmpresa = trim($this->input->POST('idEmpresa'));
						$accion = 'agregado';

						$idCampania = 'null';
						if(!is_null($this->input->POST('idCampania')) && is_numeric($this->input->POST('idCampania')))
						{
							$idCampania = $this->input->POST('idCampania');
							$accion = 'modificado';
						}
					}else
					{
						$mensaje = 'Favor seleccione un Tipo de Campa&ntilde;a.';
					}
				}else
				{
					$mensaje = 'Favor seleccione una Empresa para la Campa&ntilde;a.';
				}
			}else
			{
				$mensaje = 'Favor ingrese un Nombre de Campa&ntilde;a.';
			}

			$respuesta = 0;
			$mensaje = '';

			$resultado = $this->campania_model->guardarCampania($idCampania, $nombre, $tituloCampania, $fechaInicio, $fechaFin, $cantEAC, $cantDiasFase, $cantDiasCiclo, $cantCiclos, $TMO, $cantDiasdAntiguedadGab, $cantLlamados, $muestra, $codCampania, $observaciones, $idPlantilla, $idTipoCampania, $idEmpresa, $cantGestionesCiclo, $usuario["id_usuario"]);
			
			if($resultado > 0)
			{
				if($resultado[0]['idCampania'])
				{
					if($idCampania == 'null')
						$idCampania = (int)$resultado[0]['idCampania'];
					$respuesta = 1;
					$mensaje = 'Se ha '.$accion.' el campania exitosamente.';
				}
			}else
			{
				if($resultado === 0)
				{
					$mensaje = 'Ha ocurrido un error al modificar el campania, el campania no se encuentra registrado.';
				}
			}
			$data['respuesta'] = $respuesta;
			$data['mensaje'] = $mensaje;
			echo json_encode($data);

			
		}
	}

	public function eliminarCampania()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$idCampania = null;
			if($this->input->POST('idCampania'))
				$idCampania = $this->input->POST('idCampania');
			$resultado = $this->campania_model->eliminarCampania($idCampania, $usuario['id_usuario']);
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
			
			$eacs = $this->campania_model->buscarEAC($eac);
		}
		echo json_encode($eacs);
	}

	public function filtrarUsuCampEqui()
	{
		$usuario = $this->session->userdata();			
		if($usuario)
		{
			$analista = "null";
			$campania = "null";
			$equipo = "null";
			if (!is_null($this->input->POST('analista')) && $this->input->POST('analista') != "" && $this->input->POST('analista') != -1)
				$analista = $this->input->POST('analista');

			if(!is_null($this->input->POST('campania')) && $this->input->POST('campania') != "" && $this->input->POST('campania') != -1)
				$campania = $this->input->POST('campania');

			if(!is_null($this->input->POST('equipo')) && $this->input->POST('equipo') != "" && $this->input->POST('equipo') != -1)
				$equipo = $this->input->POST('equipo');
			
			$datos[] = array();
			unset($datos);
			$usuCampEqui = $this->campania_model->listarCampaniasUsuariosEquipos($usuario['id_usuario'], $analista, $campania, $equipo);
			
			$datos['usuCampEqui'] = $usuCampEqui;
		}

		echo json_encode($datos);
	}
	
	
}

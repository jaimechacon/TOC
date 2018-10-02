<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantilla extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('plantilla_model');
		$this->load->model('categoria_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'plantilla';

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPlantillas', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarPlantillas()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$plantillas = $this->plantilla_model->buscarPlantilla('');
			$usuario['plantillas'] = $plantillas;
			$usuario['controller'] = 'plantilla';
			//var_dump($plantillas);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPlantillas', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function buscarPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$plantilla = "";
			if($this->input->POST('plantilla'))
				$plantilla = $this->input->POST('plantilla');
			echo json_encode($this->plantilla_model->buscarPlantilla($plantilla));
		}
	}

	public function agregarPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			/*$eacs = $this->plantilla_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;*/
		$idPlantilla = 'null';
		$resultado = $this->plantilla_model->guardarPlantilla($idPlantilla, 'temporal', 'temporal', 1, $usuario['id_usuario']);
		if($resultado[0] > 0)
		{
			if($resultado[0]['idPlantilla'])
			{
				if($idPlantilla == 'null')
					$idPlantilla = (int)$resultado[0]['idPlantilla'];
				
				$usuario['idPlantilla'] = $idPlantilla;
			}
		}

		mysqli_next_result($this->db->conn_id);
		$categorias = $this->categoria_model->listarCategorias();
		$usuario['categorias'] = $categorias;

		$usuario['titulo'] = 'Agregar Plantilla';
		$usuario['controller'] = 'plantilla';

		$this->load->view('temp/header');
		$this->load->view('temp/menu', $usuario);
		$this->load->view('agregarPlantilla', $usuario);
		$this->load->view('temp/footer', $usuario);
		}
	}

	public function obtenerIdPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			/*$eacs = $this->plantilla_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;*/
			$idPlantilla = 'null';
			
			$resultado = $this->plantilla_model->guardarPlantilla($idPlantilla, 'temporal', 'temporal', 1, $usuario['id_usuario']);
			if($resultado[0] > 0)
			{
				if($resultado[0]['idPlantilla'])
				{
					if($idPlantilla == 'null')
						$idPlantilla = (int)$resultado[0]['idPlantilla'];
				}
			}
		}
		echo $idPlantilla;
	}

	public function guardarPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombrePlantilla')))
			{
				//if(!is_null($this->input->POST('abreviacionPlantilla')))
				//{
					$nombre = trim($this->input->POST('nombrePlantilla'));
					//$abreviacion = trim($this->input->POST('abreviacionPlantilla'));
					$observaciones = "";
					//$eacs[] = array();
					$accion = 'agregado';
					//unset($eacs);
					if(!is_null($this->input->POST('observacionesPlantilla')))
						$observaciones = trim($this->input->POST('observacionesPlantilla'));
					/*if(!is_null($this->input->POST('eacsPlantilla')))
						$eacs = $this->input->POST('eacsPlantilla');*/
					$idPlantilla = 'null';
/*
					var_dump($this->input->POST('idPlantilla'));
					echo '----';
					var_dump(is_null($this->input->POST('idPlantilla')));
					echo '----';
					var_dump(is_numeric($this->input->POST('idPlantilla')));
					echo '----';*/
					if(!is_null($this->input->POST('idPlantilla')) && is_numeric($this->input->POST('idPlantilla')))
						$idPlantilla = $this->input->POST('idPlantilla');

					if(!is_null($this->input->POST('esAgregado')) && is_numeric($this->input->POST('esAgregado')) && (int)$this->input->POST('esAgregado') != 1)
							$accion = 'modificado';

					$respuesta = 0;
					$cantEacs = 0;
					$mensaje = '';

					//var_dump($idPlantilla, $nombre, $abreviacion, $observaciones);
					//mysqli_next_result($this->db->conn_id);

					$resultado = $this->plantilla_model->guardarPlantilla($idPlantilla, $nombre, $observaciones, 0, $usuario["id_usuario"]);
					//var_dump($resultado);
					if($resultado[0] > 0)
					{
						//var_dump($resultado[0]);
						if($resultado[0]['idPlantilla'])
						{
							if($idPlantilla == 'null')
								$idPlantilla = (int)$resultado[0]['idPlantilla'];

							//var_dump($resultado[0]);
							$respuesta = 1;
							$mensaje = 'Se ha '.$accion.' el plantilla exitosamente.';
							/*if(isset($eacs))
							{
								$cantEAC = sizeof($eacs);
								if($cantEAC > 0)
								{
									mysqli_next_result($this->db->conn_id);
									$resultadoEEAC = $this->plantilla_model->eliminarEACPlantilla($idPlantilla, $usuario["id_usuario"]);

									if($resultadoEEAC > 0)
									{
										foreach ($eacs as $eac) {
										if(is_numeric($eac))
										{
											mysqli_next_result($this->db->conn_id);
											$resultadoEAC = $this->plantilla_model->guardarEACPlantilla($idPlantilla, (int)$eac, $usuario["id_usuario"]);
											//var_dump($resultadoEAC);
											if($resultadoEAC > 0)
											{
												$cantEacs ++;
											}else{
												$respuesta = 0;
											}
										}	
									}

									$mensaje = $mensaje.' Se han insertado '.$cantEacs.' EAC al plantilla.';
									}
								}
							}*/
						}
					}else
					{
						if($resultado === 0)
						{
							$mensaje = 'Ha ocurrido un error al modificar el plantilla, el plantilla no se encuentra registrado.';
						}
					}
					$data['respuesta'] = $respuesta;
					$data['eacs'] = $cantEacs;
					$data['mensaje'] = $mensaje;
					echo json_encode($data);
				//}
			}
		}
	}

	public function eliminarPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$idPlantilla = null;
			if($this->input->POST('idPlantilla'))
				$idPlantilla = $this->input->POST('idPlantilla');
			$resultado = $this->plantilla_model->eliminarPlantilla($idPlantilla, $usuario['id_usuario']);
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
			
			$eacs = $this->plantilla_model->buscarEAC($eac);
		}
		echo json_encode($eacs);
	}

	public function modificarPlantilla()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$eacs = $this->plantilla_model->listarEAC();
			if($eacs)
				$usuario['eacs'] = $eacs;

			$usuario['titulo'] = 'Modificar Plantilla';
			$usuario['controller'] = 'plantilla';
			if($this->input->GET('idPlantilla') && $this->input->GET('idPlantilla'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idPlantilla = $this->input->GET('idPlantilla');
				$plantilla =  $this->plantilla_model->obtenerPlantilla($idPlantilla);
				$usuario['plantilla'] = $plantilla[0];
				//var_dump($plantilla[0]);
				$eacsPlantilla = array_unique(array_column($plantilla, 'id_usuario'));
				$usuario['eacsPlantilla'] = $eacsPlantilla;
				//$eacs = array_unique(array_column($plantilla, 'nombre'), array_column($plantilla, 'abreviacion'), array_column($plantilla, 'descripcion'));
				//$eacs = array_unique(array_map("serialize", $plantilla));
				//var_dump($temp);
				/*$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;*/
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarPlantilla', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}
	
}
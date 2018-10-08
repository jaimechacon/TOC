<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantilla extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('plantilla_model');
		$this->load->model('categoria_model');
		$this->load->model('pregunta_model');
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
		$preguntas = $this->pregunta_model->listarPreguntas();
		$usuario['preguntas'] = $preguntas;

		//mysqli_next_result($this->db->conn_id);
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
				$nombre = trim($this->input->POST('nombrePlantilla'));
				$observaciones = "";
				
				$accion = 'agregado';
				if(!is_null($this->input->POST('observacionesPlantilla')))
					$observaciones = trim($this->input->POST('observacionesPlantilla'));
				
				$idPlantilla = 'null';
				$categoriasPreguntas[] = array();
				unset($categoriasPreguntas);

				if(!is_null($this->input->POST('categoriasPreguntasPlantilla')))
					$categoriasPreguntas = $this->input->POST('categoriasPreguntasPlantilla');

				if(!is_null($this->input->POST('idPlantilla')) && is_numeric($this->input->POST('idPlantilla')))
					$idPlantilla = $this->input->POST('idPlantilla');

				if(!is_null($this->input->POST('esAgregado')) && is_numeric($this->input->POST('esAgregado')) && (int)$this->input->POST('esAgregado') != 1)
						$accion = 'modificado';



				$respuesta = 0;
				$cantCat = 0;
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
						$mensaje = 'Se ha '.$accion.' la plantilla exitosamente.';

						if(isset($categoriasPreguntas))
						{
							$cantCat = sizeof($categoriasPreguntas);
							if($cantCat > 0)
							{
								//var_dump($categoriasPreguntas);
								mysqli_next_result($this->db->conn_id);
								$resultadoECatPre = $this->plantilla_model->eliminarCatPrePlantilla($idPlantilla, $usuario["id_usuario"]);

								$cantPre = 0;

								if($resultadoECatPre > 0)
								{
									foreach ($categoriasPreguntas as $cat) {
									
									if(is_numeric($cat[0]))
									{
										$idCategoria = (int)$cat[0];
										$nombreCategoria = trim($cat[1]);
										$preguntas = $cat[2];

										if(sizeof($preguntas) > 0)
										{
											foreach ($preguntas as $pregunta) {
												mysqli_next_result($this->db->conn_id);
												$resultadoPAP = $this->plantilla_model->guardarCatPrePlantilla($idPlantilla, $idCategoria, $pregunta, $cantPre, $usuario["id_usuario"]);

												//var_dump($idPlantilla.' - '.$idCategoria.' - '.(int)$pregunta.' - '.(int)$cantPre);
										//var_dump($resultadoEAC);
												if($resultadoPAP > 0)
												{
													$cantPre ++;
												}else{
													$respuesta = 0;
												}
											}
										}

										
										//mysqli_next_result($this->db->conn_id);
										
									}
								}

								$mensaje = $mensaje.' Se han insertado '.$cantCat.' Categorias y '.$cantPre.' Preguntas a la Plantilla.';
								}
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
				$data['cantCat'] = $cantCat;
				$data['cantPre'] = $cantPre;
				$data['mensaje'] = $mensaje;
				echo json_encode($data);
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
			$usuario['titulo'] = 'Modificar Plantilla';
			$usuario['controller'] = 'plantilla';
			if($this->input->GET('idPlantilla') && $this->input->GET('idPlantilla'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idPlantilla = $this->input->GET('idPlantilla');
				$resultadoPlantilla =  $this->plantilla_model->obtenerPlantilla($idPlantilla);
				$plantilla = $this->obtener_categoriasPreguntas($resultadoPlantilla);
				//var_dump($plantilla);
				$usuario['plantilla'] = $plantilla;
				mysqli_next_result($this->db->conn_id);
				$preguntas = $this->pregunta_model->listarPreguntas();
				$usuario['preguntas'] = $preguntas;

				//mysqli_next_result($this->db->conn_id);
				$categorias = $this->categoria_model->listarCategorias();
				$usuario['categorias'] = $categorias;


				//var_dump($plantilla);
				//$categoriasPreguntasPlantilla = array_unique(array_column($plantilla, 'id_categoria'));
				//$cat = array_unique(array_column($plantilla, 'id_categoria'));
				//var_dump(array_merge($plantilla, array_flatten('id_categoria')));
				//var_dump($cat);
				//$usuario['eacsPlantilla'] = $eacsPlantilla;

				//$CategoriasPreguntas = $this->plantilla_model->listarCategoriasPreguntasPlantilla($idPlantilla);
				//if($CategoriasPreguntas)
					//$usuario['CategoriasPreguntas'] = $CategoriasPreguntas;
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

	public function listarPreguntas()
	{
		$usuario = $this->session->userdata();
		$preguntas = "";
		if($usuario){
			$preguntas = $this->pregunta_model->listarPreguntas();
		}
		echo json_encode($preguntas);
	}
	
	private function obtener_categoriasPreguntas($categoriasPreguntasPlantilla)
	{
		$plantilla[] = array();
		unset($plantilla);
		$plantilla['id_plantilla'] = $categoriasPreguntasPlantilla[0]['id_plantilla'];
		$plantilla['nombre'] = $categoriasPreguntasPlantilla[0]['nombre'];
		$plantilla['descripcion'] = $categoriasPreguntasPlantilla[0]['descripcion'];
		$plantilla['cantCategorias'] = sizeof(array_unique(array_column($categoriasPreguntasPlantilla, 'id_categoria')));
		$plantilla['categorias'] = array();

		$categorias[] = array();
		unset($categorias);
		$cont = 0;

		$listaCategorias = '';
		$listaPreguntas = '';
		foreach ($categoriasPreguntasPlantilla as $categoria) {
			$cat[] = array();
			unset($cat);
			$pregunta[] = array();
			unset($pregunta);
			$cat['id_categoria'] = $categoria['id_categoria'];
			$cat['nombreCategoria'] = $categoria['cat_nombre'];
			$cat['preguntas'] = array();

			$pregunta['id_pregunta'] = $categoria['id_pregunta'];
			$pregunta['pre_nombre'] = $categoria['pre_nombre'];
			$pregunta['pre_orden'] = $categoria['pca_orden'];

			if(!isset($categorias))
			{
				$listaCategorias = $cat['id_categoria'];
				$listaPreguntas = $pregunta['id_pregunta'];
				$cat['preguntas'] = [$pregunta];
				$categorias[$cont] = $cat;
				$cont++;
			}else
			{
				$catInsertadas = array_column($categorias, 'id_categoria', 'nombreCategoria');
				if(!in_array($cat['id_categoria'], $catInsertadas))
				{
					$categorias[$cont-1]['listaPreguntas'] = $listaPreguntas;

					//var_dump($categorias[$cont-1]);
					//var_dump($listaPreguntas);
					//$catetorias[$cont-1]['listaPreguntas'] = $listaPreguntas;
					$listaCategorias = $listaCategorias.','.$cat['id_categoria'];
					$listaPreguntas = $pregunta['id_pregunta'];
					$cat['preguntas'] = [$pregunta];
					$categorias[$cont] = $cat;
					$cont++;
				}else
				{
					$listaPreguntas = $listaPreguntas.','.$pregunta['id_pregunta'];
					array_push($categorias[$cont-1]['preguntas'], $pregunta);
				}				
			}
		}

		$categorias[$cont-1]['listaPreguntas'] = $listaPreguntas;
		$plantilla['categorias'] = $categorias;
		$plantilla['listaCategorias'] = $listaCategorias;
		//var_dump($plantilla);
		return $plantilla;
	}
}
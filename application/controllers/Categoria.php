<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categoria_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarCategorias', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarCategorias()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$categorias = $this->categoria_model->listarCategorias();
			$usuario['categorias'] = $categorias;
			$usuario['controller'] = 'categoria';
			//var_dump($categorias);
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarCategorias', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function buscarCategoria()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$categoria = "";
			if($this->input->POST('categoria'))
				$categoria = $this->input->POST('categoria');
			echo json_encode($this->categoria_model->buscarCategoria($categoria));
		}
	}

	public function agregarCategoria()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['titulo'] = 'Agregar Categoria';
			$usuario['controller'] = 'categoria';

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarCategoria', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function guardarCategoria()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombreCategoria')))
			{
				if(!is_null($this->input->POST('puntuacionCategoria')))
				{
					$nombre = trim($this->input->POST('nombreCategoria'));
					$puntuacion = trim($this->input->POST('puntuacionCategoria'));
					$observaciones = "";
					$accion = 'agregado';
					if(!is_null($this->input->POST('observacionesCategoria')))
						$observaciones = trim($this->input->POST('observacionesCategoria'));
					$idCategoria = 'null';

					if(!is_null($this->input->POST('idCategoria')) && is_numeric($this->input->POST('idCategoria')))
					{
						$idCategoria = $this->input->POST('idCategoria');
						$accion = 'modificado';
					}

					$respuesta = 0;
					$mensaje = '';

					$resultado = $this->categoria_model->guardarCategoria($idCategoria, $nombre, $puntuacion, $observaciones, $usuario["id_usuario"]);

					if($resultado[0] > 0)
					{

						if($resultado[0]['idCategoria'])
						{
							if($idCategoria == 'null')
								$idCategoria = (int)$resultado[0]['idCategoria'];
							
							$respuesta = 1;
							$mensaje = 'Se ha '.$accion.' la categor&iacute;a exitosamente.';
						}
					}else
					{
						if($resultado === 0)
						{
							$mensaje = 'Ha ocurrido un error al '.$accion.' la categor&iacute;a, la categor&iacute;a no se encuentra registrado.';
						}
					}
					$data['respuesta'] = $respuesta;
					$data['mensaje'] = $mensaje;
					echo json_encode($data);
				}
			}
		}
	}

	public function eliminarCategoria()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$idCategoria = null;
			if($this->input->POST('idCategoria'))
				$idCategoria = $this->input->POST('idCategoria');
			$resultado = $this->categoria_model->eliminarCategoria($idCategoria, $usuario['id_usuario']);
			$respuesta = 0;
			if($resultado > 0)
				$respuesta = 1;
			echo json_encode($respuesta);
		}
	}

	public function modificarCategoria()
	{
		$usuario = $this->session->userdata();
		if($usuario){

			$usuario['titulo'] = 'Modificar Categoria';
			$usuario['controller'] = 'categoria';

			if($this->input->GET('idCategoria') && $this->input->GET('idCategoria'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idCategoria = $this->input->GET('idCategoria');
				$categoria =  $this->categoria_model->obtenerCategoria($idCategoria);
				$usuario['categoria'] = $categoria[0];
				
				//var_dump($equipo[0]);
				
				//$eacs = array_unique(array_column($equipo, 'nombre'), array_column($equipo, 'abreviacion'), array_column($equipo, 'descripcion'));
				//$eacs = array_unique(array_map("serialize", $equipo));
				//var_dump($temp);
				/*$cat_pauta = array_intersect_key($pauta, $temp);
				$usuario['cat_pauta'] = $cat_pauta;*/
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarCategoria', $usuario);
			$this->load->view('temp/footer');
		}
	}
	
}
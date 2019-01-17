<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reporte_model');
		$this->load->model('institucion_model');
		$this->load->model('hospital_model');
		$this->load->model('cuenta_model');
		$this->load->model('item_model');
		$this->load->model('asignacion_model');
		$this->load->model('pago_model');
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($this->session->userdata('id_usuario')){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('inicio', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			redirect('Inicio');
		}
	}

	public function listarPagos()
	{
		$usuario = $this->session->userdata();
		
		if($this->session->userdata('id_usuario'))
		{
			$usuario['controller'] = 'pago';

			$idInstitucion = "null";
			$idArea = "null";

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			if(!is_null($this->input->GET('idInstitucion')) && $this->input->GET('idInstitucion'))
			{
            	$idInstitucion = $this->input->GET('idInstitucion');
            	$usuario['idInstitucion'] = $idInstitucion;
			}

			if(!is_null($this->input->GET('idArea')) && $this->input->GET('idArea'))
			{
            	$idArea = $this->input->GET('idArea');
            	$usuario['idHospital'] = $idArea;
            }

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			mysqli_next_result($this->db->conn_id);
			$pagos = $this->pago_model->listarPagos($usuario["id_usuario"]);
			if($pagos)
				$usuario["pagos"] = $pagos;

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPagos', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			redirect('Login');
		}
	}	
}

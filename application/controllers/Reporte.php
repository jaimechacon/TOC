<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reporte_model');
		$this->load->model('institucion_model');
		$this->load->model('hospital_model');
		$this->load->model('cuenta_model');
		$this->load->model('item_model');
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReporte', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	public function listarReportes()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'reporte';

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], "null");
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumen($usuario["id_usuario"], "null", "null", "null");
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenGasto($usuario["id_usuario"], "null", "null", "null");
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportes', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}
	
	public function listarHospitalesInstitucion()
	{
		$usuario = $this->session->userdata();
		$hospitales = [];
		if($usuario)
		{
			$institucion = "null";
			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $institucion);
		}
		echo json_encode($hospitales);
	}

	public function listarReporteResumen()
	{
		$usuario = $this->session->userdata();
		$reporteResumenes = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			$reporteResumenes = $this->reporte_model->listarReporteResumen($usuario["id_usuario"], $institucion, $hospital, $cuenta);
		}
		echo json_encode($reporteResumenes);
	}

	public function listarReporteResumenGasto()
	{
		$usuario = $this->session->userdata();
		$reporteResumenesGastos = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenGasto($usuario["id_usuario"], $institucion, $hospital, $cuenta);
		}
		echo json_encode($reporteResumenesGastos);
	}
	
}

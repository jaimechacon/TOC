<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends CI_Controller {

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
			$idPrincipal = "null";

			$instituciones = $this->institucion_model->listarInstitucionesUsuPagos($usuario["id_usuario"]);
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
			$hospitales = $this->hospital_model->listarHospitalesUsuPagos($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			mysqli_next_result($this->db->conn_id);
			$principales = $this->pago_model->listarPrincipalesUsu($usuario["id_usuario"], $idInstitucion, $idArea);
			if($principales)
				$usuario["principales"] = $principales;

			if(sizeof($principales) == 1)
				$idPrincipal = $principales[0]["id_principal"];

			mysqli_next_result($this->db->conn_id);
			$mesesAnios = $this->pago_model->obtenerAniosPagos();
			$anios[] = array();
         	unset($anios[0]);

     		foreach ($mesesAnios as $mesAnio) {

				$anioEncontrado = array();
         		unset($anioEncontrado);

         		$anioEncontrado['idAnio'] = $mesAnio['idAnio'];
         		$anioEncontrado['nombreAnio'] = $mesAnio['nombreAnio'];

         		if(!in_array($anioEncontrado, $anios))
                	array_push($anios, $anioEncontrado);
			}
			$usuario['anios'] = $anios;

			$meses[] = array();
         	unset($meses[0]);

			foreach ($mesesAnios as $mes) {	

				$mesEncontrado = array();
         		unset($mesEncontrado);

         		$mesEncontrado['idMes'] = $mes['idMes'];
         		$mesEncontrado['nombreMes'] = $mes['nombreMes'];

         		if(!in_array($mesEncontrado, $meses))
                	array_push($meses, $mesEncontrado);
			}

			mysqli_next_result($this->db->conn_id);
			$pagos = $this->pago_model->listarPagos($usuario["id_usuario"], $idInstitucion, $idArea, $idPrincipal, $mesesAnios[0]["mesSeleccionado"], $mesesAnios[0]["anioSeleccionado"]);
			if($pagos)
				$usuario["pagos"] = $pagos;

			$usuario['meses'] = $meses;
			$usuario['anioSeleccionado'] = $mesesAnios[0]["anioSeleccionado"];
			$usuario['mesSeleccionado'] = $mesesAnios[0]["mesSeleccionado"];

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarPagos', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			redirect('Login');
		}
	}


	public function listarPagosFiltrados()
	{
		$usuario = $this->session->userdata();
		$pagos = [];
		if($this->session->userdata('id_usuario'))
		{
			$institucion = "null";
			$hospital = "null";
			$mes = "null";
			$anio = "null";
			$proveedor = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('proveedor')) && $this->input->post('proveedor') != "-1")
				$proveedor = $this->input->post('proveedor');

			if(is_null($this->input->post('proveedor')))
			{
				$principales = $this->pago_model->listarPrincipalesUsu($usuario["id_usuario"], 'null', 'null');
				if($principales && sizeof($principales) == 1 && $principales[0]["dedicado"] == 1)
					$proveedor = $principales[0]["id_principal"];
			}


			if(!is_null($this->input->post('mes')) && $this->input->post('mes') != "-1")
				$mes = $this->input->post('mes');

			if(!is_null($this->input->post('anio')) && $this->input->post('anio') != "-1")
				$anio = $this->input->post('anio');

			mysqli_next_result($this->db->conn_id);
			$pagos = $this->pago_model->listarPagos($usuario["id_usuario"], $institucion, $hospital, $proveedor, $mes, $anio);

			echo json_encode($pagos);
		}
		else
		{
			redirect('Login');
		}
	}

	public function listarHospitalesInstitucion()
	{
		$usuario = $this->session->userdata();
		$hospitales = [];
		if($this->session->userdata('id_usuario'))
		{
			$institucion = "null";
			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			$hospitales = $this->hospital_model->listarHospitalesUsuPagos($usuario["id_usuario"], $institucion);
			echo json_encode($hospitales);
		}else
		{
			redirect('Login');
		}
	}

	public function listarProveedores()
	{
		$usuario = $this->session->userdata();
		$proveedores = [];
		if($this->session->userdata('id_usuario'))
		{
			$institucion = "null";
			$hospital = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			$proveedores = $this->pago_model->listarPrincipalesUsu($usuario["id_usuario"], $institucion, $hospital);

			echo json_encode($proveedores);
		}
		else
		{
			redirect('Login');
		}
	}	
}

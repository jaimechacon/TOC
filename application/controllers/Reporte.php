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
		$this->load->model('asignacion_model');
		$this->load->model('sub_asignacion_model');
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('inicio', $usuario);
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

			/*mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;*/

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumen($usuario["id_usuario"], $idInstitucion, $idArea, "null");
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenGasto($usuario["id_usuario"], $idInstitucion, $idArea, "null");
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesTipo = $this->reporte_model->listarReporteResumenTipo($usuario["id_usuario"], $idInstitucion, $idArea, "null");
			if($reporteResumenesTipo)
				$usuario["reporteResumenesTipo"] = $reporteResumenesTipo;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesTipoGasto = $this->reporte_model->listarReporteResumenTipoGasto($usuario["id_usuario"], $idInstitucion, $idArea, "null");
			if($reporteResumenesTipoGasto)
				$usuario["reporteResumenesTipoGasto"] = $reporteResumenesTipoGasto;

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportes', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function listarReportesItem()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'reporte';

			$idInstitucion = "null";
			$idArea = "null";
			$idCuenta = "null";

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

			if(!is_null($this->input->GET('idCuenta')) && $this->input->GET('idCuenta') != "")
            {
            	$idCuenta = $this->input->GET('idCuenta');
			}

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			/*mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;*/

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumenItem($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, 2);
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenItem($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, 1);
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			if($idCuenta != "null")
			{
				mysqli_next_result($this->db->conn_id);
				$cuenta = $this->cuenta_model->obtenerCuenta($idCuenta);
				$usuario['cuentaSeleccion'] = $cuenta[0];
			}else{
				$cuentaSeleccion["id_cuenta"] = "null";
				$cuentaSeleccion["codigo"] = "";
				$cuentaSeleccion["nombre"] = "SIN DESCRIPCI&Oacute;N DE ITEM";
				$usuario['cuentaSeleccion'] = $cuentaSeleccion;
			}			

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportesItem', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function listarReportesAsignacion()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'reporte';

			$idInstitucion = "null";
			$idArea = "null";
			$idCuenta = "null";
			$idItem = "null";

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

			if(!is_null($this->input->GET('idCuenta')) && $this->input->GET('idCuenta') != "")
            {
            	$idCuenta = $this->input->GET('idCuenta');
			}

			if(!is_null($this->input->GET('idItem')) && $this->input->GET('idItem') != "")
            {
            	$idItem = $this->input->GET('idItem');
			}

			$usuario['idCuenta'] = $idCuenta;

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			/*mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;*/

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumenAsignacion($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, 2);
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenAsignacion($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, 1);
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			if($idItem != "null")
			{
				mysqli_next_result($this->db->conn_id);
				$item = $this->item_model->obtenerItem($idItem);
				$usuario['itemSeleccion'] = $item[0];
			}else{
				$itemSeleccion["id_item"] = "null";
				$itemSeleccion["codigo"] = "";
				$itemSeleccion["nombre"] = "SIN DESCRIPCI&Oacute;N DE ASIGNACION";
				$usuario['itemSeleccion'] = $itemSeleccion;
			}
			

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportesAsignacion', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}
	
	public function listarReportesSubAsignacion()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'reporte';

			$idInstitucion = "null";
			$idArea = "null";
			$idCuenta = "null";
			$idItem = "null";
			$idAsignacion = "null";

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

			if(!is_null($this->input->GET('idCuenta')) && $this->input->GET('idCuenta') != "")
            {
            	$idCuenta = $this->input->GET('idCuenta');
			}

			if(!is_null($this->input->GET('idItem')) && $this->input->GET('idItem') != "")
            {
            	$idItem = $this->input->GET('idItem');
			}

			if(!is_null($this->input->GET('idAsignacion')) && $this->input->GET('idAsignacion') != "")
            {
            	$idAsignacion = $this->input->GET('idAsignacion');
			}

			$usuario['idCuenta'] = $idCuenta;
			$usuario['idItem'] = $idItem;
			//var_dump($usuario);

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			/*mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;*/

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumenSubAsignacion($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, $idAsignacion, 2);
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenSubAsignacion($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, $idAsignacion, 1);
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			if($idAsignacion != "null")
			{
				mysqli_next_result($this->db->conn_id);
				$asignacion = $this->asignacion_model->obtenerAsignacion($idAsignacion);
				$usuario['asignacionSeleccion'] = $asignacion[0];
			}else{
				$asignacionSeleccion["id_asignacion"] = "null";
				$asignacionSeleccion["codigo"] = "";
				$asignacionSeleccion["nombre"] = "SIN DESCRIPCION DE ASIGNACION";
				$usuario['asignacionSeleccion'] = $asignacionSeleccion;
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportesSubAsignacion', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function listarReportesEspecifico()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['controller'] = 'reporte';

			$idInstitucion = "null";
			$idArea = "null";
			$idCuenta = "null";
			$idItem = "null";
			$idAsignacion = "null";
			$idSubAsignacion = "null";

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

			if(!is_null($this->input->GET('idCuenta')) && $this->input->GET('idCuenta') != "")
            {
            	$idCuenta = $this->input->GET('idCuenta');
			}

			if(!is_null($this->input->GET('idItem')) && $this->input->GET('idItem') != "")
            {
            	$idItem = $this->input->GET('idItem');
			}

			if(!is_null($this->input->GET('idAsignacion')) && $this->input->GET('idAsignacion') != "")
            {
            	$idAsignacion = $this->input->GET('idAsignacion');
			}

			if(!is_null($this->input->GET('idSubAsignacion')) && $this->input->GET('idSubAsignacion') != "")
            {
            	$idSubAsignacion = $this->input->GET('idSubAsignacion');
			}

			$usuario['idCuenta'] = $idCuenta;
			$usuario['idItem'] = $idItem;
			$usuario['idAsignacion'] = $idAsignacion;

			$instituciones = $this->institucion_model->listarInstitucionesUsu($usuario["id_usuario"]);
			if($instituciones)
				$usuario["instituciones"] = $instituciones;

			mysqli_next_result($this->db->conn_id);
			$hospitales = $this->hospital_model->listarHospitalesUsu($usuario["id_usuario"], $idInstitucion);
			if($hospitales)
				$usuario["hospitales"] = $hospitales;

			/*mysqli_next_result($this->db->conn_id);
			$cuentas = $this->cuenta_model->listarCuentasUsu($usuario["id_usuario"]);
			if($cuentas)
				$usuario["cuentas"] = $cuentas;

			mysqli_next_result($this->db->conn_id);
			$items = $this->item_model->listarItemsUsu($usuario["id_usuario"], "null");
			if($items)
				$usuario["items"] = $items;*/

			mysqli_next_result($this->db->conn_id);
			$reporteResumenes = $this->reporte_model->listarReporteResumenEspecifico($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, $idAsignacion, $idSubAsignacion, 2);
			if($reporteResumenes)
				$usuario["reporteResumenes"] = $reporteResumenes;

			mysqli_next_result($this->db->conn_id);
			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenEspecifico($usuario["id_usuario"], $idInstitucion, $idArea, $idCuenta, $idItem, $idAsignacion, $idSubAsignacion, 1);
			if($reporteResumenesGastos)
				$usuario["reporteResumenesGastos"] = $reporteResumenesGastos;

			if($idSubAsignacion != "null")
			{
				mysqli_next_result($this->db->conn_id);
				$subAsignacion = $this->sub_asignacion_model->obtenerSubAsignacion($idSubAsignacion);
				$usuario['subasignacionSeleccion'] = $subAsignacion[0];
			}else{
				$subasignacionSeleccion["id_sub_asignacion"] = "null";
				$subasignacionSeleccion["codigo"] = "";
				$subasignacionSeleccion["nombre"] = "SIN DESCRIPCIÓN DE ASIGNACION";
				$usuario['subasignacionSeleccion'] = $subasignacionSeleccion;
			}			

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarReportesEspecifico', $usuario);
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

	public function listarReporteResumenItem()
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

			$reporteResumenes = $this->reporte_model->listarReporteResumenItem($usuario["id_usuario"], $institucion, $hospital, $cuenta, 2);
		}
		echo json_encode($reporteResumenes);
	}

	public function listarReporteResumenAsignacion()
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

			$reporteResumenes = $this->reporte_model->listarReporteResumenAsignacion($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, 2);
		}
		echo json_encode($reporteResumenes);
	}

	public function listarReporteResumenSubAsignacion()
	{
		$usuario = $this->session->userdata();
		$reporteResumenes = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";
			$asignacion = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			if(!is_null($this->input->post('asignacion')) && $this->input->post('asignacion') != "-1")
				$asignacion = $this->input->post('asignacion');

			$reporteResumenes = $this->reporte_model->listarReporteResumenSubAsignacion($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, $asignacion, 2);
		}
		echo json_encode($reporteResumenes);
	}

	public function listarReporteResumenEspecifico()
	{
		$usuario = $this->session->userdata();
		$reporteResumenes = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";
			$asignacion = "null";
			$subAsignacion = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			if(!is_null($this->input->post('asignacion')) && $this->input->post('asignacion') != "-1")
				$asignacion = $this->input->post('asignacion');

			if(!is_null($this->input->post('subAsignacion')) && $this->input->post('subAsignacion') != "-1")
				$subAsignacion = $this->input->post('subAsignacion');

			$reporteResumenes = $this->reporte_model->listarReporteResumenEspecifico($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, $asignacion, $subAsignacion, 2);
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

	public function listarReporteResumenItemGasto()
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

			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenItem($usuario["id_usuario"], $institucion, $hospital, $cuenta, 1);
		}
		echo json_encode($reporteResumenesGastos);
	}

	public function listarReporteResumenAsignacionGasto()
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

			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenAsignacion($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, 1);
		}
		echo json_encode($reporteResumenesGastos);
	}

	public function listarReporteResumenSubAsignacionGasto()
	{
		$usuario = $this->session->userdata();
		$reporteResumenesGastos = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";
			$asignacion = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			if(!is_null($this->input->post('asignacion')) && $this->input->post('asignacion') != "-1")
				$asignacion = $this->input->post('asignacion');

			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenSubAsignacion($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, $asignacion, 1);
		}
		echo json_encode($reporteResumenesGastos);
	}

	public function listarReporteResumenEspecificoGasto()
	{
		$usuario = $this->session->userdata();
		$reporteResumenesGastos = [];
		if($usuario)
		{
			$institucion = "null";
			$hospital = "null";
			$cuenta = "null";
			$item = "null";
			$asignacion = "null";
			$subAsignacion = "null";

			if(!is_null($this->input->post('institucion')) && $this->input->post('institucion') != "-1")
				$institucion = $this->input->post('institucion');

			if(!is_null($this->input->post('hospital')) && $this->input->post('hospital') != "-1")
				$hospital = $this->input->post('hospital');

			if(!is_null($this->input->post('cuenta')) && $this->input->post('cuenta') != "-1")
				$cuenta = $this->input->post('cuenta');

			if(!is_null($this->input->post('item')) && $this->input->post('item') != "-1")
				$item = $this->input->post('item');

			if(!is_null($this->input->post('asignacion')) && $this->input->post('asignacion') != "-1")
				$asignacion = $this->input->post('asignacion');

			if(!is_null($this->input->post('subAsignacion')) && $this->input->post('subAsignacion') != "-1")
				$subAsignacion = $this->input->post('subAsignacion');

			$reporteResumenesGastos = $this->reporte_model->listarReporteResumenEspecifico($usuario["id_usuario"], $institucion, $hospital, $cuenta, $item, $asignacion, $subAsignacion, 1);
		}
		echo json_encode($reporteResumenesGastos);
	}


	public function listarReporteResumenTipo()
	{
		$usuario = $this->session->userdata();
		$reporteResumenesTipo = [];
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

			$reporteResumenesTipo = $this->reporte_model->listarReporteResumenTipo($usuario["id_usuario"], $institucion, $hospital, $cuenta);
		}
		echo json_encode($reporteResumenesTipo);
	}

	public function listarReporteResumenTipoGasto()
	{
		$usuario = $this->session->userdata();
		$reporteResumenesTipoGasto = [];
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

			$reporteResumenesTipoGasto = $this->reporte_model->listarReporteResumenTipoGasto($usuario["id_usuario"], $institucion, $hospital, $cuenta);
		}
		echo json_encode($reporteResumenesTipoGasto);
	}
	
}

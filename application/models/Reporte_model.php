<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarInstitucionesUsu($id_usuario)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarInstitucionesUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarReporteResumen($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumen`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenGasto($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenGasto`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenTipo($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenTipo`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenTipoGasto($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenTipoGasto`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenItem($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenItem`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function listarReporteResumenAsignacion($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $id_item, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenAsignacion`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$id_item.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function listarReporteResumenSubAsignacion($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $id_item, $id_asignacion, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenSubAsignacion`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$id_item.', '.$id_asignacion.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function listarReporteResumenEspecifico($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $id_item, $id_asignacion, $id_sub_asignacion, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenEspecifico`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$id_item.', '.$id_asignacion.', '.$id_sub_asignacion.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function obtenerAniosTransacciones()
	{
		$query = $this->db->query('CALL `institucion_minsal`.`obtenerAniosTransacciones`;');
		return $query->result_array();
	}

	public function listarReporteResumenFecha($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $mes, $anio, $inflactor, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenFecha`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$mes.', '.$anio.', '.$inflactor.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function listarReporteGrafico($id_usuario, $id_institucion, $id_hospital, $id_cuenta, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteGrafico`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.', '.$id_tipo.');');
		return $query->result_array();
	}

	public function listarReporteResumenGrafico($id_usuario, $id_institucion, $id_hospital, $id_tipo)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteResumenGrafico`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_tipo.');');
		return $query->result_array();
	}	

	public function listarReporteGrafico22($id_usuario, $id_institucion, $id_hospital)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteGrafico22`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.');');
		return $query->result_array();
	}

	public function listarReporteGraficoProduccion($id_usuario, $id_institucion, $id_hospital, $id_grupo_prestacion)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarReporteGraficoProduccion`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_grupo_prestacion.');');
		return $query->result_array();
	}
}	
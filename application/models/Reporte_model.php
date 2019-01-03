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
		$query = $this->db->query('CALL `institucionminsal`.`listarInstitucionesUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarReporteResumen($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarReporteResumen`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenGasto($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarReporteResumenGasto`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenTipo($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarReporteResumenTipo`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

	public function listarReporteResumenTipoGasto($id_usuario, $id_institucion, $id_hospital, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarReporteResumenTipoGasto`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_cuenta.');');
		return $query->result_array();
	}

}
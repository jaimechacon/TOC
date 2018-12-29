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

}
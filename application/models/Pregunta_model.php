<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pregunta_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarPreguntas()
	{
		$query = $this->db->query("select id_pregunta as id_pregunta,
									    pre_nombre as nombre,
									    pre_descripcion as descripcion
									from preguntas
									where pre_fecha_baja is null;");
		return $query->result_array();
	}

	public function buscarPregunta($pregunta)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarPregunta`('".$pregunta."');");
		return $query->result_array();
	}

	public function eliminarPregunta($idPregunta, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarPregunta`(".$idPregunta.", ".$idUsuario.");");
		return $query->result_array();
	}

	public function guardarPregunta($idPregunta, $nombrePregunta, $observacionesPregunta, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarPregunta`(".$idPregunta.", '".$nombrePregunta."', '".$observacionesPregunta."', ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtenerPregunta($idPregunta)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerPregunta`(".$idPregunta.");");

		return $query->result_array();
	}
}	
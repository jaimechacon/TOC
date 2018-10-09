<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluacion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listar_evaluaciones($id_usuario, $rango)
	{
		$query = $this->db->query("call `gestion_calidad`.`listarEvaluacionesUsu`(".$id_usuario.", ".$rango.");");
		return $query->result_array();
	}

	public function obtenerEmpresasUsu($id_usuario)
	{
		$query = $this->db->query('call `gestion_calidad`.`obtenerEmpresasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function obtenerPlantillaEAC($id_usuario_eac, $id_campania)
	{
		$query = $this->db->query('call `gestion_calidad`.`listarPlantilla`('.$id_usuario_eac.', '.$id_campania.');');
		return $query->result_array();
	}

	public function guardarEvaluacion($idEvaluacion, $idGrabacion, $observacionesEvaluacion, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEvaluacion`(".$idEvaluacion.", ".$idGrabacion.", '".$observacionesEvaluacion."', ".$idUsuario.");");

		return $query->result_array();
	}

	public function guardarRespuestaPreguntaEvaluacion($idEvaluacion, $idplacatpre, $respuesta, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`guardarRespuestaPreguntaEvaluacion`(".$idEvaluacion.", ".$idplacatpre.", ".$respuesta.", ".$idUsuario.");");

		return $query->result_array();
	}	
}	

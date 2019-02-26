<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucion_model extends CI_Model
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

	public function listarInstitucionesUsuPagos($id_usuario)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarInstitucionesUsuPagos`('.$id_usuario.');');
		return $query->result_array();
	}

	

}
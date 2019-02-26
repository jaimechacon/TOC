<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_asignacion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function obtenerSubAsignacion($id_sub_asignacion)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`obtenerSubAsignacion`('.$id_sub_asignacion.');');
		return $query->result_array();
	}

}
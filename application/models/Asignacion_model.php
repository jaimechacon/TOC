<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignacion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function obtenerAsignacion($id_asignacion)
	{
		$query = $this->db->query('CALL `institucionminsal`.`obtenerAsignacion`('.$id_asignacion.');');
		return $query->result_array();
	}

}
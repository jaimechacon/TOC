<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campania_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarCampaniasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `gestion_calidad`.`listarCampaniasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarCampaniasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `gestion_calidad`.`listarCampaniasUsu`('.$id_usuario.');');
		return $query->result_array();
	}
}
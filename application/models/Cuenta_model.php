<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuenta_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarCuentasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarCuentasUsu`('.$id_usuario.');');
		return $query->result_array();
	}


}
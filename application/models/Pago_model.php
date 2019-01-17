<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarPagos($id_usuario)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarPagos`('.$id_usuario.');');
		return $query->result_array();
	}
}
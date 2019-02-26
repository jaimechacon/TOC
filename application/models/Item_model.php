<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function obtenerItem($id_item)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`obtenerItem`('.$id_item.');');
		return $query->result_array();
	}

}
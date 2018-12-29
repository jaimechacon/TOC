<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarItemsUsu($id_usuario, $id_cuenta)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarItemsUsu`('.$id_usuario.', '.$id_cuenta.');');
		return $query->result_array();
	}


}
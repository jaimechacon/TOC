<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarHospitalesUsu($id_usuario, $id_institucion)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarHospitalesUsu`('.$id_usuario.', '.$id_institucion.');');
		return $query->result_array();
	}

	public function listarHospitalesUsuPagos($id_usuario, $id_institucion)
	{
		$query = $this->db->query('CALL `institucion_minsal`.`listarHospitalesUsuPagos`('.$id_usuario.', '.$id_institucion.');');
		return $query->result_array();
	}


}
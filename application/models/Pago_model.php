<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pago_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarPagos($id_usuario, $id_institucion, $id_hospital, $id_principal, $mes, $anio, $inicio, $tamanio)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarPagos`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_principal.', '.$mes.', '.$anio.', '.$inicio.', '.$tamanio.');');
		return $query->result_array();
	}

	public function obtenerAniosPagos($id_usuario, $id_institucion, $id_hospital, $id_principal)
	{
		$query = $this->db->query('CALL `institucionminsal`.`obtenerAniosPagos`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_principal.');');
		return $query->result_array();
	}

	public function listarPrincipalesUsu($id_usuario, $id_institucion, $id_area_transaccional)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarPrincipalesUsu`('.$id_usuario.', '.$id_institucion.', '.$id_area_transaccional.');');
		return $query->result_array();
	}

	public function listarCantPagos($id_usuario, $id_institucion, $id_hospital, $id_principal, $mes, $anio)
	{
		$query = $this->db->query('CALL `institucionminsal`.`listarCantPagos`('.$id_usuario.', '.$id_institucion.', '.$id_hospital.', '.$id_principal.', '.$mes.', '.$anio.');');
		return $query->result_array();
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traspaso_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function obtenerTraspaso($id_asignacion)
	{
		$query = $this->db->query('CALL `db_toc`.`obtenerTraspaso`('.$id_asignacion.');');
		return $query->result_array();
	}

	public function guardarTraspaso($idTraspaso, $rut, $fechaNac, $nombres, $apellidos, $email, $celular, $telefono, $obsrevaciones, $idUsuarioCreador)
	{
		$query = $this->db->query("call `db_toc`.`agregarTraspaso`(".$idTraspaso.", ".($rut == "null" ? $rut : ("'".$rut."'")).", ".($fechaNac == "null" ? $fechaNac : ("'".$fechaNac."'")).", ".($nombres == "null" ? $nombres : ("'".$nombres."'")).", ".($apellidos == "null" ? $apellidos : ("'".$apellidos."'")).", ".($email == "null" ? $email : ("'".$email."'")).", ".($celular == "null" ? $celular : ("'".$celular."'")).", ".($telefono == "null" ? $telefono : ("'".$telefono."'")).", ".($obsrevaciones == "null" ? $obsrevaciones : ("'".$obsrevaciones."'")).", ".$idUsuarioCreador.");");

		return $query->result_array();
	}

}
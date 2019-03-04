<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traspaso_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	/*public function obtenerTraspaso($id_asignacion)
	{
		$query = $this->db->query('CALL `db_toc`.`obtenerTraspaso`('.$id_asignacion.');');
		return $query->result_array();
	}*/

	public function guardarTraspaso($idTraspaso, $rut, $fechaNac, $nombres, $apellidos, $email, $celular, $telefono, $obsrevaciones, $idUsuarioCreador)
	{
		$query = $this->db->query("call `db_toc`.`agregarTraspaso`(".$idTraspaso.", ".($rut == "null" ? $rut : ("'".$rut."'")).", ".($fechaNac == "null" ? $fechaNac : ("'".$fechaNac."'")).", ".($nombres == "null" ? $nombres : ("'".$nombres."'")).", ".($apellidos == "null" ? $apellidos : ("'".$apellidos."'")).", ".($email == "null" ? $email : ("'".$email."'")).", ".($celular == "null" ? $celular : ("'".$celular."'")).", ".($telefono == "null" ? $telefono : ("'".$telefono."'")).", ".($obsrevaciones == "null" ? $obsrevaciones : ("'".$obsrevaciones."'")).", ".$idUsuarioCreador.");");
		return $query->result_array();
	}

	public function validarUsuario($id_traspaso, $id_front, $id_back, $selfie, $biometric_result, $checksum, $date_of_birth, $document_number, $expiration_date, $family_name, $gender, $name, $national_identification_number, $nationality, $raw, $type, $status, $toc_token, $latitude, $longitude, $toc_token_pdf, $status_pdf, $signed_pdf)
	{
		$query = $this->db->query("call `db_toc`.`validarUsuario`(".$id_traspaso.", ".($id_front == "null" ? $id_front : ("'".$id_front."'")).", ".($id_back == "null" ? $id_back : ("'".$id_back."'")).", ".($selfie == "null" ? $selfie : ("'".$selfie."'")).", ".$biometric_result.", ".$checksum.", ".$date_of_birth.", ".($document_number == "null" ? $document_number : ("'".$document_number."'")).", ".$expiration_date.", ".($family_name == "null" ? $family_name : ("'".$family_name."'")).", ".($gender == "null" ? $gender : ("'".$gender."'")).", ".($name == "null" ? $name : ("'".$name."'")).", ".($national_identification_number == "null" ? $national_identification_number : ("'".$national_identification_number."'")).", ".($nationality == "null" ? $nationality : ("'".$nationality."'")).", ".($raw == "null" ? $raw : ("'".$raw."'")).", ".($type == "null" ? $type : ("'".$type."'")).", ".($status == "null" ? $status : ("'".$status."'")).", ".($toc_token == "null" ? $toc_token : ("'".$toc_token."'")).", ".($latitude == "null" ? $latitude : ("'".$latitude."'")).", ".($longitude == "null" ? $longitude : ("'".$longitude."'")).", ".($toc_token_pdf == "null" ? $toc_token_pdf : ("'".$toc_token_pdf."'")).", ".($status_pdf == "null" ? $status_pdf : ("'".$status_pdf."'")).", ".($signed_pdf == "null" ? $signed_pdf : ("'".$signed_pdf."'")).");");
		return $query->result_array();
	}

	public function obtenerTraspasosUsu($idUsuario, $runCliente, $idFolio, $nombreCliente)
	{
		$query = $this->db->query("call `db_toc`.`obtenerTraspasosUsu`(".$idUsuario.", ".($runCliente == "null" ? $runCliente : ("'".$runCliente."'")).", ".$idFolio.", ".($nombreCliente == "null" ? $nombreCliente : ("'".$nombreCliente."'")).");");
		
		return $query->result_array();
	}

	public function obtenerTraspaso($idFolio)
	{
		$query = $this->db->query("call `db_toc`.`obtenerTraspaso`(".$idFolio.");");
		return $query->result_array();
	}

}
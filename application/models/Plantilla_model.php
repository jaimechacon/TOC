<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plantilla_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function buscarPlantilla($plantilla)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarPlantilla`('".$plantilla."');");
		return $query->result_array();
	}

	public function eliminarPlantilla($idPlantilla, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarPlantilla`(".$idPlantilla.", ".$idUsuario.");");
		return $query->result_array();
	}

	public function listarEAC()
	{
		$query = $this->db->query("select usu.id_usuario, usu.u_nombres as nombres, usu.u_apellidos as apellidos, usu.u_email as email, usu.u_cod_usuario as cod_eac
		from usuarios usu inner join usuarios_perfiles up on usu.id_usuario = up.id_usuario
						  inner join perfiles p on up.id_perfil = p.id_perfil
		where p.pf_analista = 4
		and usu.u_fecha_baja is null
		order by usu.u_cod_usuario;");
		return $query->result_array();
	}

	public function buscarEAC($eac)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarEAC`('".$eac."');");
		return $query->result_array();
	}

	public function guardarPlantilla($idPlantilla, $nombrePlantilla, $observacionesPlantilla, $esTemporal, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarPlantilla`(".$idPlantilla.", '".$nombrePlantilla."', '".$observacionesPlantilla."', ".$esTemporal.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function guardarEACPlantilla($idPlantilla, $idEac, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEACPlantilla`(".$idPlantilla.", ".$idEac.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function eliminarEACPlantilla($idPlantilla, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarEACPlantilla`(".$idPlantilla.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtenerPlantilla($idPlantilla)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerPlantilla`(".$idPlantilla.");");

		return $query->result_array();
	}

	

	
}	
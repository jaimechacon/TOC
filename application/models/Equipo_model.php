<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipo_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarEquipos()
	{
		$query = $this->db->query("select eq.id_equipo, eq.eq_nombre as nombre, eq.eq_descripcion as descripcion, eq.eq_abreviacion as abreviacion, count(ue.id_usuario) as 'cant_usu'
			from equipos eq left join usuarios_equipos ue on eq.id_equipo = ue.id_equipo
			group by eq.id_equipo, eq.eq_nombre, eq.eq_descripcion, eq.eq_abreviacion;");
		return $query->result_array();
	}

	public function buscarEquipo($equipo)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarEquipo`('".$equipo."');");
		return $query->result_array();
	}

	public function eliminarEquipo($idEquipo, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarEquipo`(".$idEquipo.", ".$idUsuario.");");
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

	public function guardarEquipo($nombreEquipo, $abreviacionEquipo, $observacionesEquipo, $eacs, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEquipo`('".$nombreEquipo."', '".$abreviacionEquipo."', '".$observacionesEquipo."', ".$idUsuario.");");

		return $query->result_array();
	}

	public function guardarEACEquipo($idEquipo, $idEac, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEACEquipo`(".$idEquipo.", ".$idEac.", ".$idUsuario.");");

		return $query->result_array();
	}

	
}	
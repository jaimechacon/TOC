<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campania_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarCampaniasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `gestion_calidad`.`listarCampaniasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarCampanias()
	{
		$query = $this->db->query("select eq.id_campania, eq.eq_nombre as nombre, eq.eq_descripcion as descripcion, eq.eq_abreviacion as abreviacion, count(ue.id_usuario) as 'cant_usu'
			from campanias eq left join usuarios_campanias ue on eq.id_campania = ue.id_campania
			group by eq.id_campania, eq.eq_nombre, eq.eq_descripcion, eq.eq_abreviacion;");
		return $query->result_array();
	}

	public function buscarCampania($campania)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarCampania`('".$campania."');");
		return $query->result_array();
	}

	public function eliminarCampania($idCampania, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarCampania`(".$idCampania.", ".$idUsuario.");");
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

	public function guardarCampania($idCampania, $nombreCampania, $tituloCampania, $fechaInicio, $fechaFin, $cantEAC,
									$cantDiasFase, $cantDiasCiclo, $cantCiclos, $TMO, $cantDiasdAntiguedadGab, $cantLlamados, $muestra, $codCampania, $observaciones, $idPlantilla, $idTipoCampania, $idEmpresa, $cantGestionesCiclo, $idUsuario )
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarCampania`(".$idCampania.", '".$nombreCampania."', '".$tituloCampania."', ".($fechaInicio == "null" ? $fechaInicio : ("'".$fechaInicio."'")).", ".($fechaFin == "null" ? $fechaFin : ("'".$fechaFin."'")).", ".$cantEAC.", ".$cantDiasFase.", ".$cantDiasCiclo.", ".$cantCiclos.", ".$TMO.", ".$cantDiasdAntiguedadGab.", ".$cantLlamados.", ".$muestra.", ".$codCampania.", '".$observaciones."', ".$idPlantilla.", ".$idTipoCampania.", ".$idEmpresa.", ".$cantGestionesCiclo.", ".$idUsuario.");");
		return $query->result_array();
	}

	public function guardarEACCampania($idCampania, $idEac, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEACCampania`(".$idCampania.", ".$idEac.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function eliminarEACCampania($idCampania, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarEACCampania`(".$idCampania.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtenerCampania($idCampania)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerCampania`(".$idCampania.");");

		return $query->result_array();
	}

	public function buscarTipoCampania($tipoCampania)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarTipoCampania`('".$tipoCampania."');");
		return $query->result_array();
	}

	public function listarCampaniasUsuariosEquipos($idUsuario, $idUsuarioAnalista, $idCampania, $idEquipo)
	{
		$query = $this->db->query("call `gestion_calidad`.`listarCampaniasUsuariosEquipos`(".$idUsuario.", ".$idUsuarioAnalista.", ".$idCampania.", ".$idEquipo.");");
		return $query->result_array();
	}

}
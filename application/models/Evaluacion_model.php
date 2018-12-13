<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluacion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listar_evaluaciones($id_usuario, $rango, $ciclo , $id_usuarioResponsable, $fechaFase)
	{
		$query = $this->db->query("call `gestion_calidad`.`listarEvaluacionesUsu4`(".$id_usuario.", ".$rango.", ".$ciclo.", ".$id_usuarioResponsable.", ".($fechaFase == "null" ? $fechaFase : ("'".$fechaFase."'")).");");
		return $query->result_array();
	}

	public function obtenerEmpresasUsu($id_usuario)
	{
		$query = $this->db->query('call `gestion_calidad`.`obtenerEmpresasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function obtenerPlantillaEAC($id_usuario_eac, $id_campania)
	{
		$query = $this->db->query('call `gestion_calidad`.`listarPlantilla`('.$id_usuario_eac.', '.$id_campania.');');
		return $query->result_array();
	}

	public function guardarEvaluacion($idEvaluacion, $idEAC, $idCampania, $idLlamada, $nombreGrabacion, $fechaGrabacion, $duracionSegundos, $duracionMinutos, $observacionesEvaluacion, $idUsuResp, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEvaluacion`(".$idEvaluacion.", '".$idEAC."', ".$idCampania.", '".$idLlamada."', '".$nombreGrabacion."', '".$fechaGrabacion."', ".$duracionSegundos.", ".$duracionMinutos.", '".$observacionesEvaluacion."', ".$idUsuResp.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function guardarRespuestaPreguntaEvaluacion($idEvaluacion, $idplacatpre, $respuesta, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`guardarRespuestaPreguntaEvaluacion`(".$idEvaluacion.", ".$idplacatpre.", ".$respuesta.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtener_usuarios_analistas()
	{
		$query = $this->db->query("select usu.id_usuario, concat(usu.u_nombres, '' '', usu.u_apellidos) as nombre_completo
from usuarios usu inner join usuarios_perfiles up on usu.id_usuario = up.id_usuario 
				  inner join perfiles p on up.id_perfil = p.id_perfil
where (p.pf_analista = 3 or (p.pf_analista = 2 and usu.u_contabilizar = 1));");
		return $query->result_array();
	}


	public function obtener_usuarios_eacs()
	{
		$query = $this->db->query("select usu.id_usuario, concat(usu.u_nombres, ' ', usu.u_apellidos) as nombre_completo
from usuarios usu inner join usuarios_perfiles up on usu.id_usuario = up.id_usuario 
				  inner join perfiles p on up.id_perfil = p.id_perfil
where p.pf_analista = 4 order by 2 asc;");
		return $query->result_array();
	}

	public function listaEvaluaciones($idUsuarioAnalista, $idCampania, $idUsuarioEAC, $fechaDesde, $fechaHasta)
	{
		$query = $this->db->query("call `gestion_calidad`.`listarEvaluaciones`(".$idUsuarioAnalista.", ".$idCampania.", ".$idUsuarioEAC.", ".($fechaDesde == "null" ? $fechaDesde : ("'".$fechaDesde."'")).", ".($fechaHasta == "null" ? $fechaHasta : ("'".$fechaHasta."'")).");");
		return $query->result_array();
	}

	public function listarPlantillaResultado($id_evaluacion)
	{
		$query = $this->db->query('call `gestion_calidad`.`listarPlantillaResultado`('.$id_evaluacion.');');
		return $query->result_array();
	}

	public function obtenerCampaniasEvaluaciones($idUsuarioResponsable, $idCampania, $idUsuarioEAC)
	{
		$query = $this->db->query('call `gestion_calidad`.`obtenerCampaniasEvaluaciones`('.$idUsuarioResponsable.', '.$idCampania.', '.$idUsuarioEAC.');');
		return $query->result_array();
	}

	public function obtenerUsuariosRespEvaluaciones($idUsuarioResponsable, $idCampania, $idUsuarioEAC)
	{
		$query = $this->db->query('call `gestion_calidad`.`obtenerUsuariosRespEvaluaciones`('.$idUsuarioResponsable.', '.$idCampania.', '.$idUsuarioEAC.');');
		return $query->result_array();
	}

	public function obtenerUsuariosEACEvaluaciones($idUsuarioResponsable, $idCampania, $idUsuarioEAC)
	{
		$query = $this->db->query('call `gestion_calidad`.`obtenerUsuariosEACEvaluaciones`('.$idUsuarioResponsable.', '.$idCampania.', '.$idUsuarioEAC.');');
		return $query->result_array();
	}

	public function truncarUsuariosGrabacion()
	{
		$query = $this->db->query("call `gestion_calidad`.`truncarUsuariosGrabacion`();");
		return $query->result_array();
	}

	public function agregarUsuarioGrabacion($c_cod_campania, $u_cod_usuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarUsuarioGrabacion`('".$c_cod_campania."', '".$u_cod_usuario."');");
		return $query->result_array();
	}

	public function esAnalista($idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`esAnalista`(".$idUsuario.");");
		return $query->result_array();
	}

	public function obtenerCiclos($fechaFase)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerCiclos`(".($fechaFase == "null" ? $fechaFase : ("'".$fechaFase."'")).");");
		return $query->result_array();
	}

	public function obtenerFases($fechaFase)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerFases`(".($fechaFase == "null" ? $fechaFase : ("'".$fechaFase."'")).");");
		return $query->result_array();
	}

}	

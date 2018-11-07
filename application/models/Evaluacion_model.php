<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluacion_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listar_evaluaciones($id_usuario, $rango)
	{
		$query = $this->db->query("call `gestion_calidad`.`listarEvaluacionesUsu`(".$id_usuario.", ".$rango.");");
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

	public function guardarEvaluacion($idEvaluacion, $idEAC, $idCampania, $idLlamada, $nombreGrabacion, $duracionSegundos, $duracionMinutos, $observacionesEvaluacion, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEvaluacion`(".$idEvaluacion.", '".$idEAC."', ".$idCampania.", '".$idLlamada."','".$nombreGrabacion."', ".$duracionSegundos.", ".$duracionMinutos.", '".$observacionesEvaluacion."', ".$idUsuario.");");

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

	public function listaEvaluaciones($idUsuarioAnalista, $idCampania, $idUsuarioEAC)
	{
		$query = $this->db->query("select e.id_evaluacion, e.id_usuario, e.id_usuario_responsable, e.ev_fecha, 
concat(usu.u_nombres, ' ' ,usu.u_apellidos) as nombre_usu, 
concat(us.u_nombres, ' ' ,us.u_apellidos) as nombre_usu_respon, 
concat(usur.u_nombres, ' ' ,usur.u_apellidos) as nombre_eac,
g.g_duracion_minutos, g.g_identificador, g.g_nombre, g.g_duracion_segundos, g.id_campania, c.c_nombre,
convert(
	(sum(cat.cat_puntuacion) * 100) /
    (select sum(cats.cat_puntuacion)
from evaluaciones ev inner join detalle_evaluaciones des on ev.id_evaluacion = des.id_evaluacion
					inner join plantillas_categorias_preguntas pcps on des.id_plantilla_categoria_pregunta = pcps.id_plantilla_categoria_pregunta
                    inner join categorias cats on pcps.id_categoria = cats.id_categoria
                    inner join preguntas pres on pcps.id_pregunta = pres.id_pregunta
where ev.id_evaluacion = e.id_evaluacion), decimal(6,2)
) as puntaje,

 (select sum(cats.cat_puntuacion)
from evaluaciones ev inner join detalle_evaluaciones des on ev.id_evaluacion = des.id_evaluacion
					inner join plantillas_categorias_preguntas pcps on des.id_plantilla_categoria_pregunta = pcps.id_plantilla_categoria_pregunta
                    inner join categorias cats on pcps.id_categoria = cats.id_categoria
                    inner join preguntas pres on pcps.id_pregunta = pres.id_pregunta
where ev.id_evaluacion = e.id_evaluacion) as puntaje_total
from evaluaciones e inner join detalle_evaluaciones de on e.id_evaluacion = de.id_evaluacion
					inner join plantillas_categorias_preguntas pcp on de.id_plantilla_categoria_pregunta = pcp.id_plantilla_categoria_pregunta
                    inner join categorias cat on pcp.id_categoria = cat.id_categoria
					inner join grabaciones g on e.id_grabacion = g.id_grabacion
                    inner join usuarios usu on e.id_usuario = usu.id_usuario
                    inner join usuarios us on e.id_usuario_responsable = us.id_usuario
                    inner join usuarios usur on g.id_usuario = usur.id_usuario
                    inner join campanias c on g.id_campania = c.id_campania
where e.ev_fecha_baja is null
and (e.id_usuario_responsable = ".$idUsuarioAnalista." or ".$idUsuarioAnalista." is null)
and (g.id_campania  = ".$idCampania." or ".$idCampania." is null)
and (g.id_usuario  = ".$idUsuarioEAC." or ".$idUsuarioEAC." is null)
and de.id_respuesta = 1
group by e.id_evaluacion, e.id_usuario, e.id_usuario_responsable, e.ev_fecha, usu.u_nombres, usu.u_apellidos, us.u_nombres, us.u_apellidos, usur.u_nombres, usur.u_apellidos,         g.g_duracion_minutos, g.g_identificador, g.g_nombre, g.g_duracion_segundos, g.id_campania, c.c_nombre;");
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
}	

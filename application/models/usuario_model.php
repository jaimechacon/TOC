<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function login($email, $contrasenia)
	{
		$usuario = $this->db->get_where('usuarios', array('u_email' => $email, 'u_contrasenia' => $contrasenia), 1);
		return $usuario->row_array();
	}

	public function campanias()
	{		
        $query = $this->db->get('campanias');
        return $query->result_array();
	}

	public function obtener_menu_usuario($id_usuario)
	{
		//$usuario = $this->db->get_where('usuarios', array('u_email' => $email, 'u_contrasenia' => $contrasenia), 1);
		$query = $this->db->query("SELECT distinct me.id_menu, me.me_nombre, me.me_url, me.me_orden, me.id_modulo, me.id_rol,
	   (if(isnull(me.id_rol), 0, (select count(men.id_menu) FROM menus men where men.id_modulo = me.id_modulo and not isnull(men.id_rol)))) as cant_submenu
		FROM USUARIOS USU INNER JOIN USUARIOS_PERFILES UP ON USU.ID_USUARIO = UP.ID_USUARIO
						  INNER JOIN PERFILES P ON UP.ID_PERFIL = P.ID_PERFIL
		                  INNER JOIN PERFILES_MODULOS_ROLES PMR ON P.ID_PERFIL = PMR.ID_PERFIL
		                  LEFT JOIN MENUS ME ON (IF(ISNULL(PMR.ID_ROL), (PMR.ID_MODULO = ME.ID_MODULO AND ME.ID_ROL IS NULL), (PMR.ID_MODULO = ME.ID_MODULO AND PMR.ID_ROL = ME.ID_ROL)))
		WHERE USU.ID_USUARIO = ".$id_usuario."
		AND isnull(me.me_fecha_baja)
		ORDER BY me.id_rol, me.me_orden;");
		return $query->result_array();
	}

	public function obtenerEmpresasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `gestion_calidad`.`obtenerEmpresasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarCampaniasUsu($id_usuario)
	{
		$query = $this->db->query('CALL `gestion_calidad`.`listarCampaniasUsu`('.$id_usuario.');');
		return $query->result_array();
	}

	public function listarAnalistaUsu()
	{
		$query = $this->db->query("SELECT CONCAT(USU.U_NOMBRES, ' ', USU.U_APELLIDOS) AS NOMBRE_USU FROM USUARIOS USU INNER JOIN usuarios_perfiles UP ON USU.ID_USUARIO = UP.ID_USUARIO
INNER JOIN PERFILES P ON UP.ID_PERFIL = P.ID_PERFIL
WHERE P.PF_ANALISTA = 1;");
		return $query->result_array();
	}

	public function traerPerfilUsu($id_usuario)
	{
		$query = $this->db->query("SELECT P.PF_NOMBRE AS PERFIL FROM USUARIOS USU INNER JOIN usuarios_perfiles UP ON USU.ID_USUARIO = UP.ID_USUARIO
		INNER JOIN PERFILES P ON UP.ID_PERFIL = P.ID_PERFIL
		WHERE USU.ID_USUARIO = ".$id_usuario." GROUP BY P.PF_NOMBRE;");
		return $query->result_array();
	}
}	
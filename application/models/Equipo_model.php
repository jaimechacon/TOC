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
			from equipos eq inner join usuarios_equipos ue on eq.id_equipo = ue.id_equipo
	group by eq.eq_nombre, eq.eq_descripcion, eq.eq_abreviacion;");
		return $query->result_array();
	}

	public function buscarEquipo($equipo)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarEquipo`('".$equipo."');");
		return $query->result_array();
	}
}	
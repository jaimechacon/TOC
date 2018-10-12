<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grabacion_model extends CI_Model
{
	private $db_b;

	public function __construct()
	{
		//$active_group = 'default';
		$this->db_b = $this->load->database('interna', true);
		parent::__construct();
	}

	public function listarGrabacionesUsu($id_usuario, $cod_campania)
	{
		$sql = '';
        if($cod_campania == 8)
        {
        	$sql = "select clg.Idllamada, pre.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
			from clg_prechequeogt pre inner join clg_traficollamada clg on pre.idgestion = clg.IdVenta
			where pre.user_neotel = ".$id_usuario."
			and clg.cola = ".$cod_campania."
			and (TIMESTAMPDIFF(DAY, clg.FechaCarga,now())) <= 15
			group by clg.Idllamada, pre.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
			order by clg.FechaCarga desc;";
        }else
        {
        	$sql = "select vg.idllamada, vg.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
				from clg_ventasgt vg inner join clg_traficollamada clg on vg.idllamada = clg.Idllamada
				where vg.user_neotel = ".$id_usuario."
				and clg.cola = ".$cod_campania."
				and (TIMESTAMPDIFF(DAY, clg.FechaCarga,now())) <= 15
				group by vg.idllamada, vg.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
				order by clg.FechaCarga desc;";
        }
		$query = $this->db_b->query($sql);
		return $query->result_array();
	}
}	

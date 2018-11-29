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
        	$sql = "select clg.Idllamada as idllamada, vg.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
			from clg_prechequeogt vg inner join clg_traficollamada clg on vg.idllamada = clg.idllamada
			inner join clg_tipoventa tv on vg.tipo = tv.id
			where (TIMESTAMPDIFF(DAY, vg.fechaactualiza, now())) <= 15
			and vg.user_neotel is not null
			and vg.user_neotel = ".$id_usuario."
			and clg.Campania not in ('SE CORTA LLAMADO','CONSULTA PORTA')
			group by clg.Idllamada, vg.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa;";
        }else
        {
			$sql = "select vg.idllamada, vg.user_neotel, clg.FechaCarga, vg.tipo, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
			from clg_ventasgt vg inner join clg_traficollamada clg on vg.idllamada = clg.idllamada
			inner join clg_tipoventa tv on vg.tipo = tv.id
			where (TIMESTAMPDIFF(DAY, vg.fechaactualiza, now())) <= 15
			and vg.user_neotel is not null
			and vg.user_neotel = ".$id_usuario."
			and vg.tipo = ".$cod_campania."
			and vg.Estado = 6
			and clg.Campania not in ('PRECHEQUEO','SE CORTA LLAMADO','CONSULTA PORTA')
			group by vg.idllamada, vg.user_neotel, clg.FechaCarga, clg.Cola, clg.Inicio, clg.Conexion, clg.Fin, clg.Grabacion, clg.hora_llamada, clg.tramo_horario, clg.DuracionSegundo, clg.DuracionMinutos, clg.tmo, clg.asa
			order by clg.FechaCarga desc;";
        }
		$query = $this->db_b->query($sql);
		return $query->result_array();
	}

	public function obtenerUsuariosGrabacion()
	{
		$sql = '';
		$sql = "select 8 as tipo, group_concat(user_neotel) as users
from (select vg.user_neotel
from clg_prechequeogt vg inner join clg_traficollamada clg on vg.idllamada = clg.idllamada
inner join clg_tipoventa tv on vg.tipo = tv.id
where (TIMESTAMPDIFF(DAY, vg.fechaactualiza, now())) <= 15
and vg.user_neotel is not null
and clg.Campania not in ('SE CORTA LLAMADO','CONSULTA PORTA')
group by vg.user_neotel) as hola
union
select gts.nombre as tipo, group_concat(users) as users
from (
select tv.nombre, vg.user_neotel as users
from clg_ventasgt vg inner join clg_traficollamada clg on vg.idllamada = clg.idllamada
inner join clg_tipoventa tv on vg.tipo = tv.id
where (TIMESTAMPDIFF(DAY, vg.fechaactualiza, now())) <= 15
and vg.user_neotel is not null
and vg.Estado = 6
and clg.Campania not in ('PRECHEQUEO','SE CORTA LLAMADO','CONSULTA PORTA')
group by vg.tipo, vg.user_neotel) as gts
group by gts.nombre;";
		$query = $this->db_b->query($sql);
		return $query->result_array();
	}
}	

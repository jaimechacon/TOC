<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}

	public function listarCategorias()
	{
		$query = $this->db->query("select id_categoria as id_categoria,
									    cat_nombre as nombre,
									    cat_descripcion as descripcion,
									    cat_puntuacion as puntuacion
									from categorias
									where cat_fecha_baja is null;");
		return $query->result_array();
	}

	public function buscarCategoria($categoria)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarCategoria`('".$categoria."');");
		return $query->result_array();
	}

	public function eliminarCategoria($idCategoria, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarCategoria`(".$idCategoria.", ".$idUsuario.");");
		return $query->result_array();
	}

	public function buscarEAC($eac)
	{
		$query = $this->db->query("call `gestion_calidad`.`buscarEAC`('".$eac."');");
		return $query->result_array();
	}

	public function guardarCategoria($idCategoria, $nombreCategoria, $puntuacionCategoria, $observacionesCategoria, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarCategoria`(".$idCategoria.", '".$nombreCategoria."', ".$puntuacionCategoria.", '".$observacionesCategoria."', ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtenerCategoria($idCategoria)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerCategoria`(".$idCategoria.");");

		return $query->result_array();
	}
}	
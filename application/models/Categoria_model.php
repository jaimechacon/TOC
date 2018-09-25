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

	public function guardarCategoria($idCategoria, $nombreCategoria, $puntuacionCategoria, $observacionesCategoria, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarCategoria`(".$idCategoria.", '".$nombreCategoria."', ".$puntuacionCategoria.", '".$observacionesCategoria."', ".$idUsuario.");");

		return $query->result_array();
	}

	public function guardarEACCategoria($idCategoria, $idEac, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`agregarEACCategoria`(".$idCategoria.", ".$idEac.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function eliminarEACCategoria($idCategoria, $idUsuario)
	{
		$query = $this->db->query("call `gestion_calidad`.`eliminarEACCategoria`(".$idCategoria.", ".$idUsuario.");");

		return $query->result_array();
	}

	public function obtenerCategoria($idCategoria)
	{
		$query = $this->db->query("call `gestion_calidad`.`obtenerCategoria`(".$idCategoria.");");

		return $query->result_array();
	}

	

	
}	
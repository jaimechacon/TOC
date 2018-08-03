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
}	
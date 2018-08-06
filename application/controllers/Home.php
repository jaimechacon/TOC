<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		//$this->load->library('form_validation');
		//$this->load->helper(array('auth/login_rules'));
		//$this->load->model('usuario_model');

	}

	public function index()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu');
			$this->load->view('home', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Login');
		}
	}

	public function home()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$this->load->view('temp/header');
			$this->load->view('temp/menu');
			$this->load->view('home', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Login');
		}
	}
}

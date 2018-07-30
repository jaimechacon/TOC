<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('temp/header');
		$this->load->view('temp/menu');
		$this->load->view('home');
		$this->load->view('temp/footer');
	}

	

}

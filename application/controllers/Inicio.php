<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('inicio_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();

		if($this->session->has_userdata('id_usuario'))
		{			
			$perfil = $this->usuario_model->traerPerfilUsu($usuario["id_usuario"]);
			$usuario['controller'] = 'inicio';
			$usuario['perfil'] = $perfil[0];
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('inicioSesion', $usuario);
			$this->load->view('temp/footer', $usuario);
		}else
		{
			$this->session->sess_destroy();
			$login['login'] = 0;

			$this->enviasmsacliente('asdf');
			$this->load->view('temp/header_index', $login);
			$this->load->view('temp/menu_index');
			$this->load->view('inicio');
			$this->load->view('temp/footer');
		}
	}

	public function inicio()
	{
		$usuario = $this->session->userdata();
		if(!$usuario){
			$this->session->sess_destroy();
			echo 'asdfsadf';
		}else
		{
			$login['login'] = 0;
			$this->load->view('temp/header_index', $login);
			$this->load->view('temp/menu_index');
			$this->load->view('inicio');
			$this->load->view('temp/footer');
		}
	}

	public function enviasmsacliente($parametros){

		//var_dump($parametros); exit();
		/* $portafolio = $parametros['folio'];
		$pcs=$parametros['pcs'];
		$idllamada=$parametros['idllamada'];
		$rut=$parametros['rut'];
		$tipo=$parametros['tipo'];
		$codsms=null;*/

		// echo $idllamada; exit();
		/*ini_set("soap.wsdl_cache_enabled", "0"); 

		//$mensaje = "Número de Atención: ".$idllamada." Rut Cliente: ".$rut;

		//$client = new SoapClient(WS_URL_ITD);
		$client = new SoapClient('http://ida.itdchile.cl/services/smsApiService?wsdl');

		$array_ws = array('in0' => 'gs_salud',
		                  'in1' => 'gs_salud',
		                  
		                  'in2' => '56989233272',
		                  'in3' => 'Chispiiiiiin!!!!');

		$response = $client->sendSms($array_ws);
		//var_dump($response); exit();
		$codsms = $response->out->entry[1]->value;
		var_dump($response);
		//echo $codsms; exit();

		if ($codsms != null and $codsms != '' and $codsms != '-1') {       
		return 1;
      }else{
		return 0;
      } */
    }


}

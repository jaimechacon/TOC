<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traspaso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('traspaso_model');
		$this->load->model('perfil_model');
	}

	public function index()
	{
		$traspaso = $this->session->userdata();
		if($traspaso){
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $traspaso);
			$this->load->view('listarTraspasos', $traspaso);
			$this->load->view('temp/footer');
		}else
		{
			//$data['message'] = 'Verifique su email y contrase&ntilde;a.';
			redirect('Inicio');
		}
	}

	/*public function listarTraspasos()
	{
		$traspaso = $this->session->userdata();
		if($traspaso){
			$traspasos = $this->traspaso_model->buscarTraspaso('', (int)$traspaso["id_traspaso"]);
			$traspaso['traspasos'] = $traspasos;
			$traspaso['controller'] = 'traspaso';
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $traspaso);
			$this->load->view('listarTraspasos', $traspaso);
			$this->load->view('temp/footer', $traspaso);
		}
	}

	public function buscarTraspaso()
	{
		$traspaso = $this->session->userdata();
		if($traspaso){
			$filtroTraspaso = "";
			if($this->input->POST('traspaso'))
				$filtroTraspaso = $this->input->POST('traspaso');
			echo json_encode($this->traspaso_model->buscarTraspaso($filtroTraspaso, (int)$traspaso["id_traspaso"]));
		}
	}*/

	public function agregarTraspaso()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['titulo'] = 'Agregar Traspaso AFP a Cliente';
			$usuario['controller'] = 'traspaso';
			/*$perfiles =  $this->perfil_model->obtenerPerfiles($usuario["id_usuario"]);
			if($perfiles)
				$usuario['perfiles'] = $perfiles;

			mysqli_next_result($this->db->conn_id);


			$empresas =  $this->usuario_model->obtenerEmpresasUsu($usuario["id_usuario"]);
			if($empresas)
			{
				$traspaso['empresas'] = $empresas;
			}*/

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarTraspaso', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function verificarIdentidadCliente()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$usuario['titulo'] = 'Verificar Identidad';
			$usuario['controller'] = 'traspaso';
			

			/*$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
			if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
			//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
			$imagenCodificadaLimpia = str_replace("data:image/jpg;base64,", "", urldecode($imagenCodificada));

			//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
			//todo el contenido lo guardamos en un archivo
			$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

			//Calcular un nombre único
			$nombreImagenGuardada = "foto_" . uniqid() . ".jpg";


			$id_front = file_get_contents($_FILES[ "id_front" ][ 'tmp_name' ]);
			$id_back = file_get_contents($_FILES[ "id_back" ][ 'tmp_name' ]);

			$selfie = file_get_contents($_FILES[ "selfie" ][ 'tmp_name' ]);


			$documentType = $request->post( 'documentType' );
			$apiKey = $session->get( '7b8a72c87f4a415b8603e16c6b6afcee' );
			$params = array (
			'apiKey' => $apiKey,
			'id_front' => $id_front,
			'id_back' => $id_back,
			'selfie' => $selfie,
			'documentType' => $documentType
			);*/

			//$this->CallAPI('POST', 'https://sandbox-api.7oc.cl/v2/face-and-document', $params);	



			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('verificarIdentidadCliente', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	function CallAPI ($method, $url, $data = false)
	{
		$curl = curl_init();
		switch ($method)
		{
			case "POST" :
			curl_setopt($curl, CURLOPT_POST, 1 );
			if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break ;
			case "PUT" :
			curl_setopt($curl, CURLOPT_PUT, 1 );
			break ;
			default :
			if ($data)
			$url = sprintf( "%s?%s" , $url, http_build_query($data));
		}
		// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_HTTPHEADER,
		array ( "Content-Type:multipart/form-data" ));
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false );
		$result = curl_exec($curl);
		curl_close($curl);
		echo $result;
	}

	public function guardarTraspaso()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			if(!is_null($this->input->POST('nombres')))
			{
				if(!is_null($this->input->POST('apellidos')))
				{
					$run = "null";
					if(!is_null($this->input->POST('run')) && trim($this->input->POST('run')) != "")
						$run = trim($this->input->POST('run'));

					$fechaNac = "null";
					if(!is_null($this->input->POST('fechaNac')) && trim($this->input->POST('fechaNac')) != "")
						$fechaNac = trim($this->input->POST('fechaNac'));

					$nombres = "null";
					if(!is_null($this->input->POST('nombres')) && trim($this->input->POST('nombres')) != "")
						$nombres = trim($this->input->POST('nombres'));

					$apellidos = "null";
					if(!is_null($this->input->POST('apellidos')) && trim($this->input->POST('apellidos')) != "")
						$apellidos = trim($this->input->POST('apellidos'));
						
					$email = "null";
					if(!is_null($this->input->POST('email')) && trim($this->input->POST('email')) != "")
						$email = trim($this->input->POST('email'));

					$celular = "null";
					if(!is_null($this->input->POST('celular')) && trim($this->input->POST('celular')) != "")
						$celular = trim($this->input->POST('celular'));

					$telefono = "null";
					if(!is_null($this->input->POST('telefono')) && trim($this->input->POST('telefono')) != "")
						$telefono = trim($this->input->POST('telefono'));

					$observaciones = "null";
					if(!is_null($this->input->POST('observaciones')) && trim($this->input->POST('observaciones')) != "")
						$observaciones = trim($this->input->POST('observaciones'));

					$accion = 'agregado';
					
					$idTraspaso = 'null';
					if(!is_null($this->input->POST('idTraspaso')) && is_numeric($this->input->POST('idTraspaso')))
					{
						$idTraspaso = $this->input->POST('idTraspaso');
						$accion = 'modificado';
					}

					$respuesta = 0;
					$mensaje = '';

					$resultado = $this->traspaso_model->guardarTraspaso($idTraspaso, $run, $fechaNac, $nombres, $apellidos, $email, $celular, $telefono, $observaciones,  $usuario["id_usuario"]);

					if($resultado[0] > 0)
					{

						if($resultado[0]['idTraspaso'])
						{
							if($idTraspaso == 'null')
								$idTraspaso = (int)$resultado[0]['idTraspaso'];
							
							$respuesta = 1;
							$mensaje = 'Se ha '.$accion.' el traspaso exitosamente.';
							$parametros['nombres'] = $nombres;
							$parametros['apellidos'] = $apellidos;
							$parametros['celular'] = $celular;
							$parametros['idTraspaso'] = $idTraspaso;
							
							$se_envio = $this->enviasmsacliente($parametros);
							$mensaje = $mensaje.'. Se ha enviado un SMS al Cliente '.$nombres.' '.$apellidos.' para validar su identidad.';
						}
					}else
					{
						if($resultado === 0)
						{
							$mensaje = 'Ha ocurrido un error al '.$accion.' la categor&iacute;a, la categor&iacute;a no se encuentra registrado.';
						}
					}
					$data['respuesta'] = $respuesta;
					$data['mensaje'] = $mensaje;
					echo json_encode($data);
				}
			}
		}
	}

	public function eliminarTraspaso()
	{
		$traspaso = $this->session->userdata();
		if($traspaso){
			$idTraspaso = null;
			if($this->input->POST('idTraspaso'))
				$idTraspaso = $this->input->POST('idTraspaso');
			$resultado = $this->traspaso_model->eliminarTraspaso($idTraspaso, $traspaso['id_traspaso']);
			$respuesta = 0;
			if($resultado > 0)
				$respuesta = 1;
			echo json_encode($respuesta);
		}
	}

	public function modificarTraspaso()
	{
		$traspaso = $this->session->userdata();
		if($traspaso){
			$traspaso['titulo'] = 'Modificar Traspaso';
			$traspaso['controller'] = 'traspaso';

			if($this->input->GET('idTraspaso') && $this->input->GET('idTraspaso'))
			{
				//mysqli_next_result($this->db->conn_id);
				$idTraspaso = $this->input->GET('idTraspaso');
				$traspasoSeleccionado =  $this->traspaso_model->obtenerTraspaso($idTraspaso);
				$traspaso['traspasoSeleccionado'] = $traspasoSeleccionado[0];

				mysqli_next_result($this->db->conn_id);
				$perfiles =  $this->perfil_model->obtenerPerfiles($traspaso["id_traspaso"]);
				if($perfiles)
					$traspaso['perfiles'] = $perfiles;

				mysqli_next_result($this->db->conn_id);

				$empresas =  $this->traspaso_model->obtenerEmpresasUsu($traspaso["id_traspaso"]);
				if($empresas)
				{
					$traspaso['empresas'] = $empresas;
				}


				//var_dump($equipo[0]);
				
				//$eacs = array_unique(array_column($equipo, 'nombre'), array_column($equipo, 'abreviacion'), array_column($equipo, 'descripcion'));
				//$eacs = array_unique(array_map("serialize", $equipo));
				//var_dump($temp);
				/*$cat_pauta = array_intersect_key($pauta, $temp);
				$traspaso['cat_pauta'] = $cat_pauta;*/
			}

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $traspaso);
			$this->load->view('agregarTraspaso', $traspaso);
			$this->load->view('temp/footer');
		}
	}
	
	public function enviasmsacliente($parametros){

    	//var_dump($parametros); exit();
	    //$portafolio = $parametros['folio'];
	    //$pcs=$parametros['pcs'];
	    //$idllamada=$parametros['idllamada'];
	    //$rut=$parametros['rut'];
	    //$tipo=$parametros['tipo'];
	    $codsms=null;

	    var $nombre = 

	    $mensaje = 'Hola '.$parametros['nombres'].' '.$parametros['apellidos'].', bienvenido a nuestra plataforma de verificación de identidad. Favor ingresa a éste link para validar tu identidad. '.base_url().'/Traspaso/'.$parametros['idTraspaso'].' .';

	    // echo $idllamada; exit();
	    ini_set("soap.wsdl_cache_enabled", "0"); 

	    //$mensaje = "Número de Atención: ".$idllamada." Rut Cliente: ".$rut;

	    //$client = new SoapClient(WS_URL_ITD);
	    $client = new SoapClient('http://ida.itdchile.cl/services/smsApiService?wsdl');

	    $array_ws = array('in0' => 'gs_salud',
	                      'in1' => 'gs_salud',
	                      'in2' => $parametros['celular'],
	                      'in3' => $mensaje);

	    $response = $client->sendSms($array_ws);
	    //var_dump($response); exit();
	    $codsms = $response->out->entry[1]->value;
	    //var_dump($response);
	    //echo $codsms; exit();

	    if ($codsms != null and $codsms != '' and $codsms != '-1') {       
	    return 1;
	      }else{
	    return 0;
	      } 
    }

}
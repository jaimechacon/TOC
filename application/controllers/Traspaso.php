<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traspaso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('traspaso_model');
		$this->load->model('perfil_model');
		$this->load->library('pdf');
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

	public function listarTraspasos()
	{
		$usuario = $this->session->userdata();
		if($usuario){
			$traspasosUsuario = $this->traspaso_model->obtenerTraspasosUsu($usuario["id_usuario"], "null", "null", "null");
			$usuario['traspasos'] = $traspasosUsuario;
			$usuario['controller'] = 'traspaso';
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('listarTraspasosUsuario', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}
/*
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

			$this->dompdf->loadHtml('hello world');
			$this->dompdf->setPaper('A4', 'landscape');
			$this->dompdf->render();
			$output = $dompdf->output();
			var_dump($output);
			//$this->dompdf->stream("/path-to-save-pdf-file/sample.pdf");		

			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('agregarTraspaso', $usuario);
			$this->load->view('temp/footer', $usuario);
		}
	}

	public function verificarIdentidadCliente($idFolio)
	{
		//$usuario = $this->session->userdata();
		//if($usuario){
			$usuario['titulo'] = 'Verificar Identidad';
			$usuario['controller'] = 'traspaso';
			$usuario['idTraspaso'] = $idFolio;
			

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


			//$this->load->view('temp/header');
			//$this->load->view('temp/menu', $usuario);
			$this->load->view('verificarIdentidadCliente', $usuario);
			//$this->load->view('temp/footer', $usuario);
		//}
	}

	public function verificarIdentidad()
	{
		header('Content-Type: application/json');
		$apiKey = '7b8a72c87f4a415b8603e16c6b6afcee';

		if (isset($_POST['documentType']) && ($_FILES['id_front']['size'] != '') && ($_FILES['id_back']['size'] != '') && ($_FILES['selfie']['size'] != '')
		 && ($_POST['documentType'] != '')) {
		    $id_front =  file_get_contents($_FILES["id_front"]['tmp_name']);
			$id_back = file_get_contents($_FILES["id_back"]['tmp_name']);
			$selfie = file_get_contents($_FILES["selfie"]['tmp_name']);
		    $documentType = $_POST['documentType'];
		    $params = array(
		        'apiKey' => $apiKey,
		        'id_front' => $id_front,
		        'id_back' => $id_back,
		        'selfie' => $selfie,
		        'documentType' => $documentType
		    );
		    $apiCall = $this->CallAPI('POST', 'https://sandbox-api.7oc.cl/v2/face-and-document', $params);
		    var_dump($apiCall);
		    echo $apiCall;
		} elseif (($_FILES['photo1']['size'] != '') && ($_FILES['photo2']['size'] != '')) {
		    $photo1 =  file_get_contents($_FILES["photo1"]['tmp_name']);
		    $photo2 = file_get_contents($_FILES["photo2"]['tmp_name']);
		    $params = array(
		        'apiKey' => $apiKey,
		        'photo1' => $photo1,
		        'photo2' => $photo2
		    );
		    $apiCall = $this->CallAPI('POST', 'https://sandbox-api.7oc.cl/v2/face-and-face', $params);
		    echo $apiCall;
		} else {
		    echo "Error en los datos para consumir API: (" . $_POST['documentType'] . ") (" . $_FILES['selfie']['tmp_name'] . ") (" . $_FILES['selfie']['size'] . ")";
		}
	}

	

	public function CallAPI($method, $url, $data = false)
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
		return json_encode($result);
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
							$this->enviar($email, $nombres, $apellidos, $idTraspaso);
							$mensaje = $mensaje.'. Se ha enviado un SMS y un Email al Cliente '.$nombres.' '.$apellidos.' para validar su identidad.';
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


	public function usuarioValido()
	{
		if(!is_null($this->input->POST('datos')))
		{
			$datos = $this->input->POST('datos');

			$id_traspaso = 'null';
            $id_front = 'null';
            $id_back = 'null';
            $selfie = 'null';
            $biometric_result = 'null';
            $checksum = 'null';
            $date_of_birth = 'null';
            $document_number = 'null';
            $expiration_date = 'null';
            $family_name = 'null';
            $gender = 'null';
            $name = 'null';
            $national_identification_number = 'null';
            $nationality = 'null';
            $raw = 'null';
            $type = 'null';
            $status = 'null';
            $toc_token = 'null';
            $latitude = 'null';
            $longitude = 'null';
            
			if(strlen($datos["id_traspaso"]))
				$id_traspaso = $datos["id_traspaso"];

			if(strlen($datos["id_front"]))
				$id_front = $datos["id_front"];

			if(strlen($datos["id_back"]))
				$id_back = $datos["id_back"];

			if(strlen($datos["selfie"]))
				$selfie = $datos["selfie"];

			if(strlen($datos["biometric_result"]))
				$biometric_result = $datos["biometric_result"];

			if(strlen($datos["checksum"]))
				$checksum = $datos["checksum"];

			if(strlen($datos["date_of_birth"]))
				$date_of_birth = $datos["date_of_birth"];

			if(strlen($datos["document_number"]))
				$document_number = $datos["document_number"];

			if(strlen($datos["expiration_date"]))
				$expiration_date = $datos["expiration_date"];

			if(strlen($datos["family_name"]))
				$family_name = $datos["family_name"];

			if(strlen($datos["gender"]))
				$gender = $datos["gender"];

			if(strlen($datos["name"]))
				$name = $datos["name"];

			if(strlen($datos["national_identification_number"]))
				$national_identification_number = $datos["national_identification_number"];

			if(strlen($datos["nationality"]))
				$nationality = $datos["nationality"];

			if(strlen($datos["raw"]))
				$raw = $datos["raw"];

			if(strlen($datos["type"]))
				$type = $datos["type"];

			if(strlen($datos["status"]))
				$status = $datos["status"];

			if(strlen($datos["toc_token"]))
				$toc_token = $datos["toc_token"];

			if(strlen($datos["latitude"]))
				$latitude = $datos["latitude"];

			if(strlen($datos["longitude"]))
				$longitude = $datos["longitude"];

			$resultado = $this->traspaso_model->validarUsuario($id_traspaso, $id_front, $id_back, $selfie, $biometric_result, $checksum, $date_of_birth, $document_number, $expiration_date, $family_name, $gender, $name, $national_identification_number, $nationality, $raw, $type, $status, $toc_token, $latitude, $longitude);
			echo json_encode($resultado);
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

	    $nombre = explode(" ", $parametros['nombres'])[0];
	    $apellido = explode(" ", $parametros['apellidos'])[0];

	    $mensaje = 'Provida: Estimado '.$nombre.' '.$apellido.', verifica tu identidad en la url: '.base_url().'Traspaso/verificarIdentidadCliente/'.$parametros['idTraspaso'].' .';

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

    public function enviar($emailCliente, $nombresCliente, $apellidosClientes, $idTraspaso){
	  
		$mensaje = 'Bienvenido '.$nombresCliente.' '.$apellidosClientes.', somos AFP Provida, favor verifica tu identidad en el siguiente link. '.base_url().'Traspaso/verificarIdentidadCliente/'.$idTraspaso.' .';

		$this->load->library('email');
		$confing =array(
		'protocol'=>'smtp',
		'smtp_host'=>"smtp.gmail.com",
		'smtp_port'=>465,
		'smtp_user'=>"mcfly@gsbpo.cl",
		'smtp_pass'=>"gsbpo2018",
		'smtp_crypto'=>'ssl',              
		'mailtype'=>'html'  
		);

		$this->email->initialize($confing);
		$this->email->set_newline("\r\n");
		$this->email->from('validacion@provida.cl');
		$this->email->to($emailCliente);
		$this->email->subject('AFP Provida, validacion de Identidad');
		$this->email->message($mensaje);

		if(!$this->email->send()) {
		    return 1;
		}
	}   


}
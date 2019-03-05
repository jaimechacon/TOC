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

			#$this->dompdf->loadHtml('hello world');
			#$this->dompdf->setPaper('A4', 'landscape');
			#$this->dompdf->render();
			#$output = $this->dompdf->output();
			#$output = $dompdf->output();
			#var_dump($output);
			//$this->dompdf->stream("/path-to-save-pdf-file/sample.pdf");		

			//var_dump($output);

			//GUARDA EN CIERTA RUTA DEL SERVIDOR EL ARCHIVO GENERADO
			#file_put_contents('Brochure.pdf', $output);

				/*$this->dompdf->loadHtml("<html> 
				    <head> 
				        <style type='text/css'> 
				            .textBold { font-family: 'Helvetica'; font-size: 8; } 
				        </style> 
				    </head> 
				    <body topmargin='0' leftmargin='0'> 
				        <table border='0' align='center' cellspacing='4' cellpadding='0' width='100%'> 
			                <tr><td colspan='16' align='center' class='textBold'><b>Certificado de Validación de Cliente</b></td></tr>
			                <tr><td colspan='6' class='textBold'><b>AFP Provida</b></td></tr> 
			                <tr> 
			                    <td class='textBold' align='center'><b>Cedula de Identidad</b></td> 
			                    <td class='textBold' align='center' colspan='2'><b>Nombres</b></td> 
			                    <td align='center' class='textBold'><b>DIAS<br>Apellidos<br></b></td> 
			                    <td align='center' class='textBold'><b>Fecha Nacimiento</b></td>
			                    <td align='center' class='textBold'><b>Genero</b></td>
			                    <td align='center' class='textBold'><b>Fecha de Emision</b></td> 
			                    <td align='center' class='textBold'><b>N° de Documento</b></td> 
			                    <td align='center' class='textBold'><b>Nacionalidad</b></td> 
			                    <td align='center' class='textBold'><b>Codigo Cedula</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold' align='center'><b>175903267</b></td> 
			                    <td class='textBold' align='center' colspan='2'><b>Jaime Francisco</b></td> 
			                    <td align='center' class='textBold'><b>DIAS<br>Chacon Arevalo<br></b></td> 
			                    <td align='center' class='textBold'><b>31101990</b></td>
			                    <td align='center' class='textBold'><b>Masculino</b></td>
			                    <td align='center' class='textBold'><b>06012016</b></td> 
			                    <td align='center' class='textBold'><b>107.311.071</b></td> 
			                    <td align='center' class='textBold'><b>Chileno</b></td> 
			                    <td align='center' class='textBold'><b>123345676543234lkjjklljksdaf</b></td> 
			                </tr>
				        </table> 
				    </body> 
				</html>");*/

				//file_put_contents('Hola.pdf', $output);

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
		    $idTraspaso = (int)$_POST['idTraspaso'];
		    $latitude = $_POST['latitude'];
		    $longitude = $_POST['longitude'];
		    $params = array(
		        'apiKey' => $apiKey,
		        'id_front' => $id_front,
		        'id_back' => $id_back,
		        'selfie' => $selfie,
		        'documentType' => $documentType
		    );
		    $apiCall = $this->CallAPI('POST', 'https://sandbox-api.7oc.cl/v2/face-and-document', $params);
			$response = json_decode(json_decode($apiCall), true);

            $biometric_result = '';
            $checksum = '';
            $date_of_birth = '';
            $document_number = '';
            $expiration_date = '';
            $family_name = '';
            $gender = '';
            $name = '';
            $national_identification_number = '';
            $nationality = '';
            $raw = '';
            $type = '';
            $status = '';
            $toc_token = '';
            $toc_token_pdf = '';
            $status_pdf = '';
            $signed_pdf = '';

            $fecha_creacion = '';
			$id_cliente = '';
			$observacionesTraspaso = '';
			$id_estados_traspasos = '';
			$estado = '';
			$descripcion_estado = '';
			$nombre_cliente = '';
			$apellidos_cliente = '';
			$email_cliente = '';
			$celular_cliente = '';
			$fecha_nac_cliente = '';
			$run_cliente = '';
			$id_usuario = '';
			$u_cod_usuario = '';
			$u_rut = '';
			$u_nombres = '';
			$u_apellidos = '';
			$u_email = '';

            if(isset($response['biometric result']))
                $biometric_result =  $response["biometric result"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']))
                if(isset($response["information from document"]["mrz"]["checksum"]))
                    $checksum = $response["information from document"]["mrz"]["checksum"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["date of birth"]))
                    $date_of_birth = $response["information from document"]["mrz"]["data"]["date of birth"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["document number"]))
                    $document_number = $response["information from document"]["mrz"]["data"]["document number"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["expiration date"]))
                    $expiration_date = $response["information from document"]["mrz"]["data"]["expiration date"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["family name"]))
                    $family_name = $response["information from document"]["mrz"]["data"]["family name"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["gender"]))
                    $gender = $response["information from document"]["mrz"]["data"]["gender"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["name"]))
                    $name = $response["information from document"]["mrz"]["data"]["name"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["national identification number"]))
                    $national_identification_number = $response["information from document"]["mrz"]["data"]["national identification number"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']) && isset($response["information from document"]["mrz"]["data"]))
                if(isset($response["information from document"]["mrz"]['data']["nationality"]))
                    $nationality = $response["information from document"]["mrz"]["data"]["nationality"];

            if(isset($response['information from document']) && isset($response["information from document"]['mrz']))
                if(isset($response["information from document"]["mrz"]["raw"]))
                    $raw = $response["information from document"]["mrz"]["raw"];

            if(isset($response['information from document']) && isset($response["information from document"]['type']))
                $type = $response["information from document"]["type"];

            if(isset($response['status']))
                $status =  $response["status"];

            if(isset($response['toc_token']))
                $toc_token =  $response["toc_token"];

            /*var_dump($biometric_result);
            var_dump($checksum);
            var_dump($date_of_birth);
            var_dump($document_number);
            var_dump($expiration_date);
            var_dump($family_name);
            var_dump($gender);
            var_dump($name);
            var_dump($national_identification_number);
            var_dump($nationality);
            var_dump($raw);
            var_dump($type);
            var_dump($status);
            var_dump($toc_token);*/

            if(($biometric_result == "1" && $status == "200") || ($biometric_result == "2" && $status == "200"))
            {
            	//$apiKey = '2baea4569b4544128ae83154e4d8a27b';

            	$resultado = $this->traspaso_model->obtenerTraspaso($idTraspaso);
            	if($resultado[0] > 0)
				{
					if($resultado[0]['folio'])
					{
						$fecha_creacion = $resultado[0]['fecha'];
						$id_cliente = (int)$resultado[0]['id_cliente'];
						$observacionesTraspaso = $resultado[0]['observaciones'];
						$id_estados_traspasos = (int)$resultado[0]['id_estados_traspasos'];
						$estado = $resultado[0]['estado'];
						$descripcion_estado = $resultado[0]['descripcion'];
						$nombre_cliente = $resultado[0]['nombre_cliente'];
						$apellidos_cliente = $resultado[0]['apellidos_cliente'];
						$email_cliente = $resultado[0]['email_cliente'];
						$celular_cliente = $resultado[0]['celular_cliente'];
						$fecha_nac_cliente = $resultado[0]['fecha_nac_cliente'];
						$run_cliente = $resultado[0]['run_cliente'];
						$id_usuario = (int)$resultado[0]['id_usuario'];
						$u_cod_usuario = $resultado[0]['u_cod_usuario'];
						$u_rut = $resultado[0]['u_rut'];
						$u_nombres = $resultado[0]['u_nombres'];
						$u_apellidos = $resultado[0]['u_apellidos'];
						$u_email = $resultado[0]['u_email'];					
					}
				}

            	$this->dompdf->loadHtml("<html>
				    <head> 
				        <style type='text/css'> 
				            .textBold { font-family: 'Helvetica'; font-size: 8; } 
				        </style> 
				    </head> 
				    <body topmargin='0' leftmargin='0'>
				    	<img src='assets/img/logo.png' width='80' class='d-inline-block align-top' alt=''>

				        <table border='0' align='center' cellspacing='4' cellpadding='0' width='100%'> 
			                <tr><td colspan='2' align='center' class='textBold'><h2>Certificado de Validación de Cliente</h2></td></tr>
			                <tr><td colspan='2' align='center' class='textBold'><h2>AFP Provida</h2></td></tr> 
 							<tr><td colspan='2' align='center' class='textBold'></br></td></tr> 
			                <tr><td colspan='2' align='center' class='textBold'><h4>Datos del Cliente</h4></td></tr> 
			                <tr> 
			                    <td class='textBold'><b>Cedula de Identidad</b></td> 
			                    <td class='textBold'><b>".$run_cliente."</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Nombres</b></td>
			                    <td class='textBold'><b>".$nombre_cliente."</b></td> 
		                    </tr>
			                <tr> 
			                    <td class='textBold'><b>Apellidos</b></td> 
			                    <td class='textBold'><b>".$apellidos_cliente."</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Fecha Nacimiento</b></td>
			                    <td class='textBold'><b>".$fecha_nac_cliente."</b></td>
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Email</b></td>
			                    <td class='textBold'><b>".$email_cliente."</b></td>
			                </tr>
			                <tr><td colspan='2' align='center' class='textBold'></br></td></tr> 
			                <tr><td colspan='2' align='center' class='textBold'><h4>Datos Ejecutivo de Ventas</h4></td></tr>
			                <tr> 
			                    <td class='textBold'><b>Cedula de Identidad Ejecutivo</b></td> 
			                    <td class='textBold'><b>".$u_rut."</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Codigo Ejecutivo</b></td> 
			                    <td class='textBold'><b>".$u_rut."</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Nombres</b></td>
			                    <td class='textBold'><b>".$u_nombres."</b></td> 
		                    </tr>
			                <tr> 
			                    <td class='textBold'><b>Apellidos</b></td> 
			                    <td class='textBold'><b>".$u_apellidos."</b></td> 
			                </tr>
			                <tr> 
			                    <td class='textBold'><b>Email</b></td>
			                    <td class='textBold'><b>".$email_cliente."</b></td>
			                </tr>
				        </table> 
				    </body> 
				</html>");

				//$this->dompdf->loadHtml('Hello word');
				#$this->dompdf->setPaper('A4', 'landscape');
				$this->dompdf->render();
				$output = $this->dompdf->output();
				$pdf = $output;

				$configuracion = array (
				    "apiKey"     => $apiKey,
				    "toc_token"  => $toc_token,
				    "pdf"        => $pdf,
				    "pos_x"      => 120,
				    "pos_y"      => 200,
				    "page"       => 1
				);

				$url = 'https://sandbox-api.7oc.cl/signer/v1/simple-sign';

				try {
				    $curl = curl_init($url);
				    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				    curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
				    curl_setopt($curl , CURLOPT_POSTFIELDS, $configuracion);

				    $curl_response = curl_exec($curl);
				    curl_close($curl);
				    //var_dump($curl);
				    //var_dump($curl_response);
				    //$response2 = json_decode(json_decode($curl_response), true);
				    //var_dump($response);
				    //var_dump($curl);
				    
				    $response2 =  json_decode($curl_response);
				    $response['document'] = json_encode($response2, true);


				    $datos_pdf = json_decode($curl_response, true);

				    //var_dump(json_decode($curl_response, true)['signed pdf']);

				     if(isset($datos_pdf['signed pdf']))
                		$signed_pdf =  base64_encode($datos_pdf['signed pdf']);

            	  	if(isset($datos_pdf['status']))
                		$status_pdf =  $datos_pdf['status'];

            	  	if(isset($datos_pdf['toc_token']))
                		$toc_token_pdf =  $datos_pdf['signed pdf'];

                	$f_front = base64_encode($id_front);
                	$f_back = base64_encode($id_back);

				     $pdf = base64_decode(json_decode($curl_response, true)['signed pdf']);


				    $mensaje_pdf = 'Estimado '.$nombre_cliente.' '.$apellidos_cliente.', somos AFP Provida, informamos que tu solicitud traspaso de AFP se ha enviado exitosamente.';

					$this->enviar($email_cliente, $nombre_cliente, $apellidos_cliente, $idTraspaso, $mensaje_pdf, 'Solicitud de Traspaso exitosa', $pdf);


					/*$resultadoValidacion = $this->traspaso_model->validarUsuario($idTraspaso, $f_front, $f_back, $selfie, $biometric_result, $checksum, $date_of_birth, $document_number, $expiration_date, $family_name, $gender, $name, $national_identification_number, $nationality, $raw, $type, $status, $toc_token, $latitude, $longitude, $toc_token_pdf, $status_pdf, $signed_pdf);

					if($resultadoValidacion[0] > 0)
					{
						if($resultado[0]['resultado'])
						{

						}
					}*/
					#$mensaje .= '. Se ha enviado un SMS y un Email al Cliente '.$nombres.' '.$apellidos.' para validar su identidad.';

				    //var_dump($response2);

				 }
				catch(Exception $e){
				    echo "Error " . $e;
				    throw new Exception("Invalid URL",0,$e);
				 }
            }

		    //echo $apiCall;
		    echo json_encode($response);
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

							$mensaje_sms = 'Bienvenido '.$nombres.' '.$apellidos.', somos AFP Provida, favor verifica tu identidad en el siguiente link. '.base_url().'Traspaso/verificarIdentidadCliente/'.$idTraspaso.' .';

							$this->enviar($email, $nombres, $apellidos, $idTraspaso, $mensaje_sms, 'AFP Provida, validacion de Identidad', null);

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
            $toc_token_pdf = 'null';
            $status_pdf = 'null';
            $signed_pdf = 'null';

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

			if(strlen($datos["toc_token_pdf"]))
				$toc_token_pdf = $datos["toc_token_pdf"];

			if(strlen($datos["status_pdf"]))
				$status_pdf = $datos["status_pdf"];

			if(strlen($datos["signed_pdf"]))
				$signed_pdf = $datos["signed_pdf"];

			$resultado = $this->traspaso_model->validarUsuario($id_traspaso, $id_front, $id_back, $selfie, $biometric_result, $checksum, $date_of_birth, $document_number, $expiration_date, $family_name, $gender, $name, $national_identification_number, $nationality, $raw, $type, $status, $toc_token, $latitude, $longitude, $toc_token_pdf, $status_pdf, $signed_pdf);
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

	    $array_ws = array('in0' => 'psandoval',
	                      'in1' => 'psandoval159',
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

    public function enviar($emailCliente, $nombresCliente, $apellidosClientes, $idTraspaso, $mensaje, $asunto, $archivo){

		$this->load->library('email');
		$confing =array(
		'protocol'=>'smtp',
		'smtp_host'=>"smtp.gmail.com",
		'smtp_port'=>465,
		'smtp_user'=>"validacion@gsbpo.cl",
		'smtp_pass'=>"black.Hole2019$$",
		'smtp_crypto'=>'ssl',              
		'mailtype'=>'html'  
		);
		if (isset($archivo) != null)
			$this->email->attach($archivo, 'application/pdf', "Pdf File " . date("m-d H-i-s") . ".pdf", false);
			//$this->email->attach($archivo);
		$this->email->initialize($confing);
		$this->email->set_newline("\r\n");
		$this->email->from('validacion@gsbpo.cl');
		$this->email->to($emailCliente);
		$this->email->subject($asunto);
		$this->email->message($mensaje);

		if(!$this->email->send()) {
		    return 1;
		}
	}   


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$usuario = $this->session->userdata();

		if($this->session->has_userdata('id_usuario'))
		{			
			$perfil = $this->usuario_model->traerPerfilUsu($usuario["id_usuario"]);
			$usuario['perfil'] = $perfil[0];
			$this->load->view('temp/header');
			$this->load->view('temp/menu', $usuario);
			$this->load->view('inicioSesion', $usuario);
			$this->load->view('temp/footer');
		}else
		{
			$this->session->sess_destroy();
			$login['login'] = 0;
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

	public function llenacombo()
	{
		$options="";
	     if ($_POST["micategoria"]== 'compraventa') 
	     {
	         $options= '
	         <option value="bebes-ninos">Artículos de bebes y niños</option>
	         <option value="sonido">Sonido</option>
	         <option value="consolas-videojuegos">Consolas y videojuegos</option>
	         <option value="moviles">Móviles</option>
	         <option value="libros">Libros</option>
	         <option value="muebles">Muebles</option>
	         <option value="electrodomesticos">Electrodomésticos</option>
	         <option value="articulos-informatica">Artículos de informática</option>
	         <option value="tv-video">Televisión y video</option>
	         <option value="reproductores-dvd">Reproductores dvd</option>
	         <option value="video-camaras">Video cámaras</option>
	         ';    


	     }
	     if ($_POST["micategoria"]=='inmobiliaria') {
	         $options= '
	     	<option value="venta-pisos">Vendo piso</option>
	         <option value="venta-casas">Vendo casa</option>
	     	<option value="venta-terrenos">Vendo terreno</option>
	         <option value="venta-locales">Vendo local</option>
	         <option value="venta-lofts">Vendo loft</option>
	         <option value="alquiler-pisos">Alquilo piso</option>
	         <option value="alquiler-habitaciones">Alquilo habitación</option>
	     	<option value="alquiler-vacaciones">Alquilo para vacaciones</option>
	         <option value="alquiler-casas">Alquilo casa</option>
	         <option value="alquiler-locales">Alquilo local</option>
	         <option value="alquiler-loft">Alquilo loft</option>
	         ';    
	     }
	     if ($_POST["micategoria"]=='motor') {
	         $options= '
	     	<option value="coches">Coches</option>
	     	<option value="coches-sin-carnet">Coches sin carné</option>
	         <option value="motocicletas">Motocicletas</option>
	         <option value="caravanas">Caravanas</option>
	         <option value="furgonetas">Furgonetas</option>
	     	<option value="camiones">Camiones</option>
	         <option value="accesorios">Accesorios</option>
	         <option value="ciclomotores">Ciclomotores</option>
	         <option value="todo-terrenos">Todo terrenos</option>
	         <option value="quads">Quads</option>
	         <option value="karts">Karts</option>
	         ';    
	     }
	if ($_POST["micategoria"]=='servicios') {
	         $options= '
	     	<option value="mudanzas">Mudanzas</option>
	         <option value="reparaciones">Reparaciones</option>
	     	<option value="limpieza">Limpieza</option>
	         <option value="informatica">Informática</option>
	         <option value="canguros">Canguros</option>
	         <option value="cuidados-animales">Cuidados animales</option>
	     	<option value="horoscopo-tarot">Horóscopo/Tarot</option>
	         ';    
	     }
	     if ($_POST["micategoria"]=='empleo') {
	         $options= '
	         <option value="abogados">Abogados</option>
	         <option value="administrativos">Administrativos</option>
	         <option value="comerciales">Comerciales</option>
	         <option value="freelance">Freelance</option>
	         <option value="informatica">Informática</option>
	         <option value="voluntarios">Voluntarios</option>
	         <option value="atencion-cliente">Atención al cliente</option>
	         <option value="hosteleria">Hosteleria</option>
	         <option value="construccion">Construcción</option>
	         <option value="transportistas">Transportistas</option>
	         <option value="vigilantes">Vigilantes</option>
	         <option value="mensajeros">Mensajeros</option>
	         ';    
	     }
	if ($_POST["micategoria"]=='mascotas') {
	         $options= '
	         <option value="perros">Perros</option>
	         <option value="gatos">Gatos</option>
	         <option value="peces">Peces</option>
	         <option value="roedores">Roedores</option>
	         <option value="pajaros">Pájaros</option>
	         <option value="tortugas">Tortugas</option>
	         <option value="camaleones">Camaleones</option>
	         <option value="caballos">Caballos</option>
	         <option value="otros-animales">Otros animales</option>
	         ';    
	     }
	if ($_POST["micategoria"]=='contactos') {
	         $options= '
	         <option value="chica-busca-chico">Chica busca chico</option>
	         <option value="chica-busca-chica">Chica busca chica</option>
	         <option value="chico-busca-chica">Chico busca chica</option>
	         <option value="chico-busca-chico">Chico busca chico</option>
	         <option value="relaciones-ocasionales">Relaciones esporádicas</option>
	         <option value="eroticos-profesionales">Profesionales</option>
	         ';    
	     }
	if ($_POST["micategoria"]=='antiguedades') {
	         $options= '
	 <option value="monedas">Monedas</option>
	     	<option value="cuadros">Cuadros</option>
	     	<option value="sellos">Sellos</option>
	         <option value="cromos">Cromos</option>
	         <option value="mobiliario">Mobiliario</option>
	         <option value="relojes">Relojes</option>
	     	<option value="otras-antiguedades">Otras antigüedades</option>
	         ';    
	     }
	if ($_POST["micategoria"]=='consolas-videojuegos') {
	         $options= '
	     <option value="gamecube">Game cube</option>
	         <option value="gameboy-advance">Gameboy advance</option>
	         <option value="gameboy">Gameboy</option>
	         <option value="nintendo-wii">Nintendo wii</option>
	         <option value="nintendo-ds">Nintendo ds</option>
	         <option value="nintendo-64">Nintendo 64</option>
	         <option value="dreamcast">Dreamcast</option>
	         <option value="psp">Psp</option>
	         <option value="playstation1">Playstation 1</option>
	         <option value="playstation2">Playstation 2</option>
	         <option value="playstation3">Playstation 3</option>
	         <option value="xbox">Xbox</option>
	         ';    
	     }

	    echo $options; 
	}


}

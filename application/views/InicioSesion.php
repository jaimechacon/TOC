<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
?>

<div class="col-sm-12 mt-3">
	<div class="row">
		<h4>Bienvenido <?php echo $u_nombres.' '.$u_apellidos; ?></h4>
	</div>
	<div class="row mt-3">
		<h4>Usted es un <?php echo $perfil['perfil'];//echo $perfil; ?></h4>
	</div>

</div>

<label>Selecciona una categoría</label>
 <select name="categoria" id="categoria">
 <option value="">Selecciona una categoría</option>
 <option value="compraventa">Compra y venta</option>
 <option value="inmobiliaria">Mundo Inmobiliario</option>
 <option value="motor">Mundo motor</option>
 <option value="empleo">Empleo</option>
 <option value="consolas-videojuegos">Consolas y videojuegos</option>
 <option value="servicios">Servicios</option>
 <option value="mascotas">Mascotas</option>
 <option value="contactos">Contactos</option>
 <option value="antiguedades">Antigüedades</option>
 </select>
         <label>Selecciona una subcategoría</label>
 <select name="subcategoria" id="subcategoria">
 <option value="">Selecciona una subcategoría</option>
 </select>



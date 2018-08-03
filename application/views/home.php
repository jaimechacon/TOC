<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('login');
	}
?>

<div class="flex-row">
	Bienvenido estimado
	<br/>

	<br/><br/>
	<?php if(isset($id_usuario)) { echo $id_usuario; } ?><br/><br/>
	<?php if(isset($u_nombres)) { echo $u_rut; } ?><br/><br/>
	<?php if(isset($u_nombres)) { echo $u_nombres; } ?><br/><br/>
	<?php if(isset($u_apellidos)) { echo $u_apellidos; } ?><br/><br/>
	
	
</div>
<?php
	$id_usuario=$this->session->userdata('id_usuario');
	
	if(!$id_usuario){
	  redirect('Login');
	}

	//var_dump($plantillas);
?>
<div class="row">
	<div class="col-sm-12">
		<div id="titulo" class="mt-3">
			<h3>
				<i class="plusTitulo mb-2" data-feather="<?php echo ($titulo == 'Agregar Traspaso' ? 'plus' : 'edit-3'); ?>" ></i><?php echo $titulo; ?>
			</h3>
		</div>
	</div>
	<div class="col-sm-12">
		<div id="filtros" class="mt-3 mr-3 ml-3">
			<form id="agregarTraspaso" action="agregarTraspaso" method="POST">
				<div class="row">
					<input type="text" class="form-control form-control-sm" id="inputIdTraspaso" name="inputIdTraspaso" value="<?php if(isset($traspaso['id_traspaso'])): echo $traspaso['id_traspaso']; endif; ?>" hidden>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputCantEac">R.U.N.</label>
						<input type="text" class="form-control  form-control-sm" id="inputRun" name="inputRun" placeholder="Ingrese el R.U.N. del Cliente" value="<?php if(isset($usuario['c_run'])): echo $usuario['c_run']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputFechaNacimiento">Fecha Nacimiento</label>
						<input type="date" class="form-control  form-control-sm" id="inputFechaNacimiento" name="inputFechaNacimiento" placeholder="Ingrese la Fecha de Nacimiento del Cliente" value="<?php if(isset($usuario['c_fecha_nac'])): echo $usuario['c_fecha_nac']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputNombres">Nombres</label>
						<input type="text" class="form-control  form-control-sm" id="inputNombres" minlength="1" placeholder="Ingrese los Nombres del Cliente" name="inputNombres" value="<?php if(isset($usuario['c_nombres'])): echo $usuario['c_nombres']; endif; ?>">
						<!--<span>Se requiere un Nombre de Traspaso.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputApellidos">Apellidos</label>
						<input type="text" class="form-control  form-control-sm" id="inputApellidos" name="inputApellidos" placeholder="Ingrese los Apellidos del Cliente" value="<?php if(isset($usuario['c_apellidos'])): echo $usuario['c_apellidos']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputEmail">Email</label>
						<input type="text" class="form-control  form-control-sm" id="inputEmail" name="inputEmail" placeholder="Ingrese Email del Cliente" value="<?php if(isset($usuario['c_email'])): echo $usuario['c_email']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCelular">Celular</label>
						<input type="text" class="form-control  form-control-sm" id="inputCelular" name="inputCelular" placeholder="Ingrese Celular del Cliente" value="<?php if(isset($usuario['c_celular'])): echo $usuario['c_celular']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputTelefono">Telefono</label>
						<input type="text" class="form-control  form-control-sm" id="inputTelefono" name="inputTelefono" placeholder="Ingrese Telefono del Cliente" value="<?php if(isset($usuario['c_telefono'])): echo $usuario['c_telefono']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Traspaso.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputObservaciones">Observaciones</label>
						<textarea class="form-control form-control-sm block" id="inputObservaciones" name="inputObservaciones" rows="2"><?php if(isset($usuario['c_descripcion'])): echo $usuario['c_descripcion']; endif; ?></textarea>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Traspaso/ListarTraspasos">Volver</a>
					</div>
					<div  class="col-sm-6 text-right">
					 	<button type="submit" class="btn btn-primary submit"><?php echo $titulo;?></button>
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>

<div id="loader" class="loader" hidden></div>

<!-- Modal Mensaje -->
<div class="modal fade" id="modalMensajeTraspaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloMC"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p id="parrafoMC"></p>
      </div>
      <div class="modal-footer">
        <button id="btnCerrarMC" type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
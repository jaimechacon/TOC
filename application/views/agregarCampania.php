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
				<i class="plusTitulo mb-2" data-feather="<?php echo ($titulo == 'Agregar Campania' ? 'plus' : 'edit-3'); ?>" ></i><?php echo $titulo; ?>
			</h3>
		</div>
	</div>
	<div class="col-sm-12">
		<div id="filtros" class="mt-3 mr-3 ml-3">
			<form id="agregarCampania" action="agregarCampania" method="POST">
				<div class="row">
					<input type="text" class="form-control form-control-sm" id="inputIdCampania" name="inputIdCampania" value="<?php if(isset($campania['id_campania'])): echo $campania['id_campania']; endif; ?>" hidden>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputNombre">Nombre</label>
						<input type="text" class="form-control  form-control-sm" id="inputNombre" minlength="1" placeholder="Ingrese Nombre Campa&ntilde;a" name="inputNombre" value="<?php if(isset($campania['c_nombre'])): echo $campania['c_nombre']; endif; ?>">
						<!--<span>Se requiere un Nombre de Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputTitulo">T&iacute;tulo</label>
						<input type="text" class="form-control  form-control-sm" id="inputTitulo" name="inputTitulo" placeholder="Ingrese T&iacute;tulo de Campa&ntilde;a" value="<?php if(isset($campania['c_titulo'])): echo $campania['c_titulo']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputFechaInicio">Fecha Inicio</label>
						<input type="date" class="form-control  form-control-sm" id="inputFechaInicio" name="inputFechaInicio" placeholder="Ingrese Fecha Inicio de Campa&ntilde;a" value="<?php if(isset($campania['c_fecha_inicio'])): echo $campania['c_fecha_inicio']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputFechaFin">Fecha Fin</label>
						<input type="date" class="form-control  form-control-sm" id="inputFechaFin" name="inputFechaFin" placeholder="Ingrese Fecha Fin de Campa&ntilde;a" value="<?php if(isset($campania['c_fecha_fin'])): echo $campania['c_fecha_fin']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputCantEac">Cant. EAC</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantEac" name="inputCantEac" placeholder="Ingrese Cant. EAC de Campa&ntilde;a" value="<?php if(isset($campania['c_cant_eac'])): echo $campania['c_cant_eac']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCantDiasFase">Cant. d&iacute;as Fase</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantDiasFase" name="inputCantDiasFase" placeholder="Ingrese Cant. d&iacute;as Fase de Campa&ntilde;a" value="<?php if(isset($campania['c_dias_fase'])): echo $campania['c_dias_fase']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputCantDiasCiclo">Cant. d&iacute;as Ciclo</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantDiasCiclo" name="inputCantDiasCiclo" placeholder="Ingrese Cant. d&iacute;as ciclo de Campa&ntilde;a" value="<?php if(isset($campania['c_dias_ciclo'])): echo $campania['c_dias_ciclo']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCantCiclo">Cant. de Ciclos</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantCiclo" name="inputCantCiclo" placeholder="Ingrese Cant. de ciclos de Campa&ntilde;a" value="<?php if(isset($campania['c_cant_ciclo'])): echo $campania['c_cant_ciclo']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputTMO">TMO</label>
						<input type="number" class="form-control  form-control-sm" id="inputTMO" name="inputTMO" placeholder="Ingrese TMO de Campa&ntilde;a" value="<?php if(isset($campania['c_tmo'])): echo $campania['c_tmo']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCantDiasAntiguedadGrab">Cant. d&iacute;as antiguedad de grabaciones</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantDiasAntiguedadGrab" name="inputCantDiasAntiguedadGrab" placeholder="IngreseCant. d&iacute;as antiguedad de grabaciones de Campa&ntilde;a" value="<?php if(isset($campania['c_cant_dias_antiguedad_grabaciones'])): echo $campania['c_cant_dias_antiguedad_grabaciones']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputCantGestionesCiclo">Cant. gestiones por ciclo</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantGestionesCiclo" name="inputCantGestionesCiclo" placeholder="Ingrese Cant. gestiones por ciclo de Campa&ntilde;a" value="<?php if(isset($campania['c_cant_gestiones_ciclo'])): echo $campania['c_cant_gestiones_ciclo']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCantLlamados">Cant. Total de Llamados</label>
						<input type="number" class="form-control  form-control-sm" id="inputCantLlamados" name="inputCantLlamados" placeholder="Ingrese Cant. Total de Llamados de Campa&ntilde;a" value="<?php if(isset($campania['c_cant_llamados'])): echo $campania['c_cant_llamados']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputMuestra">Muestra</label>
						<input type="number" class="form-control  form-control-sm" id="inputMuestra" name="inputMuestra" placeholder="Ingrese Muestra de Campa&ntilde;a" value="<?php if(isset($campania['c_muestra'])): echo $campania['c_muestra']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputCodCampania">Cod. Externo</label>
						<input type="number" class="form-control  form-control-sm" id="inputCodCampania" name="inputCodCampania" placeholder="Ingrese Cod. Externo de Campa&ntilde;a" value="<?php if(isset($campania['c_cod_campania'])): echo $campania['c_cod_campania']; endif; ?>">
						<!--<span>Se requiere una Abreviaci&oacute;n para el Campania.</span>-->
					</div>					
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<label for="selectTipoCampania">Tipo Campa&ntilde;a</label>
						<select id="selectTipoCampania" class="custom-select custom-select-sm">
							 	<?php 
							 		if(isset($tipoCampanias))
							 		{
							 			echo '<option selected>Seleccione un Tipo Campa&ntilde;a</option>';
							 			foreach ($tipoCampanias as $tipoCampania) {
							 				$selected = ''; 
							 				if (isset($campania['id_tipo_campania']) && $campania['id_tipo_campania'] == $tipoCampania['id_tipo_campania']) {
							 					$selected = 'selected';
							 				}
							 				echo '<option value="'.$tipoCampania['id_tipo_campania'].'" '.$selected.'>'.$tipoCampania['tc_nombre'].'</option>';
							 			}
							 		}
							 	?>
							</select>
					</div>
					<div class="form-group col-sm-6">
						<label for="selectEmpresa">Empresa</label>
						<select id="selectEmpresa" class="custom-select custom-select-sm">
							 	<?php 
							 		if(isset($empresas))
							 		{
							 			echo '<option selected>Seleccione una Empresa</option>';
							 			foreach ($empresas as $empresa) {
							 				$selected = ''; 
							 				if (isset($campania['id_empresa']) && $campania['id_empresa'] == $empresa['id_empresa']) {
							 					$selected = 'selected';
							 				}
							 				echo '<option value="'.$empresa['id_empresa'].'" '.$selected.'>'.$empresa['e_titulo'].'</option>';
							 			}
							 		}
							 	?>
							</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputObservaciones">Observaciones</label>
						<textarea class="form-control form-control-sm block" id="inputObservaciones" name="inputObservaciones" rows="2"><?php if(isset($campania['c_descripcion'])): echo $campania['c_descripcion']; endif; ?></textarea>
					</div>
					<div class="form-group col-sm-6">
						<label for="selectPlantilla">Plantilla</label>
						<select id="selectPlantilla" class="custom-select custom-select-sm">
							 	<?php 
							 		if(isset($plantillas))
							 		{
							 			echo '<option selected>Seleccione una Plantilla</option>';
							 			foreach ($plantillas as $plantilla) {
							 				$selected = ''; 
							 				if (isset($campania['id_plantilla']) && $plantilla['id_plantilla'] == $campania['id_plantilla']) {
							 					$selected = 'selected';
							 				}
							 				echo '<option value="'.$plantilla['id_plantilla'].'" '.$selected.'>'.$plantilla['nombre'].'</option>';
							 			}
							 		}
							 	?>
							</select>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Campania/ListarCampanias">Volver</a>
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
<div class="modal fade" id="modalMensajeCampania" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button id="btnCerrarMC" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
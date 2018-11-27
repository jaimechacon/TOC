<?php
	$id_usuario=$this->session->userdata('id_usuario');
	if(!$id_usuario){
	  redirect('Login');
	}
?>

<div class="row">
	<div id="filtros" class="col-sm-12 mt-3">		
		<div class="row mb-1 text-center">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span>Analista</span>
					</div>
					<div class="col-sm-8">
						<select id="analistas" class="custom-select custom-select-sm selectFiltros"
							<?php echo (isset($esAnalista) && $esAnalista == "1" ? ' disabled': ''); ?>>
						    <option value="-1">Seleccione una Analista</option>
							<?php
							if($analistas)
							{
								foreach ($analistas as $analista) {
									//echo '<option value="'.$analista['id_usuario'].'">'.$analista['nombre_completo'].'</option>';
									if(isset($idAnalista) && (int)$analista['id_usuario'] == $idAnalista)
									{
										echo '<option value="'.$analista['id_usuario'].'" selected>'.$analista['nombre_completo'].'</option>';
									}else
									{
										echo '<option value="'.$analista['id_usuario'].'">'.$analista['nombre_completo'].'</option>';
									}
								}
							}
							?>
						</select>
						<?php //if(isset($u_nombres)) { echo $u_nombres; } ?> <?php //if(isset($u_apellidos)) { //echo $u_apellidos; } ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span class="">Campa&ntilde;a</span>
					</div>
					<div class="col-sm-6">
						<select id="campanias" class="custom-select custom-select-sm selectFiltros" <?php echo (isset($id_campania) && $id_campania != "null" ? 'data-num="1" disabled': ''); ?>>
						    <option value="-1">Seleccione una Campa&ntilde;a</option>
							<?php
							if($campanias)
							{
								foreach ($campanias as $campania) {
									if(isset($id_campania) && (int)$campania['id_campania'] == $id_campania)
									{
										echo '<option value="'.$campania['id_campania'].'" selected>'.$campania['c_nombre'].'</option>';
									}else
									{
										echo '<option value="'.$campania['id_campania'].'">'.$campania['c_nombre'].'</option>';
									}
								}
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span >EAC</span>
					</div>
					<div class="col-sm-6">
						<select id="eacs" class="custom-select custom-select-sm selectFiltros" <?php echo (isset($id_eac) && $id_eac != "null" ? 'data-num="2"': ''); ?>>
							<option value="-1">Seleccione un EAC</option>
							<?php
							if($eacs)
							{
								foreach ($eacs as $eac) {
									if(isset($id_eac) && (int)$eac['id_usuario'] == $id_eac)
									{
										echo '<option value="'.$eac['id_usuario'].'" selected>'.$eac['nombre_completo_eac'].'</option>';
									}else
									{
										echo '<option value="'.$eac['id_usuario'].'">'.$eac['nombre_completo_eac'].'</option>';
									}
								}
							}
							?>
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row p-3">
		<div id="tDatos" class="col-sm-12 p-3">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col" class="text-center align-middle registro"># ID</th>			      
				      <th scope="col" class="text-center align-middle registro">Fecha</th>
				      <th scope="col" class="text-center align-middle registro">Duracion Min.</th>
				      <th scope="col" class="text-center align-middle registro">Id Llamada</th>
				      <th scope="col" class="text-center align-middle registro">Campa&ntilde;a</th>
				      <th scope="col" class="text-center align-middle registro">EAC</th>
				      <th scope="col" class="text-center align-middle registro">Puntaje (%)</th>
				      <th scope="col" class="text-center align-middle registro">Usuario Evaluaci&oacute;n</th>
				      <th scope="col" class="text-center align-middle registro">Usuario Responsable</th>
				      <th scope="col" class="text-center align-middle registro">Ver</th>
				    </tr>
				  </thead>
				  <tbody id="tbodyEvaluaciones">
				        <?php foreach ($evaluaciones as $evaluacion): ?>
				  			<tr>
						        <th scope="row" class="text-center align-middle registro"><?php echo $evaluacion['id_evaluacion']; ?></th>
						        <td class="text-center align-middle registro"><?php echo $evaluacion['ev_fecha']; ?></td>
						        <td class="text-center align-middle registro"><?php echo $evaluacion['g_duracion_minutos']; ?></td>
						        <td class="text-center align-middle registro"><?php echo $evaluacion['g_identificador']; ?></td>
						        <td class="text-center align-middle registro"> 
						        	<?php echo $evaluacion['c_nombre']; ?>
						        </td>
						         <td class="text-center align-middle registro"> 
						        	<?php echo $evaluacion['nombre_eac']; ?>
						        </td>
						         <td class="text-center align-middle registro"> 
						        	<?php echo $evaluacion['puntaje']." %"; ?>
						        </td>
						         <td class="text-center align-middle registro"> 
						        	<?php echo $evaluacion['nombre_usu']; ?>
						        </td>
						         <td class="text-center align-middle registro"> 
						        	<?php echo $evaluacion['nombre_usu_respon']; ?>
						        </td>
						        <td class="text-right align-middle registro">
						        	<a id="view_<?php echo $evaluacion['id_evaluacion']; ?>" class="view" href="#" data-id="<?php echo $evaluacion['id_evaluacion']; ?>" data-toggle="modal" data-target="#modalVerEvaluacion">
						        		<i data-feather="search" data-toggle="tooltip" data-placement="top" title="ver resultados"></i>					        		
					        		</a>
					        		<!--<a id="edit_<?php echo $equipo['id_equipo']; ?>" class="edit" type="link" href="ModificarEquipo/?idEquipo=<?php echo $equipo['id_equipo']; ?>" data-id="<?php echo $equipo['id_equipo']; ?>" data-nombre="<?php echo $equipo['nombre']; ?>">
						        		<i data-feather="edit-3" data-toggle="tooltip" data-placement="top" title="modificar"></i>
					        		</a>
					        		<!--<a id="view_<?php echo $equipo['id_equipo']; ?>" class="view" href="#">
						        		<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver"></i>
					        		</a>-->
					        	</td>
					    	</tr>
				  		<?php endforeach ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>

<!-- Modal Eliminar -->
	<div class="modal fade" id="modalVerEvaluacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
			<div class="modal-header">
				<i class="plusTitulo mb-2 mr-2" data-feather="check-square"></i>
				<h5 class="modal-title" id="tituloAPP" name="tituloAPP" data-idcategoria="" data-nombrecategoria="" >Resumen Evaluaci&oacute;n</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
		      	<div id="filtros" class="mt-3 mr-3 ml-3">
					<div class="row">
						<div class="col-sm-4">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>Agente</td>
											<td id="agente" class="align-middle">
											</td>
										</tr>
										<tr>
											<td>Empresa</td>
											<td  id="empresa" class="align-middle"></td>
										</tr>
										<tr>
											<td>Fecha</td>
											<td id="fecha" class="align-middle"><?php //echo $grabacion['FechaCarga']; ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="titulo" class="col-sm-4 mt-4 align-middle text-center">
							<h3 id="nombreCampania" class="align-middle"></h3>
							<!--<div class="text-center">
							</div>-->
						</div>
						<div class="col-sm-4">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>EAC</td>
											<td id="eac"></td>
										</tr>
										<tr>
											<td>ID Llamada</td>
											<td id="idLlamada" class="align-middle"><?php //echo $grabacion['idllamada']; ?></td>
										</tr>
										<!--<tr>
											<td>Evaluacion</td>
											<td>2   /   3</td>
										</tr>-->
									</tbody>
								</table>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
					    	<!--<audio id="grabacion" class="grabacion" src="http://calidad.gsbpo.cl/grabaciones/985885966-1137884-20180730145738.mp3" preload="metadata" controls>-->
					    	<audio id="grabacion" class="grabacion" src="<?php //echo $ruta.$grabacion['Grabacion']; ?>" preload="metadata" data-duracionseg="<?php //echo $grabacion['DuracionSegundo']; ?>" data-duracionmin="<?php //echo $grabacion['DuracionMinutos']; ?>" data-grabacion="<?php //echo $grabacion['Grabacion']; ?>" controls></audio>
					    </div>
				    </div>
				    <div class="row">
						<div class="col-lg-9">
							<h3>Puntaje</h3>
					    </div>
					    <div class="col-lg-3 pt-2 text-right">
					    	<h3 id="puntaje" data-puntaje="0" data-puntajetotal="<?php //echo $pauta[0]['puntuacion_total']; ?>">0 %</h3>
					    </div>
				    </div>	
				</div>
				<div id="tablaPreguntas" class="mt-1 ml-3 mr-3">
					<div class="row justify-content-center">
						<table class="table table-hover table-sm">
							<thead class="thead-dark">
								<tr>
									<th class="thl-radius align-middle" scope="col">N°</th>
									<th scope="col" colspan="9" class="align-middle">Pregunta</th>
									<th scope="col" class="text-center align-middle">Cumple</th>
									<th class="thr-radius text-center align-middle" scope="col">No Cumple</th>
								</tr>
							</thead>
							<tbody id="listaPreguntas">								
							</tbody>
						</table>
					</div>
				</div>
				<div id="observaciones" class="row">
					<div class="row col-sm-12 m-2">
						<label for="observacionEvaluacion">Observaciones</label>
						<textarea class="form-control block" id="observacionEvaluacion" rows="3" readonly></textarea>
					</div>
				</div>			
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
				</div>
	    	</div>
	  	</div>
	  </div>
	</div>
</div>

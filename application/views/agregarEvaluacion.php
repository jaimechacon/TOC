<?php
	$id_usuario=$this->session->userdata('id_usuario');
	//var_dump($grabacion);
	//var_dump($pauta);
	//var_dump($pauta);
	 
	if(!$id_usuario){
	  redirect('Login');
	}

?>
<div class="row">	
	<div class="col-sm-12 mt-3">
		<?php
			if(!isset($pauta))
			{
				?>
					<form id="agregarEvaluacion" action="agregarEvaluacion" method="POST" data-idEvaluacion="<?php echo (isset($evaluacion['id_evaluacion']) ? $evaluacion['id_evaluacion'] : ''); ?>">
					  <div class="form-group row">
					    <div class="col-sm-6">
					      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">EAC</label>
					      <input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Ingrese codigo o nombre de EAC">
					    </div>					    	
				    	<div class="col-sm-6">
				    	  <label class="col-sm-2 col-form-label col-form-label-sm" for="inlineFormCustomSelectPref">Campania</label>
							 <select class="custom-select custom-select-sm">
							 	<?php 
							 		if(isset($campanias))
							 		{
							 			echo '<option selected>Seleccione una Campania</option>';
							 			foreach ($campanias as $camp) {
							 				echo '<option value="1">'.$camp['c_nombre'].'</option>';
							 			}
							 		}
							 	?>
							</select>
						</div>
					  </div>
					  <div class="row">
							<input type="text" class="form-control form-control-sm" id="inputIdEvaluacion" name="inputIdEvaluacion" value="<?php if(isset($pauta['id_evaluacion'])): echo $pauta['id_evaluacion']; endif; ?>" hidden />
						</div>
					</form>
					<table class="table table-sm table-hover mt-5">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nombre</th>
					      <th scope="col">Apellido</th>
					      <th scope="col">Campania</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Pablo</td>
					      <td>Novoa</td>
					      <td>Pre - Pre</td>
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>Victoria</td>
					      <td>Sanchez</td>
					      <td>Pre - Post</td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>Heidy</td>
					      <td>Bonaga</td>
					      <td>Post - Post</td>
					    </tr>
					  </tbody>
					</table>
				<?php
			}else{
		?>
				<div id="filtros" class="mt-3 mr-3 ml-3">
					<div class="row justify-content-between">
						<div class="col-sm-3">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>Agente</td>
											<td>
												<?php if(isset($u_nombres)) { echo $u_nombres; } ?> <?php if(isset($u_apellidos)) { echo $u_apellidos; } ?>
											</td>
										</tr>
										<tr>
											<td>Empresa</td>
											<td><?php echo $pauta[0]['empresa']; ?></td>
										</tr>
										<tr>
											<td>Fecha</td>
											<td id="fecha"><?php echo $grabacion['FechaCarga']; ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="titulo" class="col-sm-3 mt-4">
							<div class="row text-center">
								<div class="row justify-content-center ">
									<h3><?php echo $pauta[0]['p_nombre']; ?></h3>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>EAC</td>
											<td><?php echo $pauta[0]['nombre_eac']; ?></td>
										</tr>
										<tr>
											<td>ID Llamada</td>
											<td id="idLlamada"><?php echo $grabacion['idllamada']; ?></td>
										</tr>
										<tr>
											<td>Evaluacion</td>
											<td>2   /   3</td>
										</tr>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8 col-lg-9 col-xl-10">
					    	<audio id="grabacion" class="grabacion" src="<?php echo $ruta.$grabacion['Grabacion']; ?>" preload="metadata" controls>
					    </div>
					    <div class="col-sm-4 col-lg-3 col-xl-2 pt-2 ">
					    	<button id="btnCambiarGrabacion" type="button" class="btn btn-outline-dark" data-ideac="<?php echo (isset($idEAC) ? $idEAC: ''); ?>" data-idcampania="<?php echo (isset($idCampania) ? $idCampania: ''); ?>">Cambiar grabaci&oacute;n</button>
					    	<!--/*data-toggle="modal" data-target="#modalCambiarGrabacion"-->
					    </div>
				    </div>		
				</div>
				<div id="tablaPreguntas" class="mt-1 ml-3 mr-3">
					<div class="row justify-content-center">
						<table class="table table-hover table-sm">
							<thead class="thead-dark">
								<tr>
									<th class="thl-radius" scope="col">N°</th>
									<th scope="col" colspan="9">Pregunta</th>
									<th scope="col">Cumple</th>
									<th class="thr-radius" scope="col">No Cumple</th>
								</tr>
							</thead>
							<tbody id="listaPreguntas">

								<?php
									$cont = 1;
									foreach ($cat_pauta as $cat) {
										echo '<tr>
										<th scope="col" colspan="12">
										'.$cat['cat_nombre'].'</th>
										</tr>';

										foreach ($pauta as $pregunta) {
											//var_dump($pregunta['CAT_NOMBRE']);
											//var_dump($pregunta['CAT_NOMBRE']);
											if($pregunta['cat_nombre'] == $cat['cat_nombre'])
											{
												echo '<tr data-idplacatpre="'.$pregunta['id_plantilla_categoria_pregunta'].'">
													<th scope="row">'.$cont.'</th>
													<td colspan="9">'.$pregunta['pre_nombre'].'</td>
													<td class="text-center">
														<input type="radio" class="pauta" name="optionsRadios'.$cont.'" id="optionsRadios'.$cont.'" value="option'.$cont.'">
													</td>
													<td class="text-center">
														<input type="radio" class="pauta" name="optionsRadios'.$cont.'" id="optionsRadios'.$cont.'" value="option'.$cont.'">
													</td>
												</tr>';
												$cont++;
											}
										}
										

										}
								?>
								
							</tbody>
						</table>
					</div>
				</div>
				<div id="observaciones" class="row">
					<div class="row col-sm-12 m-2">
						<label for="observacionEvaluacion">Observaciones</label>
						<textarea class="form-control block" id="observacionEvaluacion" rows="3"></textarea>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Evaluacion/ListarEvaluaciones">Volver</a>
					</div>
					<div  class="col-sm-6 text-right">
					 	<button id="btnAgregarEvaluacion" type="button" class="btn btn-primary ">Guardar Evaluacion</button>
					</div>
				</div>
		<?php
			}
		?>
	</div>
</div>

<div id="loader" class="loader" hidden></div>

<!-- Modal Mensaje -->
<div class="modal fade" id="modalMensajeEvaluacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloME"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p id="parrafoME"></p>
      </div>
      <div class="modal-footer">
        <button id="btnCerrarME" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="loader" class="loader" hidden></div>

<div class="modal fade" id="modalCambiarGrabacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusA mb-2" data-feather="phone-call"></i>
	        <h5 class="modal-title ml-2" id="tituloMGE" name="tituloMGE" data-idcategoria="" data-nombrecategoria="" >Seleccione una grabaci&oacute;n de llamada.</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<!--<div class="table-responsive">
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col" class="text-center align-middle registro">ID Llamada</th>
				      <th scope="col" class="text-center align-middle registro">Fecha</th>
				      <th scope="col" class="text-center align-middle registro">Duraci&oacute;n Min.</th>
				      <th scope="col" class="text-center align-middle registro">Selecci&oacute;n</th>
				    </tr>
				  </thead>
				  <tbody id="tbodyGrabaciones">

				  </tbody>
				</table>
	      	</div>-->
			<ul id="listaGrabaciones" class="list-group list-group-flush">
			  <!--<li class="list-group-item">
			  	<div class="row">
			  		<div class="col-sm">
			     		<span class="font-weight-bold">ID Llamada</span>
			    	</div>
					<div class="col-sm">
			     		<span class="font-weight-bold">Fecha</span>
			    	</div>
			    	<div class="col-sm">
			     		<span class="font-weight-bold">Duraci&oacute;n Min.</span>
			    	</div>
			  	</div>
			  </li>
			  <li class="list-group-item list-group-item-action">
			  	<div class="row">
			  		<div class="col-sm">
			     		<span>ID Llamada</span>
			    	</div>
					<div class="col-sm">
			     		<span>Fecha</span>
			    	</div>
			    	<div class="col-sm">
			     		<span>Duraci&oacute;n Min.</span>
			    	</div>
			  	</div>
			  </li>
			  <li class="list-group-item list-group-item-action">Morbi leo risus</li>
			  <li class="list-group-item list-group-item-action">Porta ac consectetur ac</li>
			  <li class="list-group-item list-group-item-action">Vestibulum at eros</li>-->
			</ul>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="cambiarGrabacion" type="button" class="btn btn-success">Seleccionar</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
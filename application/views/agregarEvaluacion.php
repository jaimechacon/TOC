<?php
	$id_usuario=$this->session->userdata('id_usuario');
	/*var_dump($cat_pauta);
	var_dump($pauta);*/
	 
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
											<td>CLARO</td>
										</tr>
										<tr>
											<td>Fecha</td>
											<td><?php echo date("d/m/Y"); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="titulo" class="col-sm-3 mt-4">
							<div class="row justify-content-center ">
								<div class="row justify-content-center ">
									<h3><?php echo $pauta[0]['p_nombre']; ?></h3>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="musica">
							    	<audio src="<?php echo base_url(); ?>grabaciones/930904279-1151056-20180810121655.mp3" preload="auto" controls></audio>
							    	<!--<audio src="<?php //echo base_url(); ?>grabaciones/MONITOREO/930904279-1151056-20180810121655.mp3" preload="auto" controls></audio>-->
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
											<td>13246578</td>
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
												echo '<tr>
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
						<label for="exampleFormControlTextarea1">Observaciones</label>
						<textarea class="form-control block" id="exampleFormControlTextarea1" rows="3"></textarea>
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

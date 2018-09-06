<?php
	$id_usuario=$this->session->userdata('id_usuario');
	
	if(!$id_usuario){
	  redirect('Login');
	}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="m-3">
			<h3><i class="plusTitulo mb-2" data-feather="plus"></i>Agregar Equipo</h3>
		</div>
	</div>
	<div class="col-sm-12">
		<div id="filtros" class="mt-3 mr-3 ml-3">
			<form id="agregarEquipo" action="Equipo/agregarEquipo" method="POST">
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputNombre">Nombre</label>
						<input type="text" class="form-control  form-control-sm" id="inputNombre" placeholder="Ingrese nombre Equipo">
					</div>
					<div class="form-group col-sm-6">
						<label for="inputAbreviacion">Abreviaci&oacute;n</label>
						<input type="text" class="form-control  form-control-sm" id="inputAbreviacion" placeholder="Ingrese abreviaci&oacute;n Equipo">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputObservaciones">Observaciones</label>
						<textarea class="form-control form-control-sm block" id="inputObservaciones" rows="2"></textarea>
					</div>
				</div>
				<div class="form-group">
					<h5>Agregar EAC al Equipo</h5>
				</div>
				<div class="row form-group">
					<label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Buscar</label>
					<div class="col-sm-5">
					  <input id="buscarEAC" type="text" class="form-control form-control-sm" placeholder="Busque por ( C&oacute;digo, Nombres, Apellidos ó Email )">
					</div>
				</div>
				<div id="tablaPreguntas" class="row">
					<div class="col-sm-12">
						<table id="tListaEAC" class="table table-hover table-sm">
							<thead class="thead-dark">
								<tr>
									<th hidden scope="col">Id Usuario</th>
									<th class="thl-radius text-center" scope="col">Cod. EAC</th>
									<th class="text-center" scope="col" colspan="5">Nombres</th>
									<th class="text-center" scope="col" colspan="5">Apellidos</th>
									<th class="text-center" scope="col">Email</th>
									<th class="text-center thr-radius" scope="col">Incluido</th>
								</tr>
							</thead>
							<tbody id="tbodyEAC">

								<?php									
									foreach ($eacs as $eac) {
										echo '<tr>
										<td class="text-center" hidden>'.$eac['id_usuario'].'</td>
										<th class="text-center" scope="col">'.$eac['cod_eac'].'</th>
										<td class="text-center" colspan="5">'.$eac['nombres'].'</td>
										<td class="text-center" colspan="5">'.$eac['apellidos'].'</td>
										<td class="text-center" >'.$eac['email'].'</td>
										<td class="text-center " >
											<input type="checkbox" class="pauta" data-idUsuario="'.$eac['id_usuario'].'" id="incluido_eac_'.$eac['id_usuario'].'">
										</td>
										</tr>';
										}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Equipo/ListarEquipos">Volver</a>
					</div>
					<div  class="col-sm-6 text-right">
					 	<button type="button" class="btn btn-primary submit">Guardar Equipo</button>
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>

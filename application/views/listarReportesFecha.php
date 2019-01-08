<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
	
?>
<div class="row pt-3">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<h3>Consolidado de Situación Financiera</h3>
			</div>
		</div>
		<hr class="my-4">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">			
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Instituci&oacute;n</span>
							</div>
							<div class="col-sm-9">
								<select id="institucionFecha" class="custom-select custom-select-sm">
								   	<option value="-1">Todos</option>
									<?php 
									if($instituciones)
									{
										foreach ($instituciones as $institucion) {
											if(isset($idInstitucion) && (int)$institucion['id_institucion'] == $idInstitucion)
	                                        {
	                                                echo '<option value="'.$institucion['id_institucion'].'" selected>'.$institucion['nombre'].'</option>';
	                                        }else
	                                        {
	                                                echo '<option value="'.$institucion['id_institucion'].'">'.$institucion['nombre'].'</option>';
	                                        }
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Area</span>
							</div>
							<div class="col-sm-9">
								<select id="hospitalFecha" class="custom-select custom-select-sm">
								    <option value="-1">Todos</option>
									<?php 
									if($hospitales)
									{
										foreach ($hospitales as $hospital) {
											if(isset($idHospital) && (int)$hospital['id_hospital'] == $idHospital)
											{
                                                echo '<option value="'.$hospital['id_hospital'].'" selected>'.$hospital['nombre'].'</option>';
	                                        }else
	                                        {
                                                echo '<option value="'.$hospital['id_hospital'].'">'.$hospital['nombre'].'</option>';
	                                        }
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 mt-3">
				<div class="row">			
					<div class="col-sm-4">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Mes</span>
							</div>
							<div class="col-sm-9">
								<select id="mes" class="custom-select custom-select-sm">
								   	<option value="-1">Todos</option>
									<?php 
									if($meses)
									{
										foreach ($meses as $mes) {
											if(isset($mesSeleccionado) && (int)$mes['idMes'] == $mesSeleccionado)
	                                        {
                                                echo '<option value="'.$mes['idMes'].'" selected>'.$mes['nombreMes'].'</option>';
	                                        }else
	                                        {
                                                echo '<option value="'.$mes['idMes'].'">'.$mes['nombreMes'].'</option>';
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
							<div class="col-sm-3">
								<span class="">A&ntilde;o</span>
							</div>
							<div class="col-sm-9">
								<select id="anio" class="custom-select custom-select-sm">
								   	<option value="-1">Todos</option>
									<?php 
									if($anios)
									{
										foreach ($anios as $anio) {
											if(isset($anioSeleccionado) && (int)$anio['idAnio'] == $anioSeleccionado)
	                                        {
	                                            echo '<option value="'.$anio['idAnio'].'" selected>'.$anio['nombreAnio'].'</option>';
	                                        }else
	                                        {
	                                            echo '<option value="'.$anio['idAnio'].'">'.$anio['nombreAnio'].'</option>';
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
							<div class="col-sm-3">
								<span class="">Inflactor</span>
							</div>
							<div class="col-sm-9">
									<input id="inflactor" type="number" class="form-control form-control-sm" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Inflactor (opcional) Ej: 0.25">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 pt-3 pb-3">
				<div class="card">
					<div class="card-header">
						I. Equilibrio Financiero (Vista en M$)
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="loader" class="loader" hidden></div>



<!-- Modal Detalle -->
	<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTituloError mb-2" data-feather="search"></i>
	        <h5 class="modal-title" id="titulo" name="titulo" data-idequipo="" data-nombreequipo="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafo"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Atras</button>
	        <!--<button id="eliminarEquipo" type="button" class="btn btn-danger">Eliminar</button>-->
	      </div>
	    </div>
	  </div>
	</div>
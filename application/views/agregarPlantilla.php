<?php
	$id_usuario=$this->session->userdata('id_usuario');
	
	if(!$id_usuario){
	  redirect('Login');
	}
	//var_dump(implode(",", $eacsEquipo));
?>
<div class="row">
	<div class="col-sm-12">
		<div id="titulo" class="mt-3">
			<h3><i class="plusTitulo mb-2" data-feather="<?php echo ($titulo == 'Agregar Plantilla' ? 'plus' : 'edit-3'); ?>" ></i><?php echo $titulo; ?>
			</h3>
		</div>
	</div>
	<div class="col-sm-12">
		<div id="filtros" class="mt-3 mr-3 ml-3">
			<form id="agregarPlantilla" action="agregarPlantilla" method="POST" data-idPlantilla="<?php echo (isset($idPlantilla) ? $idPlantilla : ''); ?>" data-categorias="<?php echo (isset($categoriasPlantilla) ? implode(",", $categoriasPlantilla): ''); ?>">
				<div class="row">
					<input type="text" class="form-control form-control-sm" id="inputIdPlantilla" name="inputIdPlantilla" value="<?php if(isset($plantilla['id_plantilla'])): echo $plantilla['id_plantilla']; endif; ?>" hidden>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputNombre">Nombre</label>
						<input type="text" class="form-control  form-control-sm" id="inputNombre" minlength="1" placeholder="Ingrese un nombre a la Plantilla" name="inputNombre" value="<?php if(isset($plantilla['nombre'])): echo $plantilla['nombre']; endif; ?>">
						<!--<span>Se requiere un Nombre de Equipo.</span>-->
					</div>
					<div class="form-group col-sm-6">
						<label for="inputObservaciones">Observaciones</label>
						<textarea class="form-control form-control-sm block" id="inputObservaciones" name="inputObservaciones" placeholder="Ingrese una observaci&oacute;n a la Plantilla" rows="2"><?php if(isset($plantilla['descripcion'])): echo $plantilla['descripcion']; endif; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<h5>Agregar Categor&iacute;a a la Plantilla</h5>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<select id="categoria" class="custom-select custom-select-sm">
							<option value="-1">Seleccione una Categor&iacute;a</option>
							<?php
							if($categorias)
							{
								foreach ($categorias as $categoria) {
									echo '<option value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="col-sm-1 text-left">
						<!--<button id="check_todos" type="button" class="btn btn-sm btn-outline-dark">Seleccionar Todos</button>-->
						<button id="agregarCategoria" type="button" class="btn btn-link btn-sm p-0">
			        		<i data-feather="plus-circle" data-toggle="tooltip" data-placement="top" title="Agregar Categor&iacute;a" class="plusA"></i>
		        		</button>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
<div class="accordion" id="categorias">
  <!--<div class="card">    
  	<div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#categorias">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#categorias">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#categorias">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
-->
</div>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Plantilla/ListarPlantillas">Volver</a>
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
<div class="modal fade" id="modalMensajePlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloMP"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p id="parrafoMP"></p>
      </div>
      <div class="modal-footer">
        <button id="btnCerrarMP" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
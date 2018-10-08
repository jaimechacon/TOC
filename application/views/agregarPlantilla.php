<?php
	$id_usuario=$this->session->userdata('id_usuario');
	
	if(!$id_usuario){
	  redirect('Login');
	}
	//var_dump($plantilla);
	
	//var_dump(isset($plantilla['id_plantilla']));
	//var_dump(implode(",", $eacsEquipo));
	//var_dump(if($plantilla['cantCategorias'] > 0){ $plantilla['categorias'][0]['id_categoria']; });
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
			<form id="agregarPlantilla" action="agregarPlantilla" method="POST" data-idPlantilla="<?php echo (isset($plantilla['id_plantilla']) ? $plantilla['id_plantilla'] : ''); ?>" data-categorias="<?php echo (isset($plantilla['listaCategorias']) ? $plantilla['listaCategorias'] : ''); ?>">
				<div class="row">
					<input type="text" class="form-control form-control-sm" id="inputIdPlantilla" name="inputIdPlantilla" value="<?php if(isset($plantilla['id_plantilla'])): echo $plantilla['id_plantilla']; endif; ?>" hidden />
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="inputNombre">Nombre</label>
						<input type="text" class="form-control  form-control-sm" id="inputNombre" minlength="1" placeholder="Ingrese un nombre a la Plantilla" name="inputNombre" value="<?php if(isset($plantilla['nombre'])): echo $plantilla['nombre']; endif; ?>">
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
							<?php
								if(isset($plantilla))
								{
									foreach ($plantilla['categorias'] as $categoria) {
										echo '<div class="card" id="categoria_'.$categoria['id_categoria'].'" data-idcategoria="'.$categoria['id_categoria'].'" data-nombre="'.$categoria['nombreCategoria'].'" data-preguntas="'.$categoria['listaPreguntas'].'" >';
							            echo '<div class="card-header" id="heading_'.$categoria['id_categoria'].'">';
							            echo '<div class="row">';
							            echo '<div class="col-sm-6 text-left mt-2">';
							            echo '<h5>';
							            echo $categoria['nombreCategoria'];
							            echo '</h5>';
							            echo '</div>';
							            echo '<div class="col-sm-6 text-right">';
							            echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$categoria['id_categoria'].'" aria-expanded="true" aria-controls="collapse'.$categoria['id_categoria'].'">';            
							            echo '<i data-feather="chevron-down"></i>';
							            echo '</button>';
							            echo '</div>';
							            echo '</div>';
							            echo '</div>';
							            echo '<div id="collapse'.$categoria['id_categoria'].'" class="collapse" aria-labelledby="heading_'.$categoria['id_categoria'].'" data-parent="#categorias">';
							            echo '<div id="body_cat_'.$categoria['id_categoria'].'" class="card-body">';
							            	if(sizeof($categoria['preguntas']) > 0)
							            	{
							            		echo '<ul id="listaPreguntas_'.$categoria['id_categoria'].'" class="list-group">';
							            			foreach ($categoria['preguntas'] as $pregunta) {
							            				echo '<li id="pregunta_'.$pregunta['id_pregunta'].'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
															   	'.$pregunta['pre_nombre'].'
															    <button type="button" class="btn btn-link btn-sm p-0 eliminarPregunta" data-idpregunta="'.$pregunta['id_pregunta'].'" data-idcategoria="'.$categoria['id_categoria'].'">
													        		<i data-feather="x-square" data-toggle="tooltip" data-placement="top" title="Quitar Pregunta" class="eliminarPre"></i>
												        		</button>
															  </li>';
							            				//var_dump($pregunta);
							            			}
							            			echo '</ul>';
							            	}

							            echo '<div class="text-right text-right mt-3">';
							            echo '<button type="button" class="btn btn-success" data-idcategoria="'.$categoria['id_categoria'].'" data-nombre="'.$categoria['nombreCategoria'].'" data-toggle="modal" data-target="#modalAgregarPreguntaPlantilla">Agregar Preguntas</button>';
							            echo '</div>';
							            echo '</div>';
							            echo '</div>';
							            echo '</div>';										
									}
								}
							?>
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

<!-- Modal Eliminar -->
	<div class="modal fade" id="modalAgregarPreguntaPlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTitulo mb-2" data-feather="plus"></i>
	        <h5 class="modal-title" id="tituloAPP" name="tituloAPP" data-idcategoria="" data-nombrecategoria="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
				  <thead>
				    <tr>
				      <th scope="col" class="text-center align-middle registro">ID</th>
				      <th scope="col" class="text-left align-middle registro">Nombre</th>
				      <th scope="col" class="text-right align-middle registro">Selecci&oacute;n</th>
				    </tr>
				  </thead>
				  <tbody id="tbodyPreguntas">
				        <?php //foreach ($preguntas as $pregunta): ?>
				  			<!--<tr>
						        <th scope="row" class="text-center align-middle registro"><?php //echo $pregunta['id_pregunta']; ?></th>
						        <td class="text-left align-middle registro"><?php //echo $pregunta['nombre']; ?></td>
						        <td class="text-left align-middle registro" hidden><?php //echo $pregunta['descripcion']; ?></td>
						        <td class="text-center " >
										<input id="check_<?php //echo $pregunta['id_pregunta']; ?>" type="checkbox" class="pauta" data-idUsuario="<?php // echo $pregunta['id_pregunta']; ?>" >
								</td>
					    	</tr>-->
				  		<?php //endforeach ?>
				  </tbody>
				</table>
	      	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="agregarPreguntaPlantilla" type="button" class="btn btn-success">Agregar</button>
	      </div>
	    </div>
	  </div>
	</div>

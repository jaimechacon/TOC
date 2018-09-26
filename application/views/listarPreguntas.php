<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
	
?>
<div class="row pt-3">
	<div id="filtros" class="col-sm-6">
		<div class="mt-1 ml-1 row">
			<label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Buscar</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control form-control-sm" id="buscarPregunta" placeholder="Busque por Nombre">
			</div>
		</div>
	</div>
	<div id="agregarPregunta" class="col-sm-6 text-right">
		<a href="AgregarPregunta" class="btn btn-link"><i stop-color data-feather="plus"></i>Agregar Categor&iacute;a</a>
	</div>
</div>
<div class="row p-3">
	<div id="tDatos" class="col-sm-12 p-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle registro"># ID</th>
			      <th scope="col" class="text-left align-middle registro">Nombre</th>
			      <th scope="col" class="text-center align-middle registro" hidden>Descripci&oacute;n</th>
			      <th scope="col" class="text-right align-middle registro"></th>
			    </tr>
			  </thead>
			  <tbody id="tbodyPregunta">
			        <?php foreach ($preguntas as $pregunta): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle registro"><?php echo $pregunta['id_pregunta']; ?></th>
					        <td class="text-left align-middle registro"><?php echo $pregunta['nombre']; ?></td>
					        <td class="text-left align-middle registro" hidden><?php echo $pregunta['descripcion']; ?></td>
					        <td class="text-right align-middle registro">
					        	<a id="trash_<?php echo $pregunta['id_pregunta']; ?>" class="trash" href="#" data-id="<?php echo $pregunta['id_pregunta']; ?>" data-nombre="<?php echo $pregunta['nombre']; ?>" data-toggle="modal" data-target="#modalEliminarPregunta">
					        		<i data-feather="trash-2" data-toggle="tooltip" data-placement="top" title="eliminar"></i>					        		
				        		</a>
				        		<a id="edit_<?php echo $pregunta['id_pregunta']; ?>" class="edit" type="link" href="ModificarPregunta/?idPregunta=<?php echo $pregunta['id_pregunta']; ?>" data-id="<?php echo $pregunta['id_pregunta']; ?>" data-nombre="<?php echo $pregunta['nombre']; ?>">
					        		<i data-feather="edit-3" data-toggle="tooltip" data-placement="top" title="modificar"></i>
				        		</a>
				        	</td>
				    	</tr>
			  		<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Mensaje -->
<div class="modal fade" id="modalMensajePregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Mensaje -->

<div class="modal fade" id="modalMensajePregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	<div class="modal fade" id="modalEliminarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTituloError mb-2" data-feather="trash-2"></i>
	        <h5 class="modal-title" id="tituloEP" name="tituloEP" data-idpregunta="" data-nombrepregunta="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafoEP"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="eliminarPregunta" type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

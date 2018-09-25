<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
	
?>
<div class="row mt-3">
	<div id="filtros" class="col-sm-6">
		<div class="mt-1 ml-1 row">
			<label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Buscar</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control form-control-sm" id="buscarCategoria" placeholder="Busque por ( Nombre, Descripci&oacute;n, Puntuaci&oacute;n )">
			</div>
		</div>
	</div>
	<div id="agregarCategoria" class="col-sm-6 d-flex justify-content-end">
		<a href="AgregarCategoria" class="btn btn-link"><i stop-color data-feather="plus"></i>Agregar Categor&iacute;a</a>
	</div>
	<div id="tDatos" class="col-sm-12 m-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle"># ID</th>
			      <th scope="col" class="text-center align-middle">Nombre</th>
			      <th scope="col" class="text-center align-middle">Descripci&oacute;n</th>
			      <th scope="col" class="text-center align-middle">Puntuaci&oacute;n</th>
			      <th scope="col" class="text-center align-middle"></th>
			    </tr>
			  </thead>
			  <tbody id="tbodyCategoria">
			        <?php foreach ($categorias as $categoria): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle"><?php echo $categoria['id_categoria']; ?></th>
					        <td class="text-center align-middle"><?php echo $categoria['nombre']; ?></td>
					        <td class="text-center align-middle"><?php echo $categoria['descripcion']; ?></td>
					        <td class="text-center align-middle"><?php echo $categoria['puntuacion']; ?></td>
					        <td class="text-center align-middle">
					        	<a id="trash_<?php echo $categoria['id_categoria']; ?>" class="trash" href="#" data-id="<?php echo $categoria['id_categoria']; ?>" data-nombre="<?php echo $categoria['nombre']; ?>" data-toggle="modal" data-target="#modalEliminarCategoria">
					        		<i data-feather="trash-2" data-toggle="tooltip" data-placement="top" title="eliminar"></i>					        		
				        		</a>
				        		<a id="edit_<?php echo $categoria['id_categoria']; ?>" class="edit btn btn-link" type="link" href="ModificarCategoria/?idCategoria=<?php echo $categoria['id_categoria']; ?>" data-id="<?php echo $categoria['id_categoria']; ?>" data-nombre="<?php echo $categoria['nombre']; ?>">
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
<div class="modal fade" id="modalMensajeCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Mensaje -->

<div class="modal fade" id="modalMensajeCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Eliminar -->
	<div class="modal fade" id="modalEliminarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="tituloEC" name="tituloEC" data-idcategoria="" data-nombrecategoria="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafoEC"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="eliminarCategoria" type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

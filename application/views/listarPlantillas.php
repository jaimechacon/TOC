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
			  <input type="text" class="form-control form-control-sm" id="buscarPlantilla" placeholder="Busque por ( Nombre, Descripci&oacute;n, Abreviaci&oacute;n )">
			</div>
		</div>
	</div>
	<div id="agregarPlantilla" class="col-sm-6 text-right">
		<a href="AgregarPlantilla" class="btn btn-link"><i stop-color data-feather="plus"></i>Agregar Plantilla</a>
	</div>
</div>
<div class="row p-3">
	<div id="tDatos" class="col-sm-12 p-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle registro"># ID</th>
			      <th scope="col" class="text-center align-middle registro">Nombre</th>
			      <th scope="col" class="text-center align-middle registro">Descripci&oacute;n</th>
			      <th scope="col" class="text-center align-middle registro">Cant. Usuarios</th>
			      <th scope="col" class="text-right align-middle registro"></th>
			    </tr>
			  </thead>
			  <tbody id="tbodyPlantilla">
			        <?php foreach ($plantillas as $plantilla): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle registro"><?php echo $plantilla['id_plantilla']; ?></th>
					        <td class="text-center align-middle registro"><?php echo $plantilla['nombre']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $plantilla['descripcion']; ?></td>
					        <td class="text-center align-middle registro"> 
					        	<span class="badge badge-primary badge-pill"><?php //echo $plantilla['cant_usu']; ?></span>
					        </td>
					        <td class="text-right align-middle registro">
					        	<a id="trash_<?php echo $plantilla['id_plantilla']; ?>" class="trash" href="#" data-id="<?php echo $plantilla['id_plantilla']; ?>" data-nombre="<?php echo $plantilla['nombre']; ?>" data-toggle="modal" data-target="#modalEliminarPlantilla">
					        		<i data-feather="trash-2" data-toggle="tooltip" data-placement="top" title="eliminar"></i>					        		
				        		</a>
				        		<a id="edit_<?php echo $plantilla['id_plantilla']; ?>" class="edit" type="link" href="ModificarPlantilla/?idPlantilla=<?php echo $plantilla['id_plantilla']; ?>" data-id="<?php echo $plantilla['id_plantilla']; ?>" data-nombre="<?php echo $plantilla['nombre']; ?>">
					        		<i data-feather="edit-3" data-toggle="tooltip" data-placement="top" title="modificar"></i>
				        		</a>
				        		<!--<a id="view_<?php echo $plantilla['id_plantilla']; ?>" class="view" href="#">
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
	<div class="modal fade" id="modalEliminarPlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTituloError mb-2" data-feather="trash-2"></i>
	        <h5 class="modal-title" id="tituloEP" name="tituloEP" data-idplantilla="" data-nombreplantilla="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafoEP"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="eliminarPlantilla" type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

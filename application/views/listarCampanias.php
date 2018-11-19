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
			  <input type="text" class="form-control form-control-sm" id="buscarCampania" placeholder="Busque por ( Nombre, Descripci&oacute;n, Abreviaci&oacute;n )">
			</div>
		</div>
	</div>
	<div id="agregarCampania" class="col-sm-6 text-right">
		<a href="AgregarCampania" class="btn btn-link"><i stop-color data-feather="plus"></i>Agregar Campa&ntilde;a</a>
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
			      <th scope="col" class="text-center align-middle registro">Titulo</th>
			      <th scope="col" class="text-center align-middle registro">Muestra</th>
			      <th scope="col" class="text-center align-middle registro">Gest. x ciclo</th>
			      <th scope="col" class="text-center align-middle registro">Plantilla</th>
			      <th scope="col" class="text-right align-middle registro">TMO</th>
			      <th scope="col" class="text-center align-middle registro"></th>

			    </tr>
			  </thead>
			  <tbody id="tbodyCampania">
			        <?php foreach ($campanias as $campania): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle registro"><?php echo $campania['id_campania']; ?></th>
					        <td class="text-center align-middle registro"><?php echo $campania['c_nombre']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $campania['c_titulo']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $campania['c_muestra']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $campania['c_cant_gestiones_ciclo']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $campania['plantilla']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $campania['c_tmo']; ?></td>
					        <td class="text-right align-middle registro">
					        	<a id="trash_<?php echo $campania['id_campania']; ?>" class="trash" href="#" data-id="<?php echo $campania['id_campania']; ?>" data-nombre="<?php echo $campania['c_nombre']; ?>" data-toggle="modal" data-target="#modalEliminarCampania">
					        		<i data-feather="trash-2" data-toggle="tooltip" data-placement="top" title="eliminar"></i>					        		
				        		</a>
				        		<a id="edit_<?php echo $campania['id_campania']; ?>" class="edit" type="link" href="ModificarCampania/?idCampania=<?php echo $campania['id_campania']; ?>" data-id="<?php echo $campania['id_campania']; ?>" data-nombre="<?php echo $campania['c_nombre']; ?>">
					        		<i data-feather="edit-3" data-toggle="tooltip" data-placement="top" title="modificar"></i>
				        		</a>
				        		<!--<a id="view_<?php echo $campania['id_campania']; ?>" class="view" href="#">
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
<div class="modal fade" id="modalMensajeCampania" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Eliminar -->
	<div class="modal fade" id="modalEliminarCampania" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTituloError mb-2" data-feather="trash-2"></i>
	        <h5 class="modal-title" id="tituloEC" name="tituloEC" data-idcampania="" data-nombrecampania="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafoEC"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="eliminarCampania" type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

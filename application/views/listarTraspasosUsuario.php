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
			  <input type="text" class="form-control form-control-sm" id="buscarTraspaso" placeholder="Busque por ( Nombre, Descripci&oacute;n, Abreviaci&oacute;n )">
			</div>
		</div>
	</div>
	<div id="agregarTraspaso" class="col-sm-6 text-right">
		<a href="AgregarTraspaso" class="btn btn-link"><i stop-color data-feather="plus"></i>Agregar Traspaso</a>
	</div>
</div>
<div class="row p-3">
	<div id="tDatos" class="col-sm-12 p-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle registro"># Folio</th>
			      <th scope="col" class="text-center align-middle registro">Fecha</th>
			      <th scope="col" class="text-center align-middle registro">Run</th>
			      <th scope="col" class="text-center align-middle registro">Nombre</th>
			      <th scope="col" class="text-center align-middle registro">Apellido</th>
			      <th scope="col" class="text-center align-middle registro">Celular</th>
			      <th scope="col" class="text-center align-middle registro">Estado</th>
			      <th scope="col" class="text-right align-middle registro">Ver PDF</th>
			    </tr>
			  </thead>
			  <tbody id="tbodyTraspaso">
			        <?php foreach ($traspasos as $traspaso): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle registro"><?php echo $traspaso['folio']; ?></th>
					        <td class="text-center align-middle registro"><?php echo $traspaso['fecha']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $traspaso['run']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $traspaso['nombres']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $traspaso['apellidos']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $traspaso['celular']; ?></td>
					        <td class="text-center align-middle registro"><?php echo $traspaso['nombre']; ?></td>
					         <td class="text-right align-middle registro">
					         	<?php if($traspaso['tiene_pdf'] == "1") { ?>
					        	<a id="view_<?php echo $traspaso['folio']; ?>" class="view" href="#" data-pdf="<?php echo $traspaso['signed_pdf']; ?>">
					        		<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver"></i>
				        		</a>
				        	<?php } ?>
				        	</td>
				    	</tr>
			  		<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<h3>
			<i class="plusTitulo mb-2" data-feather="map-pin" ></i> Localizaciones de validaciones
		</h3>
	</div>
</div>
<div class="row p-3">
	<div id="map" class="col-sm-12 p-3" style="height: 425px;">

	</div>
</div>

<!-- Modal Mensaje -->
<div class="modal fade" id="modalMensajeTraspaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	<div class="modal fade" id="modalEliminarTraspaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<i class="plusTituloError mb-2" data-feather="trash-2"></i>
	        <h5 class="modal-title" id="tituloEE" name="tituloEE" data-idtraspaso="" data-nombretraspaso="" ></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<p id="parrafoEE"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button id="eliminarTraspaso" type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

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
			  <input type="text" class="form-control form-control-sm" id="buscarEquipo" placeholder="Busque por ( Nombre, Descripci&oacute;n, Abreviaci&oacute;n )">
			</div>
		</div>
	</div>
	<div id="agregarEquipo" class="col-sm-6 d-flex justify-content-end">
		<a href="AgregarEquipo" class="btn btn-link"><i data-feather="plus"></i>Agregar Equipo</a>
	</div>
	<div id="tDatos" class="col-sm-12 m-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle"># ID</th>
			      <th scope="col" class="text-center align-middle">Nombre</th>
			      <th scope="col" class="text-center align-middle">Descripci&oacute;n</th>
			      <th scope="col" class="text-center align-middle">Abreviaci&oacute;n</th>
			      <th scope="col" class="text-center align-middle">Cant. Usuarios</th>
			      <th scope="col" class="text-center align-middle"></th>
			    </tr>
			  </thead>
			  <tbody id="tbodyEquipo">
			        <?php foreach ($equipos as $equipo): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle"><?php echo $equipo['id_equipo']; ?></th>
					        <td class="text-center align-middle"><?php echo $equipo['nombre']; ?></td>
					        <td class="text-center align-middle"><?php echo $equipo['descripcion']; ?></td>
					        <td class="text-center align-middle"><?php echo $equipo['abreviacion']; ?></td>
					        <td class="text-center align-middle"> 
					        	<span class="badge badge-primary badge-pill"><?php echo $equipo['cant_usu']; ?></span>
					        </td>
					        <td class="text-center align-middle">
					        	<div class="in-line">
					        	<a id="trash" class="trash" href="#" data-toggle="modal" data-target="#exampleModalCenter">
					        		<i data-feather="trash-2"></i>					        		
				        		</a>
				        		<a id="edit" class="edit" href="#">
					        		<i data-feather="edit"></i>
				        		</a>
				        		</div>
				        		
				        	</td>
				    	</tr>
			  		<?php endforeach ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">¿Estas seguro que deseas eliminar el Equipo "EAC A"?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Nombre: EAC A
          	Descripci&oacute;n: EAC A
          	Abreviaci&oacute;n: A
          	Cant. Usuarios: 34
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-danger">Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>

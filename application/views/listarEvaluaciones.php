<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
	
?>

<div class="row">
	<div id="filtros" class="col-sm-12 mt-3">		
		<div class="row justify-content-around mb-1">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span class="">Bienvenid@</span>
					</div>
					<div class="col-sm-8">
						<?php if(isset($u_nombres)) { echo $u_nombres; } ?> <?php if(isset($u_apellidos)) { echo $u_apellidos; } ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span class="">Gestionar</span>
					</div>
					<div class="col-sm-6">
						<select id="gestion" class="custom-select custom-select-sm disabled">
						    <option value="1">EAC</option>
						    <option value="2">CICLO</option>
						    <option value="3">FASE</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-around mb-1">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span >Empresa</span>
					</div>
					<div class="col-sm-6">
						<select id="empresa" class="custom-select custom-select-sm">
							<?php
							if($empresas)
							{
								foreach ($empresas as $empresa) {
									echo '<option value="'.$empresa['id_empresa'].'">'.$empresa['e_titulo'].'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span >Pendientes</span>
					</div>
					<div class="col-sm-6">
						<select id="rango" class="custom-select custom-select-sm">
						    <option value="2">CICLO</option>
						    <option value="3">FASE</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-around mb-1">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span >N° Ciclo</span>
					</div>
					<div class=" col-sm-6">
						<select id="numCiclo" class="custom-select custom-select-sm">
						    <option value="1">1</option>
						    <option value="1">2</option>
						    <option value="2">3</option>
						    <option value="2">4</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="tDatos" class="col-sm-12 m-3">
		<div class="table-responsive">

	<?php if(!$evaluaciones)
	{
		echo '<div class="alert alert-warning" role="alert">
		      	El usuario no posee campa&ntilde;s asociadas.
			  </div>';
	}else
	{
	?>
			<table class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle">ID EAC</th>
			      <th scope="col" class="text-center align-middle">Nombre EAC</th>
			      <?php
			      	for ($i=1; $i <=  $evaluaciones[0]['cant_campanias']; $i++) { 
			      		echo '<th scope="col" class="text-center align-middle">'.$evaluaciones[0][('nombre_camp_'.$i)].'</th>';
			      	}
			      ?>
			    </tr>
			  </thead>
			  <tbody id="tbodyEAC">
			  		<?php foreach ($evaluaciones as $evaluacion): ?>
			  			<tr>
					        <th scope="row" class="text-center align-middle"><?php echo $evaluacion['cod_usuario']; ?></th>
					        <td class="text-center align-middle"><?php echo $evaluacion['eac']; ?></td>
					         <?php
						      	for ($i=1; $i <=  $evaluaciones[0]['cant_campanias']; $i++) { 
						      		echo '<td class="text-center align-middle">
					        	<a href="'.base_url().'Evaluacion/AgregarEvaluacion/?idEAC='.$evaluacion['id_usu'].'&idCamp='.$evaluacion[('id_camp_'.$i)].'" class="badge badge-pill ';

					        	if($evaluacion[('cant_eval_'.$i)] == 0)
					        	{
					        		echo 'badge-danger'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$evaluacion[('total_eac_'.$i)];	
					        	}else
					        		if($evaluacion[('cant_eval_'.$i)] > 0 && $evaluacion[('cant_eval_'.$i)] < $evaluacion[('total_eac_'.$i)])
					        		{
					        			echo 'badge-warning'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$evaluacion[('total_eac_'.$i)];
					        		}else{
					        			echo 'badge-success'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$evaluacion[('total_eac_'.$i)];
					        		}
						      	}
						      	echo '</a></td>';
						      ?>

				    	</tr>
			  		<?php endforeach ?>
			  </tbody>
			</table>
	<?php 
	}
	?>
		</div>
	</div>
</div>

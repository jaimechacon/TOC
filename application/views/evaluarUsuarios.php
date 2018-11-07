<?php
	$id_usuario=$this->session->userdata('id_usuario');
	if(!$id_usuario){
	  redirect('Login');
	}
	//var_dump(isset($evaluaciones[0]['cant_a_gestionar_2_1']));
?>

<div class="row">
	<div id="filtros" class="col-sm-12 mt-3">		
		<div class="row justify-content-around mb-1">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span>Bienvenid@</span>
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
						<select id="gestionEvaluacion" class="custom-select custom-select-sm">
						    <option value="2">CICLO</option>
						    <option value="3">FASE</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="row justify-content-around mb-1">
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
		</div>-->
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
			      <th scope="col" class="text-left align-middle">Nombre EAC</th>
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
					        <td class="text-left align-middle"><?php echo $evaluacion['eac']; ?></td>
					         <?php
//					         	var_dump($evaluacion);
						      	for ($i=1; $i <=  $evaluaciones[0]['cant_campanias']; $i++) { 
						      		//var_dump($evaluacion['cod_usuario']);
						      		echo '<td class="text-center align-middle">
					        	<a href="'.base_url().'Evaluacion/AgregarEvaluacion/?idEAC='.$evaluacion['cod_usuario'].'&idCamp='.$evaluacion[('id_camp_'.$i)].'" class="badge badge-pill ';

					        	$total_gestiones = 0;

					        	if(isset($evaluacion[('cant_a_gestionar_2_'.$i)]) && ($evaluacion[('cant_a_gestionar_2_'.$i)]) == 0 && isset($evaluacion[('cant_a_gestionar_usuario_'.$i)]))
					        	{
					        		$total_gestiones = $evaluacion[('cant_a_gestionar_usuario_'.($i-1))];
					        	}else
					        	{
					        		$total_gestiones = $evaluacion[('cant_a_gestionar_'.$i)];
					        	}

					        	if($evaluacion[('cant_eval_'.$i)] == 0)
					        	{
					        		echo 'badge-danger'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$total_gestiones;	
					        	}else
					        		if($evaluacion[('cant_eval_'.$i)] > 0 && $evaluacion[('cant_eval_'.$i)] < $total_gestiones)
					        		{
					        			echo 'badge-warning'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$total_gestiones;
					        		}else{
					        			echo 'badge-success'.'">'.$evaluacion[('cant_eval_'.$i)].'   /   '.$total_gestiones;
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

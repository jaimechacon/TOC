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
	<?php if(isset($usuariosAnalistas) && sizeof($usuariosAnalistas) > 1) { ?>
		<div class="row justify-content-around mb-1">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<span >Agente</span>
					</div>
					<div class="col-sm-6">
						<select id="selectAnalistas" class="custom-select custom-select-sm">
							<option value="-1">Seleccione un Analista</option>
							<?php 
							if($usuariosAnalistas)
							{
								//var_dump($usuariosAnalistas);
								foreach ($usuariosAnalistas as $analista) {


									if(isset($id_usuario) && (int)$analista['id_usuario'] == $id_usuario)
									{
										echo '<option value="'.$analista['id_usuario'].'" selected>'.$analista['nombre_completo'].'</option>';
									}else
									{
										echo '<option value="'.$analista['id_usuario'].'">'.$analista['nombre_completo'].'</option>';
									}

									//echo '<option value="'.$analista['id_usuario'].'">'.$analista['nombre_completo'].'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
			</div>
				<div class="col-sm-4"></div>
		</div>
	<?php } ?>
	</div>

	<div id="tDatos" class="col-sm-12 m-3">
		<div id="dvTResponsive" class="table-responsive">

	<?php 
	 //var_dump($evaluaciones[0]["resultado"]);
	 //var_dump(!isset($evaluaciones));
	if(isset($evaluaciones) && $evaluaciones[0]["resultado"] == "0")
	{ ?>
		<div class="alert alert-warning" role="alert">
			<?php echo $evaluaciones[0]["mensaje"]; ?>
		</div>
	<?php 
	}else
	{
		if(isset($evaluaciones) && $evaluaciones[0]["resultado"] == "1" && $evaluaciones[0]["mensaje"] == "")
		{
	?>
			<table id="tEvaluacionesPendientes" class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col" class="text-center align-middle">ID EAC</th>
			      <th scope="col" class="text-left align-middle">Nombre EAC</th>
			      <?php
			      	for ($i=0; $i <  $evaluaciones[0]['cant_campanias']; $i++) { 
			      		echo '<th scope="col" class="text-center align-middle">'.$evaluaciones[0][('nombre_camp_'.$i)].'</th>';
			      	}
			      ?>
			    </tr>
			  </thead>
			  <tbody id="tbodyEvaluaciones">
			  		<?php 
				  		foreach ($evaluaciones as $evaluacion): ?>
				  			<tr>
						        <th scope="row" class="text-center align-middle"><?php echo $evaluacion['cod_usuario']; ?></th>
						        <td class="text-left align-middle"><?php echo $evaluacion['eac']; ?></td>
						         <?php
						         	
									//$tiene_grabaciones = (!isset($evaluacion['tiene_grabaciones_'.$i])) ? $evaluacion['tiene_grabaciones_'.$i] : 'asdf' ;
						      		//var_dump($tiene_grabaciones);

							      	for ($i=0; $i < $evaluaciones[0]['cant_campanias']; $i++) { 
							      		//var_dump($evaluacion['cod_usuario']);
							      		//var_dump($evaluacion[('tiene_grabaciones_'.($i))]);

							      		echo '<td class="text-center align-middle">';

							      		//var_dump(!is_null($evaluacion[('total_gestionar_'.($i))]));
							      		//var_dump('total grabaciones: '.$evaluacion[('tiene_grabaciones_'.($i))]);

							      		if($evaluacion[('tiene_grabaciones_'.($i))] == "1" && $evaluacion[('se_gestiona_'.($i))] == "1")
							      		{		      			
								        	echo '<a href="'.base_url().'Evaluacion/AgregarEvaluacion/?idEAC='.$evaluacion['cod_usuario'].'&idCamp='.$evaluacion[('id_camp_'.$i)].'&codCamp='.$evaluacion[('cod_camp_'.$i)].'&idUsuResp='.$usuario['id_usuario'].'" data-toggle="tooltip" data-placement="top" title="click para gestionar" class="badge badge-pill ';

								        	$total_gestiones = $evaluacion[('total_gestionar_'.($i))];
								        	$gestiones = $evaluacion[('cant_evaluaciones_'.($i))];


								        	if($evaluacion[('cant_evaluaciones_'.$i)] == 0)
								        	{
								        		echo 'badge-danger'.'">'.$evaluacion[('cant_evaluaciones_'.$i)].'   /   '.$total_gestiones;	
								        	}else{
								        		if($evaluacion[('cant_evaluaciones_'.$i)] > 0 && $evaluacion[('cant_evaluaciones_'.$i)] < $total_gestiones)
								        		{
								        			echo 'badge-warning'.'">'.$evaluacion[('cant_evaluaciones_'.$i)].'   /   '.$total_gestiones;
								        		}else{
								        			echo 'badge-success'.'">'.$evaluacion[('cant_evaluaciones_'.$i)].'   /   '.$total_gestiones;
								        		}
									      	}
									      	echo '</a>';
							      		}else
							      		{
							      			if($evaluacion[('se_gestiona_'.($i))] == "1")
							      			{
							      				echo '<i data-feather="phone-off" class="telefono_gestiones" ></i>';
							      			}
							      		}
							      		echo '</td>';
							      	}
							      ?>

					    	</tr>
				  		<?php endforeach; ?>
			  </tbody>
			</table>
	<?php 
		}else
  		{
  			if (isset($evaluaciones) && $evaluaciones[0]["resultado"] == "1" && $evaluaciones[0]["es_administrador"] == "1") {
  				
  			}else
  			{?>
				<div class="alert alert-warning" role="alert">
					<?php echo $evaluaciones[0]["mensaje"]; ?>
				</div>
	<?php	}
		}
	}
	?>
		</div>
	</div>
</div>

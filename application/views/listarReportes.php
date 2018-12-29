<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
	
?>
<div class="row pt-3">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<h3>Consolidado de Situación Financiera</h3>
			</div>
		</div>
		<hr class="my-4">
		<div class="row">
			<div class="col-sm-12">	
				<div class="row">			
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Instituci&oacute;n</span>
							</div>
							<div class="col-sm-9">
								<select id="institucion" class="custom-select custom-select-sm">
								   	<option value="-1">Seleccione un Instituto</option>
									<?php 
									if($instituciones)
									{
										foreach ($instituciones as $institucion) {
											echo '<option value="'.$institucion['id_institucion'].'">'.$institucion['nombre'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Hospital</span>
							</div>
							<div class="col-sm-9">
								<select id="hospital" class="custom-select custom-select-sm">
								    <option value="-1">Seleccione un Hospital</option>
									<?php 
									if($hospitales)
									{
										foreach ($hospitales as $hospital) {
											echo '<option value="'.$hospital['id_hospital'].'">'.$hospital['nombre'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 pt-3">	
				<div class="row">			
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-3">
								<span class="">Cuenta</span>
							</div>
							<div class="col-sm-9">
								<select id="cuenta" class="custom-select custom-select-sm">
								   	<option value="-1">Seleccione una Cuenta</option>
									<?php
									if($cuentas)
									{
										foreach ($cuentas as $cuenta) {
											echo '<option value="'.$cuenta['id_cuenta'].'">'.$cuenta['nombre'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6" hidden>
						<div class="row">
							<div class="col-sm-3">
								<span class="">Item</span>
							</div>
							<div class="col-sm-9">
								<select id="items" class="custom-select custom-select-sm">
								    <option value="-1">Seleccione un Item</option>
									<?php 
									if($items)
									{
										foreach ($items as $item) {
											echo '<option value="'.$item['id_item'].'">'.$item['nombre'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 pt-3 pb-3">				
				<div class="card">
					<div class="card-header">
						I. Equilibrio Financiero (Vista en M$)
					</div>
					<div class="card-body">
						<div id="tablaReporteResumen" class="row">
							<div class="col-sm-12">
								<table id="tReporteResumen" class="table table-hover table-bordered table-sm">
									<thead class="thead-dark">
										<tr>
											<th class="text-center" scope="col">Ingresos</th>
											<th class="text-center" scope="col">Ppto. Vigente</th>
											<th class="text-center" scope="col">I. Rec. 2018</th>
											<th class="text-center" scope="col">Ejec. %</th>
											<th class="text-center" scope="col">I. Rec. 2017</th>
											<th class="text-center" scope="col">Var 18-17</th>
										</tr>
									</thead>
									<tbody id="tbodyReporteResumen">

										<?php	
										if(isset($reporteResumenes) && isset($reporteResumenes["resultado"]))
										{								
											foreach ($reporteResumenes as $reporteResumen) {
												if($reporteResumen['nombre'] == "Total" )
												{
													echo '<tr>
															<th class="">'.$reporteResumen['nombre'].'</th>
															<th class="text-center">'.'----'.'</th>
															<th class="text-right">'.'$ '.number_format($reporteResumen['Recaudado_2018'], 0, ",", ".").'</th>
															<th class="text-center">'.'----'.'</th>
															<th class="text-right">'.'$ '.number_format($reporteResumen['Recaudado_2017_con_mult'], 0, ",", ".").'</th>
															<th class="text-center">'.$reporteResumen['var_18_17'].'</th>
															</tr>';
												}else{
													echo '<tr>
															<td class="">'.$reporteResumen['codigo'].' '.$reporteResumen['nombre'].'</td>
															<td class="text-center">'.'----'.'</td>
															<td class="text-right">'.'$ '.number_format($reporteResumen['Recaudado_2018'], 0, ",", ".").'</td>
															<td class="text-center">'.'----'.'</td>
															<td class="text-right">'.'$ '.number_format($reporteResumen['Recaudado_2017_con_mult'], 0, ",", ".").'</td>
															<td class="text-center">'.$reporteResumen['var_18_17'].'</td>
															</tr>';
												}
											}
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-12">
								<table id="tReporteResumenGasto" class="table table-hover table-bordered table-sm">
									<thead class="thead-dark">
										<tr>
											<th class="text-center" scope="col">Gastos</th>
											<th class="text-center" scope="col">Ppto. Vigente</th>
											<th class="text-center" scope="col">G. Dev. 2018</th>
											<th class="text-center" scope="col">Ejec. %</th>
											<th class="text-center" scope="col">G. Dev. 2017</th>
											<th class="text-center" scope="col">Var 18-17</th>
										</tr>
									</thead>
									<tbody id="tbodyReporteResumenGasto">

										<?php
											if(isset($reporteResumenesGastos) && isset($reporteResumenesGastos["resultado"]))
											{
												foreach ($reporteResumenesGastos as $reporteResumenGasto) {
													if($reporteResumen['nombre'] == "Total" )
												{
													echo '<tr>
															<th class="">'.$reporteResumenGasto['nombre'].'</th>
															<th class="text-center">'.'----'.'</th>
															<th class="text-right">'.'$ '.number_format($reporteResumenGasto['Recaudado_2018'], 0, ",", ".").'</th>
															<th class="text-center">'.'----'.'</th>
															<th class="text-right">'.'$ '.number_format($reporteResumenGasto['Recaudado_2017_con_mult'], 0, ",", ".").'</th>
															<th class="text-center">'.$reporteResumenGasto['var_18_17'].'</th>
															</tr>';
													}else{
														echo '<tr>
															<td class="">'.$reporteResumenGasto['codigo']." ".$reporteResumenGasto['nombre'].'</td>
															<td class="text-center">'.'----'.'</td>
															<td class="text-right">'.'$ '.number_format($reporteResumenGasto['Recaudado_2018'], 0, ",", ".").'</td>
															<td class="text-center">'.'----'.'</td>
															<td class="text-right">'.'$ '.number_format($reporteResumenGasto['Recaudado_2017_con_mult'], 0, ",", ".").'</td>
															<td class="text-center">'.$reporteResumenGasto['var_18_17'].'</td>
															</tr>';
													}
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="loader" class="loader" hidden></div>
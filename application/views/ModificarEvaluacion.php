<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
?>
<div class="row">	
	<div class="col-sm-12 mt-3">
		<div id="filtros" class="mt-3 mr-3 ml-3">
					<div class="row justify-content-between">
						<div class="col-sm-3">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>Agente</td>
											<td>
												<?php if(isset($u_nombres)) { echo $u_nombres; } ?> <?php if(isset($u_apellidos)) { echo $u_apellidos; } ?>
											</td>
										</tr>
										<tr>
											<td>Empresa</td>
											<td>CLARO</td>
										</tr>
										<tr>
											<td>Fecha</td>
											<td><?php echo date("d/m/Y"); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="titulo" class="col-sm-3 mt-4">
							<div class="row justify-content-center ">
								<div class="row justify-content-center ">
									<h3><?php echo $pauta[0]['P_NOMBRE']; ?></h3>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="musica">
							    	<audio src="<?php echo base_url(); ?>grabaciones/930904279-1151056-20180810121655.mp3" preload="auto" controls></audio>
							    	<!--<audio src="<?php //echo base_url(); ?>grabaciones/MONITOREO/930904279-1151056-20180810121655.mp3" preload="auto" controls></audio>-->
							    </div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="row">
								<table class="table table-sm table-bordered">
									<tbody>
										<tr>
											<td>EAC</td>
											<td><?php echo $pauta[0]['NOMBRE_EAC']; ?></td>
										</tr>
										<tr>
											<td>ID Llamada</td>
											<td>13246578</td>
										</tr>
										<tr>
											<td>Evaluacion</td>
											<td>2   /   3</td>
										</tr>
									</tbody>
								</table>	
							</div>
						</div>
					</div>			
				</div>
				<div id="tablaPreguntas" class="mt-1 ml-3 mr-3">
					<div class="row justify-content-center">
						<table class="table table-hover table-sm">
							<thead class="thead-dark">
								<tr>
									<th scope="col">N°</th>
									<th scope="col" colspan="9">Pregunta</th>
									<th scope="col">Cumple</th>
									<th scope="col">No Cumple</th>
								</tr>
							</thead>
							<tbody>
								<tr>
							<th scope="col" colspan="12">Error No Cr&iacute;tico</th>
						</tr>
						<tr>
							
							<th scope="row">1</th>							
							<td colspan="9">Saludo formal (Bienvenida e identificaci&oacute;n)</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios1" id="optionsRadios4" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios1" id="optionsRadios5" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td colspan="9">Fluidez, modulaci&oacute;n, dicci&oacute;n</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios2" id="optionsRadios4" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios2" id="optionsRadios5" value="option2">
							</td>
						</tr>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td colspan="9">Utiliza lenguaje formal</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios3" id="optionsRadios3" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios3" id="optionsRadios3" value="option2">
							</td>
						</tr>
							<!--<td class="text-center">
								<input type="radio" name="optionsRadios3" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios3" id="optionsRadios2" value="option2">
							</td>-->
						</tr>
						<tr>
							<th scope="row">4</th>
							<td colspan="9">Parafrasea RUT, serie, f de nac cliente, pcs, imei, simcard</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios4" id="optionsRadios4" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios4" id="optionsRadios5" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">5</th>
							<td colspan="9">Manejo y dominio llamada</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios5" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios5" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">6</th>
							<td colspan="9">Despedida formal corporativa</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios6" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios6" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="col" colspan="12">Error Cr&iacute;tico</th>
						</tr>
						<tr>
							<th scope="row">7</th>
							<td colspan="9">Solicita rut de cliente</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios7" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios7" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">8</th>
							<td colspan="9">Solicita pcs de cliente</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios8" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios8" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">9</th>
							<td colspan="9">Solicita serie CI de cliente</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios9" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios9" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">10</th>
							<td colspan="9">Solicita Fecha de nacimiento</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios10" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios10" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">11</th>
							<td colspan="9">Solicita Tipo Acreditación e ingresa de forma correcta en los sistemas</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios11" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios11" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">12</th>
							<td colspan="9">Entrega Número de atención (notel)</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios12" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios12" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="col" colspan="12">Faltas Graves</th>
						</tr>
						<tr>
							<th scope="row">13</th>
							<td colspan="9">Entrega informaci&oacute;n err&oacute;nea o incompleta de los resultados de la evaluaci&oacute;n</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios13" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios13" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">14</th>
							<td colspan="9">Realiza una atenci&oacute;n descort&eacute;s, grosera (garabatos, insultos, engancha con vendedor, etc.)</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios14" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios14" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">15</th>
							<td colspan="9">Cumple con los TMO establecidos</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios15" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios15" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">16</th>
							<td colspan="9">Cumple con silencios y mute (Evitar los silencios prolongados)</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios16" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios16" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">17</th>
							<td colspan="9">Demora en contestar llamada o no contesta llamada</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios17" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios17" id="optionsRadios2" value="option2">
							</td>
						</tr>
						<tr>
							<th scope="row">18</th>
							<td colspan="9">Permanece en linea luego de finalizada la llamada</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios18" id="optionsRadios1" value="option1" checked="true">
							</td>
							<td class="text-center">
								<input type="radio" name="optionsRadios18" id="optionsRadios2" value="option2">
							</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
				<div id="observaciones" class="row">
					<div class="row col-sm-12 m-2">
						<label for="exampleFormControlTextarea1">Observaciones</label>
						<textarea class="form-control block" id="exampleFormControlTextarea1" rows="3">
							Usuario cumple con todos los requisitos de la pauta de Evaluaci&oacute;n.
						</textarea>
					</div>
				</div>
				<div id="botones" class="row m-3">
					<div class="col-sm-6 text-left">
						<a class="btn btn-link"  href="<?php echo base_url();?>Evaluacion/ListarEvaluaciones">Volver</a>
					</div>
					<div  class="col-sm-6 text-right">
					 	<button type="button" class="btn btn-primary ">Guardar Evaluacion</button>
					</div>
				</div>
	</div>
</div>
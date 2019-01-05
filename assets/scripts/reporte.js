 $(document).ready(function() {

 	$("#institucion").change(function() {
		listarReportes();
		institucion = $("#institucion").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospital").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospital").append(row);
	        }
      	}
    	});
	});

	$("#institucionItem").change(function() {
		listarReportesItem();
		institucion = $("#institucionItem").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitalItem").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitalItem").append(row);
	        }
      	}
    	});
	});

 	$("#hospital").change(function() {
		listarReportes();
	});

	$("#hospitalItem").change(function() {
		listarReportesItem();
	});

	$("#cuenta").change(function() {
		listarReportes();
	});

 	function listarReportes()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucion").val();
	    hospital = $("#hospital").val();
	    cuenta = $("#cuenta").val();
	    item = $("#item").val();

	    var baseurl = window.origin + '/Reporte/listarReporteResumen';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
		success: function(data) {
	        if (data)
	        {			
				$("#tbodyReporteResumen").empty();
				for (var i = 0; i < data.length; i++){
		            var row = '';
		            row = row.concat('<tr>');
		            if(data[i]['nombre'] == 'Total')
		            {
		            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
			            row = row.concat('\n<th class="text-center table-active"></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">');
		            	row = row.concat((data[i]['codigo'] + ' ' + data[i]['nombre']).substring(0, 30));
		            	row = row.concat('</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n <td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
			            row = row.concat('\n<td class="text-center">');
						row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
						row = row.concat('\n</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucion").val();
			    hospital = $("#hospital").val();
			    cuenta = $("#cuenta").val();
			    item = $("#item").val();

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenGasto';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
				success: function(data) {
			        if (data)
			        {			
						$("#tbodyReporteResumenGasto").empty();
						for (var i = 0; i < data.length; i++){
				            var row = '';
				            row = row.concat('<tr>');
				            if(data[i]['nombre'] == 'Total')
				            {
				            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
					            row = row.concat('\n<th class="text-center table-active"></th>');
				            }else{
					            row = row.concat('\n<td class=""><p class="texto-pequenio">');
				            	row = row.concat((data[i]['codigo'] + ' ' + data[i]['nombre']).substring(0, 30));
				            	row = row.concat('</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
					            row = row.concat('\n<td class="text-center">');
								row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
								row = row.concat('\n</td>');
				        	}
				            row = row.concat('\n</tr>');
				          $("#tbodyReporteResumenGasto").append(row);
				        }


				        institucion = $("#institucion").val();
					    hospital = $("#hospital").val();
					    cuenta = $("#cuenta").val();
					    item = $("#item").val();

				    	var baseurl = window.origin + '/Reporte/listarReporteResumenTipo';
					    jQuery.ajax({
						type: "POST",
						url: baseurl,
						dataType: 'json',
						data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
						success: function(data) {
					        if (data)
					        {			
					        	$("#tbodyReporteResumenTipo").empty();
								for (var i = 0; i < data.length; i++){
						            var row = '';
						            row = row.concat('<tr>');
						            if(data[i]['nombre'] == 'Total')
						            {
						            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['abreviacion'],'</p></th>');
							            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
							            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></th>');
							            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
							            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
						            }else{
							            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['abreviacion'],'</p></td>');
							            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
							            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></td>');
							            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
							            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
						        	}
						            row = row.concat('\n</tr>');
						          $("#tbodyReporteResumenTipo").append(row);
						        }


						        institucion = $("#institucion").val();
							    hospital = $("#hospital").val();
							    cuenta = $("#cuenta").val();
							    item = $("#item").val();

						    	var baseurl = window.origin + '/Reporte/listarReporteResumenTipoGasto';
							    jQuery.ajax({
								type: "POST",
								url: baseurl,
								dataType: 'json',
								data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
								success: function(data) {
							        if (data)
							        {			
							        	$("#tbodyReporteResumenGastoTipo").empty();
										for (var i = 0; i < data.length; i++){
								            var row = '';
								            row = row.concat('<tr>');
								            if(data[i]['nombre'] == 'Total')
								            {
								            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['abreviacion'],'</p></th>');
									            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></th>');
									            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['devengado']),'</p></th>');
									            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['por_percibir']),'</p></th>');
								            }else{
									            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['abreviacion'],'</p></td>');
									            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></td>');
									            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['devengado']),'</p></td>');
									            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['por_percibir']),'</p></td>');
								        	}
								            row = row.concat('\n</tr>');
								          $("#tbodyReporteResumenGastoTipo").append(row);
								        }

								        feather.replace()
				      					loader.setAttribute('hidden', '');
		      						}
						      	}
							    });
	      					}
				      	}
					    });
			        }
		      	}
		    	});



	        }
      	}
    	});

  	};

  	function listarReportesItem()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucionItem").val();
	    hospital = $("#hospitalItem").val();
	    cuentaSeleccion = $(document.getElementById('cuentaSeleccion'));
		cuenta = cuentaSeleccion.data('id');
	    item = -1;//$("#item").val();

	    var baseurl = window.origin + '/Reporte/listarReporteResumenItem';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
		success: function(data) {
	        if (data)
	        {			
				$("#tbodyReporteResumen").empty();
				for (var i = 0; i < data.length; i++){
		            var row = '';
		            row = row.concat('<tr>');
		            if(data[i]['nombre'] == 'Total')
		            {
		            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
			            row = row.concat('\n<th class="text-center table-active"></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n <td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
			            row = row.concat('\n<td class="text-center">');
						row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
						row = row.concat('\n</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucionItem").val();
			    hospital = $("#hospitalItem").val();
			    cuentaSeleccion = $(document.getElementById('cuentaSeleccion'));
				cuenta = cuentaSeleccion.data('id');
			    item = -1;//$("#item").val();

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenItemGasto';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item },
				success: function(data) {
			        if (data)
			        {			
						$("#tbodyReporteResumenGasto").empty();
						for (var i = 0; i < data.length; i++){
				            var row = '';
				            row = row.concat('<tr>');
				            if(data[i]['nombre'] == 'Total')
				            {
				            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
					            row = row.concat('\n<th class="text-center table-active"></th>');
				            }else{
					            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
					            row = row.concat('\n<td class="text-center">');
								row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
								row = row.concat('\n</td>');
				        	}
				            row = row.concat('\n</tr>');
				          $("#tbodyReporteResumenGasto").append(row);
				        }
				        feather.replace()
      					loader.setAttribute('hidden', '');
			        }
		      	}
		    	});



	        }
      	}
    	});

  	};


	function formatNumber (n) {
		n = String(n).replace(/\D/g, "");
	  return n === '' ? n : Number(n).toLocaleString();
	}
	Number.addEventListener('keyup', (e) => {
		const element = e.target;
		const value = element.value;
	  element.value = formatNumber(value);
	});
});
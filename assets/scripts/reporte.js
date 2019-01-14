 $(document).ready(function() {

 	$("#institucion").change(function() {
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
		listarReportes();
		listarReporteResumenGrafico();
		cargarGraficos();
	});

	$("#institucionItem").change(function() {
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
				listarReportesItem();
	        }
      	}
    	});		
	});

	$("#institucionAsignacion").change(function() {
		institucion = $("#institucionAsignacion").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitalAsignacion").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitalAsignacion").append(row);
				listarReportesAsignacion();
	        }
      	}
    	});
	});

	$("#institucionSubAsignacion").change(function() {
		institucion = $("#institucionSubAsignacion").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitalSubAsignacion").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitalSubAsignacion").append(row);
				listarReportesSubAsignacion();
	        }
      	}
    	});    	
	});

	$("#institucionEspecifico").change(function() {
		institucion = $("#institucionEspecifico").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitalEspecifico").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitalEspecifico").append(row);
				listarReportesEspecifico();
	        }
      	}
    	});    	
	});

	$("#institucionFecha").change(function() {
		institucion = $("#institucionFecha").val();
		var baseurl = window.origin + '/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitalFecha").empty();
				var row = '<option value="-1">Todos</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitalFecha").append(row);
				listarReportesFecha();
	        }
      	}
    	});    	
	});

 	$("#hospital").change(function() {
		listarReportes();
		listarReporteResumenGrafico();
		cargarGraficos();
	});

	$("#hospitalItem").change(function() {
		listarReportesItem();
	});

	$("#hospitalAsignacion").change(function() {
		listarReportesAsignacion();
	});

	$("#hospitalSubAsignacion").change(function() {
		listarReportesSubAsignacion();
	});

	$("#hospitalEspecifico").change(function() {
		listarReportesEspecifico();
	});

	$("#hospitalFecha").change(function() {
		listarReportesFecha();
	});

	$("#cuenta").change(function() {
		listarReportes();
	});

	$("#mes").change(function() {
		listarReportesFecha();
	});

	$("#anio").change(function() {
		listarReportesFecha();
	});

	$('#inflactor').on('change',function(e){
    	listarReportesFecha();
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
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['ppto_vigente']),'</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['ejec'],'%</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
			            row = row.concat('\n<th class="text-center table-active"></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">');
		            	row = row.concat((data[i]['codigo'] + ' ' + data[i]['nombre']).substring(0, 30));
		            	row = row.concat('</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['ppto_vigente']),'</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['ejec'],'%</p></td>');
			            row = row.concat('\n <td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
			            row = row.concat('\n<td class="text-center botonTabla">');
			            row = row.concat('\n<button type="button" class="btn btn-link redireccionarItem botonTabla" data-id="',data[i]["id_cuenta"],'" data-toggle="tooltip" title="click para ver detalle de cuenta">');
			            row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
						//row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
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
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['ppto_vigente']),'</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['ejec'],'%</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></th>');
					            row = row.concat('\n<th class="text-center table-active"></th>');
				            }else{
					            row = row.concat('\n<td class=""><p class="texto-pequenio">');
				            	row = row.concat((data[i]['codigo'] + ' ' + data[i]['nombre']).substring(0, 30));
				            	row = row.concat('</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['ppto_vigente']),'</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['ejec'],'%</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
					            row = row.concat('\n<td class="text-center botonTabla">');
					            row = row.concat('\n<button type="button" class="btn btn-link redireccionarItem botonTabla" data-id="',data[i]["id_cuenta"],'" data-toggle="tooltip" title="click para ver detalle de cuenta">');
					            row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
								//row = row.concat('\n<a href="listarReportesItem/?idCuenta=',data[i]['id_cuenta'],'" title="click para ver detalle de cuenta"><i data-feather="search" class="trash"></i></a>');
								row = row.concat('\n</td>');
				        	}
				            row = row.concat('\n</tr>');
				          $("#tbodyReporteResumenGasto").append(row);
				        }

				        loader.removeAttribute('hidden');

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
							            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['presupuesto']),'</p></th>');
							            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></th>');
							            row = row.concat('\n<th class="text-center"><p class="texto-pequenio">',data[i]['var'],'%</p></th>');
							            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">','----','</p></th>');
						            }else{
							            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['abreviacion'],'</p></td>');
							            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['presupuesto']),'</p></td>');
							            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['recaudado']),'</p></td>');
							            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var'],'%</p></td>');
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
			            row = row.concat('\n<td class="text-center botonTabla">');
			            row = row.concat('\n<button type="button" class="btn btn-link redireccionarAsignacion botonTabla" data-id="',data[i]["id_item"],'" data-toggle="tooltip" title="click para ver detalle de item">');
					    row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
						//row = row.concat('\n<a href="listarReportesAsignacion/?idItem=',data[i]['id_item'],'" title="click para ver detalle de item"><i data-feather="search" class="trash"></i></a>');
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
					            row = row.concat('\n<td class="text-center botonTabla">');
					            row = row.concat('\n<button type="button" class="btn btn-link redireccionarAsignacion botonTabla" data-id="',data[i]["id_item"],'" data-toggle="tooltip" title="click para ver detalle de item">');
					    		row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
								//row = row.concat('\n<a href="listarReportesAsignacion/?idItem=',data[i]['id_item'],'" title="click para ver detalle de item"><i data-feather="search" class="trash"></i></a>');
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

  	function listarReportesAsignacion()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucionAsignacion").val();
	    hospital = $("#hospitalAsignacion").val();
	    itemSeleccion = $(document.getElementById('itemSeleccion'));
	    cuenta = itemSeleccion.data('idcuenta');
		item = itemSeleccion.data('id');

	    var baseurl = window.origin + '/Reporte/listarReporteResumenAsignacion';
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
			            row = row.concat('\n<td class="text-center botonTabla">');
			            row = row.concat('\n<button type="button" class="btn btn-link redireccionarSubAsignacion botonTabla" data-id="',data[i]["id_asignacion"],'" data-toggle="tooltip" title="click para ver detalle de de asignaci&oacute;n">');
					    row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
						//row = row.concat('\n<a href="listarReportesSubAsignacion/?idAsignacion=',data[i]['id_asignacion'],'" title="click para ver detalle de asignaci&oacute;n"><i data-feather="search" class="trash"></i></a>');
						row = row.concat('\n</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucionAsignacion").val();
			    hospital = $("#hospitalAsignacion").val();
			    itemSeleccion = $(document.getElementById('itemSeleccion'));
			    cuenta = itemSeleccion.data('idcuenta');
				item = itemSeleccion.data('id');

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenAsignacionGasto';
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
					            row = row.concat('\n<td class="text-center botonTabla">');
								row = row.concat('\n<button type="button" class="btn btn-link redireccionarSubAsignacion botonTabla" data-id="',data[i]["id_asignacion"],'" data-toggle="tooltip" title="click para ver detalle de de asignaci&oacute;n">');
					    		row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
								//row = row.concat('\n<a href="listarReportesSubAsignacion/?idAsignacion=',data[i]['id_asignacion'],'" title="click para ver detalle de asignacion"><i data-feather="search" class="trash"></i></a>');
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

  	function listarReportesSubAsignacion()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucionSubAsignacion").val();
	    hospital = $("#hospitalSubAsignacion").val();
	    asignacionSeleccion = $(document.getElementById('asignacionSeleccion'));
	    cuenta = asignacionSeleccion.data('idcuenta');
	    item = asignacionSeleccion.data('iditem');
		asignacion = asignacionSeleccion.data('id');
	    //item = -1;//$("#item").val();

	    var baseurl = window.origin + '/Reporte/listarReporteResumenSubAsignacion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, item: item, asignacion: asignacion},
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
			            row = row.concat('\n<td class="text-center botonTabla">');
						row = row.concat('\n<button type="button" class="btn btn-link redireccionarEspecifico botonTabla" data-id="',data[i]["id_sub_asignacion"],'" data-toggle="tooltip" title="click para ver detalle de de sub asignaci&oacute;n">');
			    		row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
						//row = row.concat('\n<a href="listarReportesEspecifico/?idSubAsignacion=',data[i]['id_sub_asignacion'],'" title="click para ver detalle de Sub Asignaci&oacute;n"><i data-feather="search" class="trash"></i></a>');
						row = row.concat('\n</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucionSubAsignacion").val();
			    hospital = $("#hospitalSubAsignacion").val();
			    asignacionSeleccion = $(document.getElementById('asignacionSeleccion'));
			    cuenta = asignacionSeleccion.data('idcuenta');
			    item = asignacionSeleccion.data('iditem');
				asignacion = asignacionSeleccion.data('id');

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenSubAsignacionGasto';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item, asignacion: asignacion },
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
					            row = row.concat('\n<td class="text-center botonTabla">');
					            row = row.concat('\n<button type="button" class="btn btn-link redireccionarEspecifico botonTabla" data-id="',data[i]["id_sub_asignacion"],'" data-toggle="tooltip" title="click para ver detalle de de sub asignaci&oacute;n">');
			    				row = row.concat('\n<i data-feather="search" class="trash"></i></button>');
								//row = row.concat('\n<a href="listarReportesEspecifico/?idSubAsignacion=',data[i]['id_sub_asignacion'],'" title="click para ver detalle de Sub asignaci&oacute;n"><i data-feather="search" class="trash"></i></a>');
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


	function listarReportesEspecifico()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucionEspecifico").val();
	    hospital = $("#hospitalEspecifico").val();
	    subasignacionSeleccion = $(document.getElementById('subasignacionSeleccion'));
	    cuenta = subasignacionSeleccion.data('idcuenta');
	    item = subasignacionSeleccion.data('iditem');
	    asignacion = subasignacionSeleccion.data('idasignacion');
	    subAsignacion = subasignacionSeleccion.data('id');

	    var baseurl = window.origin + '/Reporte/listarReporteResumenEspecifico';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, item: item, asignacion: asignacion, subAsignacion: subAsignacion},
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
			            //row = row.concat('\n<th class="text-center table-active"></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n <td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
			            //row = row.concat('\n<td class="text-center">');
						//row = row.concat('\n<a href="listarReportesEspecifico/?idSubAsignacion=',data[i]['id_sub_asignacion'],'" title="click para ver detalle de Sub Asignaci&oacute;n"><i data-feather="search" class="trash"></i></a>');
						//row = row.concat('\n</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucionEspecifico").val();
			    hospital = $("#hospitalEspecifico").val();
			    subasignacionSeleccion = $(document.getElementById('subasignacionSeleccion'));
			    cuenta = subasignacionSeleccion.data('idcuenta');
			    item = subasignacionSeleccion.data('iditem');
			    asignacion = subasignacionSeleccion.data('idasignacion');
			    subAsignacion = subasignacionSeleccion.data('id');

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenEspecificoGasto';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, cuenta: cuenta, item: item, asignacion: asignacion, subAsignacion: subAsignacion },
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
					            //row = row.concat('\n<th class="text-center table-active"></th>');
				            }else{
					            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2018']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">',data[i]['var_18_17'],'%</p></td>');
					            //row = row.concat('\n<td class="text-center">');
								//row = row.concat('\n<a href="listarReportesEspecifico/?idSubAsignacion=',data[i]['id_sub_asignacion'],'" title="click para ver detalle de Sub asignaci&oacute;n"><i data-feather="search" class="trash"></i></a>');
								//row = row.concat('\n</td>');
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

  	function listarReportesFecha()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucionFecha").val();
	    hospital = $("#hospitalFecha").val();
		cuenta = -1;
	    item = -1;
	    mes = $("#mes").val();
	    anio = $("#anio").val();
		inflactor = ($('#inflactor').val().length == 0 ? -1 : $('#inflactor').val());

	    var baseurl = window.origin + '/Reporte/listarReporteResumenFecha';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, cuenta: cuenta, mes: mes, anio: anio, inflactor: inflactor },
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
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado']),'</p></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
			            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado']),'</p></td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucionFecha").val();
			    hospital = $("#hospitalFecha").val();
				cuenta = -1;
			    item = -1;
			    mes = $("#mes").val();
			    anio = $("#anio").val();
			    inflactor = ($('#inflactor').val().length == 0 ? -1 : $('#inflactor').val());

		    	var baseurl = window.origin + '/Reporte/listarReporteResumenFechaGasto';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, cuenta: cuenta, mes: mes, anio: anio, inflactor: inflactor },
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
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado']),'</p></th>');
				            }else{
					            row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['codigo'],' ', data[i]['nombre'],'</p></td>');
					            row = row.concat('\n<td class="text-center"><p class="texto-pequenio">','----','</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['Recaudado']),'</p></td>');
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

  	function listarReporteResumenGrafico()
  	{ 	
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    institucion = $("#institucion").val();
	    hospital = $("#hospital").val();
	    tipo = 1;
	  

	    var baseurl = window.origin + '/Reporte/listarReporteResumenGrafico';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, tipo: tipo },
		success: function(data) {
	        if (data)
	        {			
				$("#tbodyReporteResumenGrafico").empty();
				for (var i = 0; i < data.length; i++){
		            var row = '';
		            row = row.concat('<tr>');
		            if(data[i]['nivel'] == '1')
		            {
		            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2017']),'</p></th>');
			            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2018']),'</p></th>');
			            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var'],'%</p></th>');
		            }else{
		            	row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2017']),'</p></td>');
			            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2018']),'</p></td>');
			            row = row.concat('\n<td class="text-center table-active"><p class="texto-pequenio">',data[i]['var'],'%</p></td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumenGrafico").append(row);
		        }


		        institucion = $("#institucion").val();
	    		hospital = $("#hospital").val();
	    		tipo = 2;

			    var baseurl = window.origin + '/Reporte/listarReporteResumenGrafico';
			    jQuery.ajax({
				type: "POST",
				url: baseurl,
				dataType: 'json',
				data: {institucion: institucion, hospital: hospital, tipo: tipo },
				success: function(data) {
			        if (data)
			        {			
						$("#tbodyReporteResumen22").empty();
						for (var i = 0; i < data.length; i++){
				            var row = '';
				            row = row.concat('<tr>');
				            if(data[i]['nivel'] == '1')
				            {
				            	row = row.concat('\n<th class="table-active"><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2017']),'</p></th>');
					            row = row.concat('\n<th class="text-right table-active"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2018']),'</p></th>');
					            row = row.concat('\n<th class="text-center table-active"><p class="texto-pequenio">',data[i]['var'],'%</p></th>');
				            }else{
				            	row = row.concat('\n<td class=""><p class="texto-pequenio">',data[i]['nombre'],'</p></th>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2017']),'</p></td>');
					            row = row.concat('\n<td class="text-right"><p class="texto-pequenio">$ ',formatNumber(data[i]['total_2018']),'</p></td>');
					            row = row.concat('\n<td class="text-center table-active"><p class="texto-pequenio">',data[i]['var'],'%</p></td>');
				            }
				            row = row.concat('\n</tr>');
				          $("#tbodyReporteResumen22").append(row);
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

  	$('#tReporteResumen,#tReporteResumenGasto,#botones').on('click', '.redireccionarSubtitulo', function(e) {
  	//$('.redireccionarSubtitulo').on('click', function(e) {
  		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');
    	//var idCuenta = e.currentTarget.dataset.id;

    	idInstitucion = "";
    	idArea = "";
    	idCuenta = "";

    	if (e.currentTarget.className.indexOf('botonTabla', 0) > 0) {
	    	var url = window.location.href.split("?")[0].replace("ListarReportes", "ListarReportesItem");
	    	idInstitucion = $("#institucion").val();
	    	idArea = $("#hospital").val();
	    	idCuenta = e.currentTarget.dataset.id;
		}else
    	{
    		var url = window.location.href.split("?")[0].replace("ListarReportesItem", "ListarReportes");
    		idInstitucion = $("#institucionItem").val();
	    	idArea = $("#hospitalItem").val();
		}

	    if(idInstitucion > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idInstitucion=', idInstitucion);
	    	else
	    		url = url.concat('?idInstitucion=', idInstitucion);

	    if(idArea > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idArea=', idArea);
	    	else
	    		url = url.concat('?idArea=', idArea);

	    if(idCuenta != "")
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idCuenta=', idCuenta);
	    	else
	    		url = url.concat('?idCuenta=', idCuenta);   

	    window.location.href = url;
	});

	$('#tReporteResumen,#tReporteResumenGasto,#botones').on('click', '.redireccionarItem', function(e) {
  	//$('.redireccionarItem').click(function() {
  		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');
    	var idCuenta = "";
    	var idInstitucion = "";
    	var idArea = "";

    	if (e.currentTarget.className.indexOf('botonTabla', 0) > 0) {
    		var url = window.location.href.split("?")[0].replace("ListarReportes", "ListarReportesItem");
    		idInstitucion = $("#institucion").val();
    		idArea = $("#hospital").val();
    		idCuenta = e.currentTarget.dataset.id;    		
    	}else
    	{
    		var url = window.location.href.split("?")[0].replace("ListarReportesAsignacion", "ListarReportesItem");
    		idInstitucion = $("#institucionAsignacion").val();
    		idArea = $("#hospitalAsignacion").val();
    		idCuenta = $('#itemSeleccion').data('idcuenta');
		}

	    if(idInstitucion > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idInstitucion=', idInstitucion);
	    	else
	    		url = url.concat('?idInstitucion=', idInstitucion);

	    if(idArea > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idArea=', idArea);
	    	else
	    		url = url.concat('?idArea=', idArea);

	    if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idCuenta=', idCuenta);
	    	else
	    		url = url.concat('?idCuenta=', idCuenta);

	    window.location.href = url;
	});

	$('#tReporteResumen,#tReporteResumenGasto,#botones').on('click', '.redireccionarAsignacion', function(e) {
  	//$('.redireccionarAsignacion').on('click', function(e) {
  		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');

    	var idInstitucion = "";
    	var idArea = "";
    	var idCuenta = "";
    	var idItem = "";

    	if (e.currentTarget.className.indexOf('botonTabla', 0) > 0) {
    		var url = window.location.href.split("?")[0].replace("ListarReportesItem", "ListarReportesAsignacion");
    		idInstitucion = $("#institucionItem").val();
	    	idArea = $("#hospitalItem").val();
	    	idCuenta = $("#cuentaSeleccion").data('id');
	    	idItem = (e.currentTarget.dataset.id == "" ? null : e.currentTarget.dataset.id);
    	}else
    	{
    		var url = window.location.href.split("?")[0].replace("ListarReportesSubAsignacion", "ListarReportesAsignacion");
    		idInstitucion = $("#institucionSubAsignacion").val();
	    	idArea = $("#hospitalSubAsignacion").val();
	    	idCuenta = $("#asignacionSeleccion").data('idcuenta');
	    	idItem = $("#asignacionSeleccion").data('iditem');
    	}

	    if(idInstitucion > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idInstitucion=', idInstitucion);
	    	else
	    		url = url.concat('?idInstitucion=', idInstitucion);

	    if(idArea > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idArea=', idArea);
	    	else
	    		url = url.concat('?idArea=', idArea);

    	if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idCuenta=', idCuenta);
    	else
    		url = url.concat('?idCuenta=', idCuenta);

    	
    	if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idItem=', idItem);
    	else
    		url = url.concat('?idItem=', idItem);

	    window.location.href = url;
	});

	$('#tReporteResumen,#tReporteResumenGasto,#botones').on('click', '.redireccionarSubAsignacion', function(e) {
	//$('.redireccionarSubAsignacion').on('click', function(e) {
  		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');
    	
    	var idInstitucion = "";
    	var idArea = "";
    	var idCuenta = "";
    	var idItem = "";
    	var idAsignacion = "";

    	if (e.currentTarget.className.indexOf('botonTabla', 0) > 0) {
    		var url = window.location.href.split("?")[0].replace("ListarReportesAsignacion", "ListarReportesSubAsignacion");
    		idInstitucion = $("#institucionAsignacion").val();
	    	idArea = $("#hospitalAsignacion").val();
	    	idCuenta = $("#itemSeleccion").data('idcuenta');
	    	idItem = $("#itemSeleccion").data('id');
	    	idAsignacion = e.currentTarget.dataset.id;
    	}else
    	{
		    var url = window.location.href.split("?")[0].replace("ListarReportesEspecifico", "ListarReportesSubAsignacion");
		    idInstitucion = $("#institucionEspecifico").val();
	    	idArea = $("#hospitalEspecifico").val();
	    	idCuenta = $("#subasignacionSeleccion").data('idcuenta');
	    	idItem = $("#subasignacionSeleccion").data('iditem');
	    	idAsignacion = $("#subasignacionSeleccion").data('idasignacion');
		}

	    if(idInstitucion > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idInstitucion=', idInstitucion);
	    	else
	    		url = url.concat('?idInstitucion=', idInstitucion);

	    if(idArea > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idArea=', idArea);
	    	else
	    		url = url.concat('?idArea=', idArea);
	    
	    if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idCuenta=', idCuenta);
    	else
    		url = url.concat('?idCuenta=', idCuenta);

	    if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idItem=', idItem);
    	else
    		url = url.concat('?idItem=', idItem);

    	if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idAsignacion=', idAsignacion);
    	else
    		url = url.concat('?idAsignacion=', idAsignacion);

	    window.location.href = url;
	});

	$('#tReporteResumen,#tReporteResumenGasto,#botones').on('click', '.redireccionarEspecifico', function(e) {
	//$('.redireccionarEspecifico').on('click', function(e) {
  		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');
    	var idInstitucion = $("#institucionSubAsignacion").val();
    	var idArea = $("#hospitalSubAsignacion").val();
    	var idCuenta = $("#asignacionSeleccion").data('idcuenta');
    	var idItem = $("#asignacionSeleccion").data('iditem');
    	var idAsignacion = $("#asignacionSeleccion").data('id');
    	var idSubAsignacion = e.currentTarget.dataset.id;

    	var url = window.location.href.split("?")[0].replace("ListarReportesSubAsignacion", "ListarReportesEspecifico");

	    if(idInstitucion > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idInstitucion=', idInstitucion);
	    	else
	    		url = url.concat('?idInstitucion=', idInstitucion);

	    if(idArea > 0)
	    	if (url.indexOf('?', 0) > 0)
	    		url = url.concat('&idArea=', idArea);
	    	else
	    		url = url.concat('?idArea=', idArea);

	    if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idCuenta=', idCuenta);
    	else
    		url = url.concat('?idCuenta=', idCuenta);

	    if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idItem=', idItem);
    	else
    		url = url.concat('?idItem=', idItem);

    	if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idAsignacion=', idAsignacion);
    	else
    		url = url.concat('?idAsignacion=', idAsignacion);

    	if (url.indexOf('?', 0) > 0)
    		url = url.concat('&idSubAsignacion=', idSubAsignacion);
    	else
    		url = url.concat('?idSubAsignacion=', idSubAsignacion);

	    window.location.href = url;
	});

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


window.onload = function () {
	cargarGraficos();
}

function cargarGraficos(){
		var institucion = $("#institucion").val();
		var hospital = $("#hospital").val();
		var cuenta = -1;//$("#asignacionSeleccion").data('idcuenta');
		var tipo = 1;

		var baseurl = window.origin + '/Reporte/listarReporteGrafico';
		var dataPointsSub21_2017 = [];
		var dataPointsSub21_2018 = [];
		var dataPointsSub22_2017 = [];
		var dataPointsSub22_2018 = [];
		jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion, hospital: hospital, cuenta: cuenta, tipo :tipo},
		success: function(data) {
			if(data)
			{
				for (var i = 0; i < data.length; i++) {

					if(data[i]["subt"] == "subt1")
					{
						if(data[i]["anio"] == 2017)
						{
							dataPointsSub21_2017.push({
							label: data[i]["nombreMes"],
							y: parseFloat(data[i]["total"]),
							anio: data[i]["anio"]
							});
						}

						if(data[i]["anio"] == 2018)
						{
							dataPointsSub21_2018.push({
							label: data[i]["nombreMes"],
							y: parseFloat(data[i]["total"]),
							anio: data[i]["anio"]
							});
						}
					}else{
						if(data[i]["anio"] == 2017)
						{
							dataPointsSub22_2017.push({
							label: data[i]["nombreMes"],
							y: parseFloat(data[i]["total"]),
							anio: data[i]["anio"]
							});
						}

						if(data[i]["anio"] == 2018)
						{
							dataPointsSub22_2018.push({
							label: data[i]["nombreMes"],
							y: parseFloat(data[i]["total"]),
							anio: data[i]["anio"]
							});
						}
					}
				}

				    var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title:{
						text: "Subt. 21"
					},
					axisY: {
						title: "Vista por M$",
						titleFontColor: "#4F81BC",
						lineColor: "#4F81BC",
						labelFontColor: "#4F81BC",
						tickColor: "#4F81BC",
						valueFormatString: "$ #.###.###"
					},
					axisY2: {
						title: "Vista por M$",
						titleFontColor: "#C0504E",
						lineColor: "#C0504E",
						labelFontColor: "#C0504E",
						tickColor: "#C0504E",
						valueFormatString: "$ #.###.###"
					},	
					toolTip: {
						shared: true
					},
					legend: {
						cursor:"pointer",
						itemclick: toggleDataSeries
					},
					data: [{
						type: "column",
						name: "2017 Subt. 21",
						legendText: "2017 Subt. 21",
						showInLegend: true,
						indexLabel: "${y}",
						//indexLabelFontWeight: "bold",
						indexLabelPlacement: "inside",
						indexLabelOrientation: "vertical",
						indexLabelFontColor: "#ffffff",
						indexLabelFontSize: 11,
						toolTipContent: "<span style='\"'color: #4F81BC;'\"'>{anio}:<strong>${y}</strong></span>",
						dataPoints: dataPointsSub21_2017
					},
					{
						type: "column",	
						name: "2018 Subt. 21",
						axisYType: "secondary",
						legendText: "2018 Subt. 21",
						showInLegend: true,
						indexLabel: "${y}",
						//indexLabelFontWeight: "bold",
						indexLabelPlacement: "inside",
						indexLabelOrientation: "vertical",
						indexLabelFontColor: "#ffffff",
						indexLabelFontSize: 11,
						toolTipContent: "<span style='\"'color: #C0504E;'\"'>{anio}:<strong>${y}</strong></span>",
						dataPoints: dataPointsSub21_2018
					}]
				});


				
				var chart2 = new CanvasJS.Chart("chartContainer2", {
					animationEnabled: true,
					title:{
						text: "Subt. 22"
					},
					axisY: {
						title: "Vista por M$",
						titleFontColor: "#4F81BC",
						lineColor: "#4F81BC",
						labelFontColor: "#4F81BC",
						tickColor: "#4F81BC",
						valueFormatString: "$ #.###.###"
					},
					axisY2: {
						title: "Vista por M$",
						titleFontColor: "#C0504E",
						lineColor: "#C0504E",
						labelFontColor: "#C0504E",
						tickColor: "#C0504E",
						valueFormatString: "$ #.###.###"
					},	
					toolTip: {
						shared: true
					},
					legend: {
						cursor:"pointer",
						itemclick: toggleDataSeries
					},
					data: [{
						type: "column",
						name: "2017 Subt. 22",
						legendText: "2017 Subt. 22",
						showInLegend: true,
						indexLabel: "${y}",
						//indexLabelFontWeight: "bold",
						indexLabelPlacement: "inside",
						indexLabelOrientation: "vertical",
						indexLabelFontColor: "#ffffff",
						indexLabelFontSize: 11,
						toolTipContent: "<span style='\"'color: #4F81BC;'\"'>{anio}:<strong>${y}</strong></span>",
						dataPoints: dataPointsSub22_2017
					},
					{
						type: "column",	
						name: "2018 Subt. 22",
						axisYType: "secondary",
						legendText: "2018 Subt. 22",
						showInLegend: true,
						indexLabel: "${y}",
						//indexLabelFontWeight: "bold",
						indexLabelPlacement: "inside",
						indexLabelOrientation: "vertical",
						indexLabelFontColor: "#ffffff",
						indexLabelFontSize: 11,
						toolTipContent: "<span style='\"'color: #C0504E;'\"'>{anio}:<strong>${y}</strong></span>",
						dataPoints: dataPointsSub22_2018
					}]
				});

				chart.render();
				chart2.render();

					
				function toggleDataSeries(e) {
					if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					}
					else {
						e.dataSeries.visible = true;
					}
					chart.render();
					chart2.render();
				}
			}
		}
		});
	};

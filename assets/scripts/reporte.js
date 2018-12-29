 $(document).ready(function() {

	$("#institucion").change(function() {
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');

	    institucion = $("#institucion").val();
	    hospital = $("#hospital").val();
	    cuenta = $("#cuenta").val();
	    item = $("#item").val();

	    var baseurl = window.origin + '/minsal/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitales").empty();
				var row = '<option value="-1">Seleccione un Hospital</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitales").append(row);
	        }
      	}
    	});

	    var baseurl = window.origin + '/minsal/Reporte/listarReporteResumen';
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
		            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
		            }else{
		            	row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
			            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucion").val();
			    hospital = $("#hospital").val();
			    cuenta = $("#cuenta").val();
			    item = $("#item").val();

		    	var baseurl = window.origin + '/minsal/Reporte/listarReporteResumenGasto';
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
				            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
				            }else{
					            row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
					            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
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

  	});

 	$("#hospital").change(function() {
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');

	    institucion = $("#institucion").val();
	    hospital = $("#hospital").val();
	    cuenta = $("#cuenta").val();
	    item = $("#item").val();

	    var baseurl = window.origin + '/minsal/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitales").empty();
				var row = '<option value="-1">Seleccione un Hospital</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitales").append(row);
	        }
      	}
    	});

	    var baseurl = window.origin + '/minsal/Reporte/listarReporteResumen';
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
		            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
		            }else{
		            	row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
			            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucion").val();
			    hospital = $("#hospital").val();
			    cuenta = $("#cuenta").val();
			    item = $("#item").val();

		    	var baseurl = window.origin + '/minsal/Reporte/listarReporteResumenGasto';
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
				            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
				            }else{
					            row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
					            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
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

  	});

 	$("#cuenta").change(function() {
 		var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');

	    institucion = $("#institucion").val();
	    hospital = $("#hospital").val();
	    cuenta = $("#cuenta").val();
	    item = $("#item").val();

	    var baseurl = window.origin + '/minsal/Reporte/listarHospitalesInstitucion';
	    jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {institucion: institucion },
		success: function(data) {
	        if (data)
	        {			
				$("#hospitales").empty();
				var row = '<option value="-1">Seleccione un Hospital</option>';
				for (var i = 0; i < data.length; i++) {
					row = row.concat('\n<option value="',data[i]["id_hospital"],'">',data[i]["nombre"], '</option>');
				}
				$("#hospitales").append(row);
	        }
      	}
    	});

	    var baseurl = window.origin + '/minsal/Reporte/listarReporteResumen';
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
		            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">','----','</th>');
			            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
			            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
		            }else{
		            	row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
			            row = row.concat('\n<td class="text-center">','----','</td>');
			            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
			            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
		            }
		            row = row.concat('\n<tr>');
		          $("#tbodyReporteResumen").append(row);
		        }


		        institucion = $("#institucion").val();
			    hospital = $("#hospital").val();
			    cuenta = $("#cuenta").val();
			    item = $("#item").val();

		    	var baseurl = window.origin + '/minsal/Reporte/listarReporteResumenGasto';
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
				            	row = row.concat('\n<th class="table-active">',data[i]['nombre'],'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2018']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">','----','</th>');
					            row = row.concat('\n<th class="text-right table-active">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</th>');
					            row = row.concat('\n<th class="text-center table-active">',data[i]['var_18_17'],'</th>');
				            }else{
					            row = row.concat('\n<td class="">',data[i]['codigo'],' ', data[i]['nombre'],'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n<td class="text-right">$ ',formatNumber(data[i]['Recaudado_2018']),'</td>');
					            row = row.concat('\n<td class="text-center">','----','</td>');
					            row = row.concat('\n <td class="text-right">$ ',formatNumber(data[i]['Recaudado_2017_con_mult']),'</td>');
					            row = row.concat('\n<td class="text-center">',data[i]['var_18_17'],'</td>');
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

  	});


	function formatNumber (n) {
		n = String(n).replace(/\D/g, "");
	  return n === '' ? n : Number(n).toLocaleString();
	}
	number.addEventListener('keyup', (e) => {
		const element = e.target;
		const value = element.value;
	  element.value = formatNumber(value);
	});
});
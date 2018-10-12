 $(document).ready(function() {

 	$("#btnAgregarEvaluacion").on('click', function(e) {
 		var listaPreguntas = document.getElementById('listaPreguntas');
 		//var observacionesEvaluacion = $('#observacionEvaluacion').val();
 		var idGrabacion = 17610;
 		var observacionesEvaluacion = $('#observacionEvaluacion').val();
 		var preguntasEvaluacion = [];
 		var idEvaluacion = null;

	 	if($("#inputIdEvaluacion").val())
	        idEvaluacion = $('#inputIdEvaluacion').val();

 		for (var i = 0; i < listaPreguntas.childElementCount; i++){
 			var pregunta = [];
			var fila = listaPreguntas.children[i];
			var idPregunta = 0;
			var respuesta = false;
			var idPlaCatPre = 0;

			if(fila.children.length > 1)
			{	
				idPlaCatPre = fila.dataset.idplacatpre;
				var fila = listaPreguntas.children[i];
				var idPregunta = 0;
				var respuesta = false;
				var numPregunta = fila.children[0].innerText;
				var respuestaSi = fila.children[2].children[0];
				var respuestaNo = fila.children[3].children[0];

				if(!respuestaNo.checked && !respuestaSi.checked)
				{
					alert('Debe responder la pregunta ' + numPregunta);
					return;
					break;
				}else{
					pregunta['idplacatpre'] = idPlaCatPre;
					var respuestaPregunta = (respuestaSi.checked ? 1 : 2);
					var preguntaRespuesta = (idPlaCatPre + ',' + respuestaPregunta);
					preguntasEvaluacion.push(preguntaRespuesta);
				}
			}
		}

		//preguntas = [preguntas];
 		event.preventDefault();
		var baseurl = (window.origin + '/Evaluacion/guardarEvaluacion');
		jQuery.ajax({
		type: "POST",
		url: baseurl,
		dataType: 'json',
		data: {idEvaluacion: idEvaluacion, idGrabacion: idGrabacion, observacionesEvaluacion: observacionesEvaluacion, preguntasEvaluacion: preguntasEvaluacion },
		success: function(data) {
			if (data)
			{
				if(data['respuesta'] == '1')
	            {
	              $('#tituloME').empty();
	              $("#parrafoME").empty();
	              $("#tituloME").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
	              $("#parrafoME").append(data['mensaje']);
	              
	              /*if(!$("#inputIdEvaluacion").val())
	              {
	                //$("#agregarEvaluacion")[0].reset();
	                //$('#categorias').empty();
	                //document.getElementById('agregarEvaluacion').dataset.categorias = null;
	                //document.getElementById('agregarEvaluacion').dataset.idplantilla = null;

	              }*/
	              loader.setAttribute('hidden', '');
	              $('#modalMensajeEvaluacion').modal({
	                show: true
	              });

				}
			}
		}
		});
   	});

 	$("#gestionEvaluacion").change(function() {
    idRango= $("#gestionEvaluacion").val();
    var baseurl = window.origin + '/Evaluacion/listarEvaluaciones';
    jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {rango: idRango},
      success: function(data) {
        if (data)
        {
          $("#tbodyEAC").empty();
          for (var i = 0; i < data.length; i++){
            var row = '<tr>';
            row = row.concat('\n<th scope="row" class="text-center align-middle">'+data[i]['cod_usuario']+'</th>');
            row = row.concat('\n<td class="text-center align-middle">'+data[i]['eac']+'</td>');

            for (var c = 1; c <=  data[0]['cant_campanias']; c++) {
            row = row.concat('\n<td class="text-center align-middle">\n<a href="AgregarEvaluacion/?idEAC='+data[i]['id_usu']+'&idCamp='+data[i][('id_camp_'+c)]+'" class="badge badge-pill ');
            if(data[i][('cant_eval_'+c)] == 0)
            {
              row = row.concat('badge-danger">'+data[i][('cant_eval_'+c)]+'   /   '+data[i][('total_eac_'+c)]); 
            }else
              if(data[i][('cant_eval_'+c)] > 0 && data[i][('cant_eval_'+c)] < data[i][('total_eac_'+c)])
              {
                 row = row.concat('badge-warning">'+data[i][('cant_eval_'+c)]+'   /   '+data[i][('total_eac_'+c)]);
              }else{
                row = row.concat('badge-success">'+data[i][('cant_eval_'+c)]+'   /   '+data[i][('total_eac_'+c)]);
              }
            }
            row = row.concat('</a>\n</td>');
            row = row.concat('\n<tr>');

            $("#tbodyEAC").append(row);
          }
        }
      }
    });
  	});



  	$("#btnCambiarGrabacion").on('click', function(e) {
	    var loader = document.getElementById("loader");
	    loader.removeAttribute('hidden');
	    /*$("div.loader").addClass('show');*/
	    var botonGrabacion = document.getElementById("btnCambiarGrabacion");
	    var idEAC = botonGrabacion.dataset.ideac;
	    var idCampania = botonGrabacion.dataset.idcampania;

     	var baseurl = window.origin + '/Evaluacion/listarGrabacionesUsu';

	    jQuery.ajax({
	    type: "POST",
	    url: baseurl,
	    dataType: 'json',
	    data: {idEAC: idEAC, idCampania, idCampania},
	    success: function(data) {
	      if (data.length > 0)
	      {
	         var idLlamada = $(document.getElementById('idLlamada')).text();
	    	 $("#listaGrabaciones").empty();
         	  var row = '';
			  row = row.concat('<li class="list-group-item text-center">');
			  row = row.concat('<div class="row">');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span class="font-weight-bold">ID Llamada</span>');
			  row = row.concat('</div>');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span class="font-weight-bold">Fecha</span>');
			  row = row.concat('</div>');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span class="font-weight-bold">Duraci&oacute;n Min.</span>');
			  row = row.concat('</div>');
			  row = row.concat('</div>');
			  row = row.concat('</li>');
          for (var i = 0; i < data.length; i++){
			  row = row.concat('<li class="list-group-item list-group-item-action text-center ', ((data[i]['idllamada'] == idLlamada)?'active show':''),'" data-toggle="tab" data-ruta="',data[i]['Grabacion'],'" data-idllamada="',data[i]['idllamada'],'" data-fecha="',data[i]['Inicio'],'" >');
			  row = row.concat('<div class="row" >');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span>',data[i]['idllamada'],'</span>');
			  row = row.concat('</div>');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span>',data[i]['Inicio'],'</span>');
			  row = row.concat('</div>');
			  row = row.concat('<div class="col-sm">');
			  row = row.concat('<span>',data[i]['DuracionMinutos'],'</span>');
			  row = row.concat('</div>');
			  row = row.concat('</div>');
			  row = row.concat('</li>');	          
        	}
        	$("#listaGrabaciones").append(row);
        	loader.setAttribute('hidden', '');
            $('#modalCambiarGrabacion').modal({
              show: true
            });
	        feather.replace()
      }
  }
      });
  });


	$('#listaGrabaciones').on('shown.bs.tab', function(event){
	    var grabacionSeleccionada = $(event.target);         // active tab
	    $(document.getElementsByClassName('active show')).removeClass("active show");
	    $(grabacionSeleccionada).addClass("active show");
	});

	$('#cambiarGrabacion').on('click', function(event){
	    var grabacion = $(document.getElementsByClassName('active show'));
	    if(grabacion.length > 0)
	    {
	    	var idLlamada = grabacion.data('idllamada');
	    	var ruta = grabacion.data('ruta');
	    	var fecha = grabacion.data('fecha');
			$(document.getElementById('idLlamada')).text(idLlamada);
	    	$(document.getElementById('fecha')).text(fecha);	    	
	    	var url = document.getElementById('grabacion').currentSrc.substr(0, document.getElementById('grabacion').currentSrc.lastIndexOf('grabaciones/') + 12) + ruta;
	    	document.getElementById('grabacion').setAttribute('src', url);
	    	$('#modalCambiarGrabacion').modal('hide');
	    }

	});
	

});
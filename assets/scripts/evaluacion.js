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



});
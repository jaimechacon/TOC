 $(document).ready(function() {

	$('#modalMensajeEvaluacion').on('hidden.bs.modal', function(e) {
	     //$(document.getElementById('volverEvaluacion')).click();
		var loader = document.getElementById("loader");
    	loader.removeAttribute('hidden');
	    var url = window.location.href.split("?")[0].replace("AgregarEvaluacion/", "EvaluarUsuarios");	    
	    window.location.href = url;

	    //var ruta = window.location.href.replace("AgregarEvaluacion", "EvaluarUsuarios");
	    //var url = ruta + 'Evaluacion/ListarEvaluaciones?idCampania=' + e.dataPoint.idCampania + '&idEAC='+e.dataPoint.id_usuario;
	    //$.redirectPost(window.location.href.replace("Inicio", url), {idCampania: e.dataPoint.idCampania, idEAC: e.dataPoint.id_usuario});
	    //window.location.href = url;
	     //window.location.replace("Evaluacion/EvaluarUsuarios");
 	});

 	$("#btnAgregarEvaluacion").on('click', function(e) {
 		$(document.getElementById('btnAgregarEvaluacion')).attr('disabled', 'disabled');
 		var loader = document.getElementById("loader");
 		loader.removeAttribute('hidden');
 		var listaPreguntas = document.getElementById('listaPreguntas');
 		//var observacionesEvaluacion = $('#observacionEvaluacion').val();

 		var grabacion = $(document.getElementById('grabacion'));
 		var duracionSegundos = grabacion.data('duracionseg');
 		var duracionMinutos = grabacion.data('duracionmin');
 		var idLlamada = $(document.getElementById('idLlamada')).text();
 		var nombreGrabacion = grabacion.data('grabacion');
 		var observacionesEvaluacion = $('#observacionEvaluacion').val();
 		var preguntasEvaluacion = [];
 		var idEvaluacion = null;
 		var botonGrabacion = document.getElementById("btnCambiarGrabacion");
	    var idEAC = botonGrabacion.dataset.ideac;
	    var idCampania = botonGrabacion.dataset.idcampania;
	    var idUsuResp = null;
	    if(document.getElementById('idUsuResp').dataset.idusuresp > 0)
          idUsuResp = document.getElementById('idUsuResp').dataset.idusuresp;

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
		data: {idEvaluacion: idEvaluacion, idEAC: idEAC, idCampania: idCampania, idLlamada: idLlamada, nombreGrabacion: nombreGrabacion, duracionSegundos: duracionSegundos, duracionMinutos: duracionMinutos,/*idGrabacion: idGrabacion,*/ observacionesEvaluacion: observacionesEvaluacion, preguntasEvaluacion: preguntasEvaluacion, idUsuResp: idUsuResp},
		success: function(data) {
			if (data)
			{
				if(data['respuesta'] && parseInt(data['respuesta']) > 0)
	            {
	              $('#tituloME').empty();
	              $("#parrafoME").empty();
	              $("#tituloME").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
	              $("#parrafoME").append(data['mensaje']);
	              $(document.getElementById('btnAgregarEvaluacion')).removeAttr('disabled');
	              if(!$("#inputIdEvaluacion").val())
	              {
	                //$("#agregarEvaluacion")[0].reset();
	                //$('#categorias').empty();
	                //document.getElementById('agregarEvaluacion').dataset.categorias = null;
	                //document.getElementById('agregarEvaluacion').dataset.idplantilla = null;

	              }
	              loader.setAttribute('hidden', '');
	              $('#modalMensajeEvaluacion').modal({
	                show: true,
	                backdrop: 'static',
	                keyboard: false
	              });

				}
			}
		}
		});
   	});

 	$("#gestionEvaluacion").change(function() {
    idRango= $("#gestionEvaluacion").val();
    idUsuarioAnalista = $("#selectAnalistas").val();
    //idRango= $("#gestionEvaluacion").val();

    var baseurl = window.origin + '/Evaluacion/listarGestionesUsuario';
    jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {rango: idRango, idUsuarioAnalista: idUsuarioAnalista },
      success: function(data) {
        if (data)
        {

          if($('#tEvaluacionesPendientes').length == 0)
          {
          	var tabla = '<table id="tEvaluacionesPendientes" class="table table-sm table-hover ">\n';
			tabla = tabla.concat('<thead>\n');
			tabla = tabla.concat('<tr>\n');
			tabla = tabla.concat('<th scope="col" class="text-center align-middle">ID EAC</th>\n');
			tabla = tabla.concat('<th scope="col" class="text-left align-middle">Nombre EAC</th>\n');
			      
	      	for (var t=0; t < data[0]['cant_campanias']; t++) { 
	      		tabla = tabla.concat('<th scope="col" class="text-center align-middle">',data[0][('nombre_camp_'+t)],'</th>\n');
	      	}
		    tabla = tabla.concat('</tr>\n');
			tabla = tabla.concat('</thead>\n');
			tabla = tabla.concat('<tbody id="tbodyEvaluaciones">\n');
			tabla = tabla.concat('</tbody>\n');
			tabla = tabla.concat('</table>\n');
          	$("#dvTResponsive").append(tabla);
          }

          $("#tbodyEvaluaciones").empty();
          for (var i = 0; i < data.length; i++){
            var row = '<tr>';
            row = row.concat('\n<th scope="row" class="text-center align-middle">'+data[i]['cod_usuario']+'</th>');
            row = row.concat('\n<td class="text-left align-middle">'+data[i]['eac']+'</td>');

            for (var c = 0; c <  data[0]['cant_campanias']; c++) {
	            row = row.concat('\n<td class="text-center align-middle">');

	            if(data[i][('tiene_grabaciones_'+c)] == "1" && data[i][('se_gestiona_'+c)] == "1")
	      		{	
		            row = row.concat('\n<a href="AgregarEvaluacion/?idEAC='+data[i]['cod_usuario']+'&idCamp='+data[i][('id_camp_'+c)]+'&codCamp='+data[i][('cod_camp_'+c)]+'&idUsuResp='+data[i]['id_usuario_responsable']+'" class="badge badge-pill ');

		            if(data[i][('cant_evaluaciones_'+c)] == "0")
		            {
		              row = row.concat('badge-danger">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]); 
		            }else
		            {
		              if(parseInt(data[i][('cant_evaluaciones_'+c)]) > 0 && parseInt(data[i][('cant_evaluaciones_'+c)]) < parseInt(data[i][('total_gestionar_'+c)]))
		              {
		                 row = row.concat('badge-warning">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]);
		              }else{
		                row = row.concat('badge-success">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]);
		              }
		            }
		            row = row.concat('</a>');
		        }else
		        {
		        	if(data[i][('se_gestiona_'+c)] == "1")
	      			{
	      				row = row.concat('<i data-feather="phone-off" class="telefono_gestiones"></i>');
	      			}
		        }
		        row = row.concat('\n</td>');
        	}

            row = row.concat('\n</tr>');
            $("#tbodyEvaluaciones").append(row);
          }
          feather.replace()
        }
      }
    });
  	});



  	$("#selectAnalistas").change(function() {
    idRango= $("#gestionEvaluacion").val();
    idUsuarioAnalista = $("#selectAnalistas").val();

    var baseurl = window.origin + '/Evaluacion/listarGestionesUsuario';
    jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {rango: idRango, idUsuarioAnalista: idUsuarioAnalista },
      success: function(data) {
        if (data)
        {
        	if(data[0]['resultado'] == "1")
        	{
        		if($('#tEvaluacionesPendientes').length == 0)
				{
					var tabla = '<table id="tEvaluacionesPendientes" class="table table-sm table-hover ">\n';
					tabla = tabla.concat('<thead>\n');
					tabla = tabla.concat('<tr>\n');
					tabla = tabla.concat('<th scope="col" class="text-center align-middle">ID EAC</th>\n');
					tabla = tabla.concat('<th scope="col" class="text-left align-middle">Nombre EAC</th>\n');
				      
					for (var t=0; t < data[0]['cant_campanias']; t++) { 
						tabla = tabla.concat('<th scope="col" class="text-center align-middle">',data[0][('nombre_camp_'+t)],'</th>\n');
					}
					tabla = tabla.concat('</tr>\n');
					tabla = tabla.concat('</thead>\n');
					tabla = tabla.concat('<tbody id="tbodyEvaluaciones">\n');
					tabla = tabla.concat('</tbody>\n');
					tabla = tabla.concat('</table>\n');
					$("#dvTResponsive").append(tabla);
				}

				$("#tbodyEvaluaciones").empty();
				for (var i = 0; i < data.length; i++){
					var row = '<tr>';
					row = row.concat('\n<th scope="row" class="text-center align-middle">'+data[i]['cod_usuario']+'</th>');
					row = row.concat('\n<td class="text-left align-middle">'+data[i]['eac']+'</td>');

					for (var c = 0; c <  data[0]['cant_campanias']; c++) {
					    row = row.concat('\n<td class="text-center align-middle">');

					    if(data[i][('tiene_grabaciones_'+c)] == "1" && data[i][('se_gestiona_'+c)] == "1")
							{	
					        row = row.concat('\n<a href="AgregarEvaluacion/?idEAC='+data[i]['cod_usuario']+'&idCamp='+data[i][('id_camp_'+c)]+'&codCamp='+data[i][('cod_camp_'+c)]+'&idUsuResp='+data[i]['id_usuario_responsable']+'" class="badge badge-pill ');

					        if(data[i][('cant_evaluaciones_'+c)] == "0")
					        {
					          row = row.concat('badge-danger">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]); 
					        }else
					        {
					          if(parseInt(data[i][('cant_evaluaciones_'+c)]) > 0 && parseInt(data[i][('cant_evaluaciones_'+c)]) < parseInt(data[i][('total_gestionar_'+c)]))
					          {
					             row = row.concat('badge-warning">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]);
					          }else{
					            row = row.concat('badge-success">'+data[i][('cant_evaluaciones_'+c)]+'   /   '+data[i][('total_gestionar_'+c)]);
					          }
					        }
					        row = row.concat('</a>');
					    }else
					    {
					    	if(data[i][('se_gestiona_'+c)] == "1")
								{
									row = row.concat('<i data-feather="phone-off" class="telefono_gestiones"></i>');
								}
					    }
					    row = row.concat('\n</td>');
					}

					row = row.concat('\n</tr>');
					$("#tbodyEvaluaciones").append(row);
				}
        	}else
			{
				$("#dvTResponsive").empty();
			}
          
          feather.replace()
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
	    var codCampania = botonGrabacion.dataset.codcampania;

     	var baseurl = window.origin + '/Evaluacion/listarGrabacionesUsu';

	    jQuery.ajax({
	    type: "POST",
	    url: baseurl,
	    dataType: 'json',
	    data: {idEAC: idEAC, codCampania, codCampania},
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
			  row = row.concat('<li class="list-group-item list-group-item-action text-center ', ((data[i]['idllamada'] == idLlamada)?'active show':''),'" data-toggle="tab" data-ruta="',data[i]['Grabacion'],'" data-idllamada="',data[i]['idllamada'],'" data-fecha="',data[i]['Inicio'],'" data-duracionseg="',data[i]['DuracionSegundo'],'" data-duracionmin="',data[i]['DuracionMinutos'],'" >');
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

            $(".pauta").prop("checked", false);
            $(document.getElementById('puntaje')).text("0 %");
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
	    	var DuracionSegundo = grabacion.data('duracionseg');
	    	var DuracionMinutos = grabacion.data('duracionmin');
			$(document.getElementById('idLlamada')).text(idLlamada);
	    	$(document.getElementById('fecha')).text(fecha);
	    	var url = document.getElementById('grabacion').currentSrc.substr(0, document.getElementById('grabacion').currentSrc.lastIndexOf('grabaciones/') + 12) + ruta;
	    	document.getElementById('grabacion').setAttribute('src', url);
			document.getElementById('grabacion').setAttribute('data-duracionseg', DuracionSegundo);
			document.getElementById('grabacion').setAttribute('data-duracionmin', DuracionMinutos);
			document.getElementById('grabacion').setAttribute('data-grabacion', ruta);
	    	$('#modalCambiarGrabacion').modal('hide');
	    }

	});

	$('#listaPreguntas').on('click', '.pauta', function(e) {
		var r=1;
		var idplacatpre = $(e.currentTarget).parents()[1].dataset.idplacatpre;
		var puntaje_pre = 0;
		if(e.currentTarget.dataset.puntuacioncat != "" && e.currentTarget.dataset.puntuacioncat != null)
			puntaje_pre = parseFloat(Math.round(e.currentTarget.dataset.puntuacioncat));
		var puntaje_actual = 0;
		var puntaje_total = parseFloat(Math.round(document.getElementById('puntaje').dataset.puntajetotal));

		var tListaPreguntas = document.getElementById("listaPreguntas");
        while(row=tListaPreguntas.rows[r++])
		{
			if(row.dataset.idplacatpre != "" && row.dataset.idplacatpre != null && row.dataset.idplacatpre != idplacatpre)
			{        
			  if(row.cells[2].children[0].checked)
			  {
			   	puntaje_actual = (puntaje_actual + parseFloat(Math.round(row.cells[2].children[0].dataset.puntuacioncat)));
			  }
			}
		}

		puntaje_actual = puntaje_actual + puntaje_pre;
		var total = parseFloat(Math.round(puntaje_actual * 100)/puntaje_total).toFixed(2);
		$(document.getElementById('puntaje')).text(total + " %");

      /*idEAC = $(e.currentTarget).data('idusuario');
      checked = null;
      if(idEAC != null)
        checked = ($(this).is(':checked') ? true : false);
	  
      var eacs = [];
      if(document.getElementById('tablaEAC').dataset.eac.split(',').length > 0 && document.getElementById('tablaEAC').dataset.eac.split(',') != "")
        if(document.getElementById('tablaEAC').dataset.eac.split(',').length == 1)
          eacs = [document.getElementById('tablaEAC').dataset.eac];
        else
          eacs = document.getElementById('tablaEAC').dataset.eac.split(',');

      var indiceEAC = eacs.indexOf(idEAC.toString());
      if(indiceEAC != -1)
      {
        if(!checked)
          eacs.splice(indiceEAC, 1);
      }else
        if(checked)
          eacs.push([idEAC]);
      document.getElementById('tablaEAC').dataset.eac = eacs;*/
     
  });


$('#analistas').on('change',function(e){
    analista = null;
    campania = null;
    eac = null;

    if($('#analistas').val().length > 0 && $('#analistas').val() != -1)
       analista = $('#analistas').val(); 

    if($('#campanias').val().length > 0 && $('#campanias').val() != -1)
   		campania = $('#campanias').val();

	  if($('#eacs').val().length > 0 && $('#eacs').val() != -1)
   		eac = $('#eacs').val();

   	if(campania)
   		$(document.getElementById('campanias')).attr('disabled', 'disabled');

   	if(eac)
   		$(document.getElementById('eacs')).attr('disabled', 'disabled');


   	if (!analista)
   	{
   		document.getElementById('analistas').dataset.num = "";
   		if(document.getElementById('campanias').dataset.num == 2)
   			$(document.getElementById('campanias')).removeAttr('disabled');
   		else
	   		if(document.getElementById('eacs').dataset.num == 2)
	   			$(document.getElementById('eacs')).removeAttr('disabled');
	   		else
	   			if($("#campanias").data('num') == 1)
		   			$(document.getElementById('campanias')).removeAttr('disabled');
		   		else
			   		if(document.getElementById('eacs').dataset.num == 1)
			   			$(document.getElementById('eacs')).removeAttr('disabled');			   		
   	}
	else
	   	if(campania && eac)
	   		document.getElementById('analistas').dataset.num = 3;
	   	else
	   		if(campania) 
	   			document.getElementById('analistas').dataset.num = 2;
	   		else
	   			if(eac) 
		   			document.getElementById('analistas').dataset.num = 2;
		   		else
		   			document.getElementById('analistas').dataset.num = 1;

    listarEvaluaciones(analista, campania, eac);
});

$('#campanias').on('change',function(e){
    analista = null;
    campania = null;
    eac = null;

    if($('#analistas').val().length > 0 && $('#analistas').val() != -1)
       analista = $('#analistas').val();

    if($('#campanias').val().length > 0 && $('#campanias').val() != -1)
   		campania = $('#campanias').val();


  if($('#eacs').val().length > 0 && $('#eacs').val() != -1)
   		eac = $('#eacs').val();

   	if(analista)
   		$(document.getElementById('analistas')).attr('disabled', 'disabled');

   	if(eac)
   		$(document.getElementById('eacs')).attr('disabled', 'disabled');

	if (!campania)
	{
   		document.getElementById('campanias').dataset.num = "";
	   	if(document.getElementById('analistas').dataset.num == 2)
	   			$(document.getElementById('analistas')).removeAttr('disabled');
	   		else
		   		if(document.getElementById('eacs').dataset.num == 2)
		   			$(document.getElementById('eacs')).removeAttr('disabled');
		   		else
		   			if(document.getElementById('analistas').dataset.num == 1)
			   			$(document.getElementById('analistas')).removeAttr('disabled');
			   		else
				   		if(document.getElementById('eacs').dataset.num == 1)
				   			$(document.getElementById('eacs')).removeAttr('disabled');
   	}
	else
	   	if(analista && eac)
	   		document.getElementById('campanias').dataset.num = 3;
	   	else
	   		if(eac) 
	   			document.getElementById('campanias').dataset.num = 2;	
	   		else
	   			if(analista) 
	   				document.getElementById('campanias').dataset.num = 2;
		   		else
		   			document.getElementById('campanias').dataset.num = 1;

    listarEvaluaciones(analista, campania, eac);
});


$('#eacs').on('change',function(e){
    analista = null;
    campania = null;
    eac = null;

    if($('#analistas').val().length > 0 && $('#analistas').val() != -1)
       analista = $('#analistas').val(); 

    if($('#campanias').val().length > 0 && $('#campanias').val() != -1)
   		campania = $('#campanias').val();       


  if($('#eacs').val().length > 0 && $('#eacs').val() != -1)
   		eac = $('#eacs').val();

   	if(analista)
   		$(document.getElementById('analistas')).attr('disabled', 'disabled');

   	if(campania)
   		$(document.getElementById('campanias')).attr('disabled', 'disabled');

	if (!eac)
	{
   		document.getElementById('eacs').dataset.num = "";
   		if(document.getElementById('analistas').dataset.num == 2)
   			$(document.getElementById('analistas')).removeAttr('disabled');
   		else
	   		if(document.getElementById('campanias').dataset.num == 2)
	   			$(document.getElementById('campanias')).removeAttr('disabled');
	   		else
	   			if(document.getElementById('analistas').dataset.num == 1)
		   			$(document.getElementById('analistas')).removeAttr('disabled');
		   		else
			   		if(document.getElementById('campanias').dataset.num == 1)
			   			$(document.getElementById('campanias')).removeAttr('disabled');
	}
	else
	   	if(analista && campania)
	   		document.getElementById('eacs').dataset.num = 3;
	   	else
	   		if(campania) 
	   			document.getElementById('eacs').dataset.num = 2;
	   		else
		   		if(analista)
		   			document.getElementById('eacs').dataset.num = 2;
				else
		   			document.getElementById('eacs').dataset.num = 1;

    listarEvaluaciones(analista, campania, eac);
});

	
  function listarEvaluaciones(analista, campania, eac)
  {
    var baseurl = window.origin + '/Evaluacion/filtrarEvaluaciones';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {analista: analista, campania: campania, eac: eac},
    success: function(data) {
    if (data)
    {
    	if(!analista)
    	{
    		$(document.getElementById("analistas").options).remove();
    		$(document.getElementById("analistas")).append('<option value="-1">Seleccione una Analista</option>');
    		for (var b = 0; b < data["analistas"].length; b++) {
    			$(document.getElementById("analistas")).append("<option value='" + data["analistas"][b]["id_usuario"] + "'>" + data["analistas"][b]["nombre_completo"] + "</option>");
    		}
    	}

    	if(!campania)
    	{
    		$(document.getElementById("campanias").options).remove();
    		$(document.getElementById("campanias")).append('<option value="-1">Seleccione una Campa&ntilde;a</option>');
    		for (var c = 0; c < data["campanias"].length; c++) {
    			$(document.getElementById("campanias")).append('<option value="' + data["campanias"][c]["id_campania"] + '">' + data["campanias"][c]["c_nombre"] + '</option>');
    		}
    	}/*else{
    		if(analista)
    		{
    			$(document.getElementById("analistas").options).remove();
	    		$(document.getElementById("analistas")).append('<option value="-1">Seleccione una Analista</option>');
	    		for (var b = 0; b < data["analistas"].length; b++) {
	    			$(document.getElementById("analistas")).append("<option value='" + data["analistas"][b]["id_usuario"] + "'>" + data["analistas"][b]["nombre_completo"] + "</option>");
	    		}
	    		$("#analistas").val(analista).change();
    		}
    	}*/

    	if(!eac)
    	{
    		$(document.getElementById("eacs").options).remove();
    		$(document.getElementById("eacs")).append('<option value="-1">Seleccione un EAC</option>');
    		for (var d = 0; d < data["eacs"].length; d++) {
    			$(document.getElementById("eacs")).append("<option value='" + data["eacs"][d]["id_usuario"] + "'>" + data["eacs"][d]["nombre_completo_eac"] + "</option>");
    		}
    	}

        $("#tbodyEvaluaciones").empty();
        for (var i = 0; i < data["evaluaciones"].length; i++){
          var row = '<tr>';
          row = row.concat('\n<th scope="row" class="text-center align-middle registro">',data["evaluaciones"][i]['id_evaluacion'],'</th>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['ev_fecha'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['g_duracion_minutos'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['g_identificador'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['c_nombre'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['nombre_eac'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['puntaje'],' %</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['nombre_usu'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data["evaluaciones"][i]['nombre_usu_respon'],'</td>');

          row = row.concat('\n<td class="text-right align-middle registro">');
          row = row.concat('\n<a id="view_',data["evaluaciones"][i]['id_evaluacion'],'" class="view" href="#" data-id="',data["evaluaciones"][i]['id_evaluacion'],'" data-toggle="modal" data-target="#modalVerEvaluacion">');
          row = row.concat('\n<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver resultados"></i>');
          row = row.concat('\n</a>');
          /*row = row.concat('\n<a id="edit_',data[i]['id_equipo'],'" class="edit" type="link" href="ModificarEquipo/?idEquipo=',data[i]['id_equipo'],'" data-id="',data[i]['id_equipo'],'" data-nombre="',data[i]['nombre'],'">');
          row = row.concat('\n<i data-feather="edit-3"  data-toggle="tooltip" data-placement="top" title="modificar"></i>');
          row = row.concat('\n</a>');;*/
          row = row.concat('\n</td>')
          row = row.concat('\n<tr>');

        $("#tbodyEvaluaciones").append(row);
      }
      feather.replace()
      $('[data-toggle="tooltip"]').tooltip()
    }
    }
    });
  }

  $('#modalVerEvaluacion').on('show.bs.modal', function(e) {

    var idEvaluacion = $(e.relatedTarget).data('id');
    var baseurl = window.origin + '/Evaluacion/obtenerResultadoEvaluacion';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {idEvaluacion: idEvaluacion },
    success: function(data) {
	    if (data)
	    {
	    	var url = 'http://calidad.gsbpo.cl/grabaciones/MONITOREO/';
	    	url = url.concat(data["pauta"][0]['g_nombre']);
	    	$(document.getElementById('puntaje')).text(data["pauta"][0]['puntuacion'] + " %");
	    	$(document.getElementById('empresa')).text(data["pauta"][0]['empresa']);
	    	$(document.getElementById('fecha')).text(data["pauta"][0]['ev_fecha']);    	
	    	$(document.getElementById('agente')).text(data["pauta"][0]['nombre_completo']);
	    	$(document.getElementById('eac')).text(data["pauta"][0]['nombre_completo_eac']);
	    	$(document.getElementById('idLlamada')).text(data["pauta"][0]['g_identificador']);
	    	$(document.getElementById('nombreCampania')).text(data["pauta"][0]['campania']);
	    	$(document.getElementById('observacionEvaluacion')).text(data["pauta"][0]['ev_observacion']);
	    	document.getElementById('grabacion').setAttribute('src', url);
	    	
			$("#listaPreguntas").empty();
			for (var i = 0; i < Object.keys(data["cat_pauta"]).length; i++) {
				var row = '<tr>';
	      		row = row.concat('\n<th scope="col" colspan="12">');
				row = row.concat('\n', data["cat_pauta"][i]["nombre_categoria"], '</th>');
				row = row.concat('\n</tr>');

				for (var f = 0; f < Object.keys(data["pauta"]).length; f++) {
					if(data["pauta"][f]['cat_nombre'] == data["cat_pauta"][i]["nombre_categoria"])
					{
						row = row.concat('\n<tr data-idplacatpre="',data["pauta"][f]['id_plantilla_categoria_pregunta'],'">');
						row = row.concat('\n<th scope="row">',f + 1,'</th>');
						row = row.concat('\n<td colspan="9">',data["pauta"][f]['pre_nombre'],'</td>');
						row = row.concat('\n<td class="text-center">');
						if(data["pauta"][f]['id_respuesta'] == "1")
						{
							row = row.concat('\n<i data-feather="check" class="verde" data-toggle="tooltip" data-placement="top"></i>');
							row = row.concat('\n</td>');
							row = row.concat('\n<td class="text-center">');
						}else
						{
							row = row.concat('\n</td>');
							row = row.concat('\n<td class="text-center">');
							row = row.concat('\n<i data-feather="x" class="rojo" data-toggle="tooltip" data-placement="top"></i>');
						}
						//row = row.concat('\n<input type="radio" class="pauta" name="optionsRadios',f,'" id="optionsRadios',f,'" value="option',f,'">');
						
						//row = row.concat('\n<i data-feather="check"  data-toggle="tooltip" data-placement="top"></i>');
						//row = row.concat('\n<input type="radio" class="pauta" name="optionsRadios',f,'" id="optionsRadios',f,'" value="option',f,'">');
						row = row.concat('\n</td>');
						row = row.concat('\n</tr>');
					}
				}
				$("#listaPreguntas").append(row);
			}
				
			feather.replace()
		    $('[data-toggle="tooltip"]').tooltip()
		}
  	}
    });


  });

   $('#modalVerEvaluacion').on('hide.bs.modal', function(e) {
	    var audio = document.getElementById('grabacion');
	    audio.pause();
	});

});
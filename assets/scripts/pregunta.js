 $(document).ready(function() {

  $("#agregarPregunta").validate({
    errorClass:'invalid-feedback',
    errorElement:'span',
    highlight: function(element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("invalid-feedback");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
    rules: {
      inputNombre: {
        required: true,
        minlength: 1,
        maxlength: 100
      },
      inputObservaciones: {
        maxlength: 100
      },
    },
    messages:{
      inputNombre: {
        required: "Se requiere un Nombre de Pregunta.",
        minlength: "Se requieren m&iacute;nimo {0} caracteres.",
        maxlength: "Se requiere no mas de {0} caracteres."
      },
      inputObservaciones: {
        maxlength: "Se requiere no mas de {0} caracteres."
      },
    }
  });

  $('#modalEliminarPregunta').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var idPregunta = $(e.relatedTarget).data('id');
    var nombrePregunta = $(e.relatedTarget).data('nombre');
    //populate the textbox
    $("#tituloEP").text('Eliminar Pregunta N° ' + idPregunta);
    $("#parrafoEP").text('¿Estás seguro que deseas eliminar la  Pregunta N° ' + idPregunta + ', "' + nombrePregunta + '"?');

    $("#tituloEP").removeData("idpregunta");
    $("#tituloEP").attr("data-idpregunta", idPregunta);
    //$("#tituloEE").removeData("nombreequipo");
    //$("#tituloEE").attr("data-nombreEquipo", nombreEquipo);
  });

  $('#eliminarPregunta').click(function(e){
    idPregunta = $('#tituloEP').data('idpregunta');
    //var nombreEquipo = $('#tituloEE').data('nombreequipo');
    var baseurl = window.origin + '/Pregunta/eliminarPregunta';

    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {idPregunta: idPregunta},
    success: function(data) {
      if (data)
      {
        if(data == '1')
        {
          $('#tituloMP').empty();
          $("#parrafoMP").empty();
          $("#tituloMP").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
          $("#parrafoMP").append('Se ha eliminado exitosamente la Pregunta.');
          $('#modalEliminarPregunta').modal('hide');
          $('#modalMensajePregunta').modal({
            show: true
          });
          listarPreguntas('');
        }else{
          $('#tituloMP').empty();
          $("#parrafoMP").empty();
          $("#tituloMP").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
          $("#parrafoMP").append('Ha ocurrido un error al intentar la Pregunta.');
          $('#modalEliminarPregunta').modal('hide');
          $('#modalMensajePregunta').modal({
            show: true
          });
          listarPreguntas('');
        }
        feather.replace()
        $('[data-toggle="tooltip"]').tooltip()
      }
    }
    });
  });

  $('#buscarPregunta').on('change',function(e){
     filtroPregunta = $('#buscarPregunta').val();

     if(filtroPregunta.length = 0)
        filtroPregunta = "";
    listarPreguntas(filtroPregunta);
  });

  $("#agregarPregunta").submit(function(e) {
    var loader = document.getElementById("loader");
    loader.removeAttribute('hidden');
    /*$("div.loader").addClass('show');*/
    var validacion = $("#agregarPregunta").validate();
    if(validacion.numberOfInvalids() == 0)
    {
      event.preventDefault();

      var baseurl = (window.origin + '/Pregunta/guardarPregunta');
      var nombrePregunta = $('#inputNombre').val();
      var observacionesPregunta = $('#inputObservaciones').val();
      var idPregunta = null;
      if($("#inputIdPregunta").val())
        idPregunta = $('#inputIdPregunta').val();

      jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {idPregunta: idPregunta, nombrePregunta: nombrePregunta, observacionesPregunta: observacionesPregunta },
      success: function(data) {
        if (data)
        {
          //data = JSON.parse(data);
          if(data['respuesta'] == '1')
          {
            $('#tituloMP').empty();
            $("#parrafoMP").empty();
            $("#tituloMP").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
            $("#parrafoMP").append(data['mensaje']);
            if(!$("#inputIdPregunta").val())
            {
              $("#agregarPregunta")[0].reset();
            }
            loader.setAttribute('hidden', '');
            $('#modalMensajePregunta').modal({
              show: true
            });
          }else{
            $('#tituloMP').empty();
            $("#parrafoMP").empty();
            $("#tituloMP").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
            $("#parrafoMP").append(data['mensaje']);
            loader.setAttribute('hidden', '');
            $('#modalMensajeEquipo').modal({
              show: true
            });
          }
          feather.replace()
          $('[data-toggle="tooltip"]').tooltip()
        }
      }
      });
    }else
    {
      loader.setAttribute('hidden', '');
    }
  });

  function listarPreguntas(filtro)
  {
    var baseurl = window.origin + '/Pregunta/buscarPregunta';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {pregunta: filtro},
    success: function(data) {
    if (data)
    {
        $("#tbodyPregunta").empty();
        for (var i = 0; i < data.length; i++){
          var row = '<tr>';
          row = row.concat('\n<th scope="row" class="text-center align-middle registro">',data[i]['id_pregunta'],'</th>');
          row = row.concat('\n<td class="text-left align-middle registro">',data[i]['nombre'],'</td>');
          row = row.concat('\n<td class="text-left align-middle registro" hidden>',data[i]['descripcion'],'</td>');
          row = row.concat('\n<td class="text-right align-middle registro">');
          row = row.concat('\n<a id="trash_',data[i]['id_pregunta'],'" class="trash" href="#" data-id="',data[i]['id_pregunta'],'" data-nombre="',data[i]['nombre'],'" data-toggle="modal" data-target="#modalEliminarPregunta">');
          row = row.concat('\n<i data-feather="trash-2"  data-toggle="tooltip" data-placement="top" title="eliminar"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n<a id="edit_',data[i]['id_pregunta'],'" class="edit" type="link" href="ModificarPregunta/?idPregunta=',data[i]['id_pregunta'],'" data-id="',data[i]['id_pregunta'],'" data-nombre="',data[i]['nombre'],'">');
          row = row.concat('\n<i data-feather="edit-3"  data-toggle="tooltip" data-placement="top" title="modificar"></i>');
          row = row.concat('\n</a>');
          //row = row.concat('\n<a id="view_',data[i]['id_equipo'],'" class="view" href="#">');
          //row = row.concat('\n<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver"></i>');
          //row = row.concat('\n</a>');
          row = row.concat('\n</td>');
          row = row.concat('\n<tr>');

        $("#tbodyPregunta").append(row);
      }
      feather.replace()
      $('[data-toggle="tooltip"]').tooltip()
    }
    }
    });
  }

});
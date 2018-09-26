 $(document).ready(function() {

  $("#agregarCategoria").validate({
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
        minlength: 3,
        maxlength: 50
      },
      inputPuntuacion: {
        required: true,
        min: 0,
        max: 999,
        number: true
      },
      inputObservaciones: {
        maxlength: 100
      },
    },
    messages:{
      inputNombre: {
        required: "Se requiere un Nombre de Categoria.",
        minlength: "Se requieren m&iacute;nimo {0} caracteres.",
        maxlength: "Se requiere no mas de {0} caracteres."
      },
      inputPuntuacion: {
        required: "Se requiere una Puntuación para la Categoria.",
         number: "Se debe ingresar sólo números.",
        min: "Se requiere un valor mayor que {0}.",
        max: "Se requiere un valor menor que {0}."
       
      },
      inputObservaciones: {
        maxlength: "Se requiere no mas de {0} caracteres."
      },
    }
  });

  $('#modalEliminarCategoria').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var idCategoria = $(e.relatedTarget).data('id');
    var nombreCategoria = $(e.relatedTarget).data('nombre');
    //populate the textbox
    $("#tituloEC").text('Eliminar ' + nombreCategoria);
    $("#parrafoEC").text('¿Estás seguro que deseas eliminar "' + nombreCategoria + '"?');

    $("#tituloEC").removeData("idcategoria");
    $("#tituloEC").attr("data-idcategoria", idCategoria);
    //$("#tituloEE").removeData("nombreequipo");
    //$("#tituloEE").attr("data-nombreEquipo", nombreEquipo);
  });

  $('#eliminarCategoria').click(function(e){
    idCategoria = $('#tituloEC').data('idcategoria');
    //var nombreEquipo = $('#tituloEE').data('nombreequipo');
    var baseurl = window.origin + '/Categoria/eliminarCategoria';

    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {idCategoria: idCategoria},
    success: function(data) {
      if (data)
      {
        if(data == '1')
        {
          $('#tituloMC').empty();
          $("#parrafoMC").empty();
          $("#tituloMC").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
          $("#parrafoMC").append('Se ha eliminado exitosamente la Categor&iacute;a.');
          $('#modalEliminarCategoria').modal('hide');
          $('#modalMensajeCategoria').modal({
            show: true
          });
          listarCategorias('');
        }else{
          $('#tituloMC').empty();
          $("#parrafoMC").empty();
          $("#tituloMC").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
          $("#parrafoMC").append('Ha ocurrido un error al intentar la Categor&iacute;a.');
          $('#modalEliminarCategoria').modal('hide');
          $('#modalMensajeCategoria').modal({
            show: true
          });
          listarCategorias('');
        }
        feather.replace()
        $('[data-toggle="tooltip"]').tooltip()
      }
    }
    });
  });

  $('#buscarCategoria').on('change',function(e){
     filtroCategoria = $('#buscarCategoria').val();

     if(filtroCategoria.length = 0)
        filtroCategoria = "";
    listarCategorias(filtroCategoria);
  });

  $("#agregarCategoria").submit(function(e) {
    var loader = document.getElementById("loader");
    loader.removeAttribute('hidden');
    /*$("div.loader").addClass('show');*/
    var validacion = $("#agregarCategoria").validate();
    if(validacion.numberOfInvalids() == 0)
    {
      event.preventDefault();

      var baseurl = (window.origin + '/Categoria/guardarCategoria');
      var nombreCategoria = $('#inputNombre').val();
      var puntuacionCategoria = $('#inputPuntuacion').val();
      var observacionesCategoria = $('#inputObservaciones').val();
      var idCategoria = null;
      if($("#inputIdCategoria").val())
        idCategoria = $('#inputIdCategoria').val();

      jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {idCategoria: idCategoria, nombreCategoria: nombreCategoria, puntuacionCategoria: puntuacionCategoria, observacionesCategoria: observacionesCategoria },
      success: function(data) {
        if (data)
        {
          //data = JSON.parse(data);
          if(data['respuesta'] == '1')
          {
            $('#tituloMC').empty();
            $("#parrafoMC").empty();
            $("#tituloMC").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
            $("#parrafoMC").append(data['mensaje']);
            if(!$("#inputIdCategoria").val())
            {
              $("#agregarCategoria")[0].reset();
            }
            loader.setAttribute('hidden', '');
            $('#modalMensajeCategoria').modal({
              show: true
            });
          }else{
            $('#tituloMC').empty();
            $("#parrafoMC").empty();
            $("#tituloMC").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
            $("#parrafoMC").append(data['mensaje']);
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

  function listarCategorias(filtro)
  {
    var baseurl = window.origin + '/Categoria/buscarCategoria';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {categoria: filtro},
    success: function(data) {
    if (data)
    {
        $("#tbodyCategoria").empty();
        for (var i = 0; i < data.length; i++){
          var row = '<tr>';
          row = row.concat('\n<th scope="row" class="text-center align-middle registro">',data[i]['id_categoria'],'</th>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['nombre'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['descripcion'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['puntuacion'],'</td>');
          row = row.concat('\n<td class="text-right align-middle registro">');
          row = row.concat('\n<a id="trash_',data[i]['id_categoria'],'" class="trash" href="#" data-id="',data[i]['id_categoria'],'" data-nombre="',data[i]['nombre'],'" data-toggle="modal" data-target="#modalEliminarCategoria">');
          row = row.concat('\n<i data-feather="trash-2"  data-toggle="tooltip" data-placement="top" title="eliminar"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n<a id="edit_',data[i]['id_categoria'],'" class="edit" type="link" href="ModificarCategoria/?idCategoria=',data[i]['id_categoria'],'" data-id="',data[i]['id_categoria'],'" data-nombre="',data[i]['nombre'],'">');
          row = row.concat('\n<i data-feather="edit-3"  data-toggle="tooltip" data-placement="top" title="modificar"></i>');
          row = row.concat('\n</a>');
          //row = row.concat('\n<a id="view_',data[i]['id_equipo'],'" class="view" href="#">');
          //row = row.concat('\n<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver"></i>');
          //row = row.concat('\n</a>');
          row = row.concat('\n</td>');
          row = row.concat('\n<tr>');

        $("#tbodyCategoria").append(row);
      }
      feather.replace()
      $('[data-toggle="tooltip"]').tooltip()
    }
    }
    });
  }

});
 $(document).ready(function() {

  $("#agregarPlantilla").validate({
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
      inputObservaciones: {
        maxlength: 100
      },
    },
    messages:{
      inputNombre: {
        required: "Se requiere un Nombre de Plantilla.",
        minlength: "Se requieren m&iacute;nimo {0} caracteres.",
        maxlength: "Se requiere no mas de {0} caracteres."
      },
      inputObservaciones: {
        maxlength: "Se requiere no mas de {0} caracteres."
      },
    }
  });

  $('#buscarPlantilla').on('change',function(e){
     filtroPlantilla = $('#buscarPlantilla').val();

     if(filtroPlantilla.length = 0)
        filtroPlantilla = "";
    listarPlantillas(filtroPlantilla);
  });

  $('#modalEliminarPlantilla').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var idPlantilla = $(e.relatedTarget).data('id');
    var nombrePlantilla = $(e.relatedTarget).data('nombre');
    //populate the textbox
    $("#tituloEP").text('Eliminar ' + nombrePlantilla);
    $("#parrafoEP").text('¿Estás seguro que deseas eliminar "' + nombrePlantilla + '"?');

    $("#tituloEP").removeData("idplantilla");
    $("#tituloEP").attr("data-idplantilla", idPlantilla);
    //$("#tituloEP").removeData("nombreplantilla");
    //$("#tituloEP").attr("data-nombrePlantilla", nombrePlantilla);
  });

  $('#eliminarPlantilla').click(function(e){
    idPlantilla = $('#tituloEP').data('idplantilla');
    //var nombrePlantilla = $('#tituloEP').data('nombreplantilla');
    var baseurl = window.origin + '/Plantilla/eliminarPlantilla';

    jQuery.ajax({
    type: "POST",
    url: baseurl,
    //dataType: 'json',
    data: {idPlantilla: idPlantilla},
    success: function(data) {
      if (data)
      {
        if(data == '1')
        {
          $('#tituloMP').empty();
          $("#parrafoMP").empty();
          $("#tituloMP").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
          $("#parrafoMP").append('Se ha eliminado exitosamente el Plantilla.');
          $('#modalEliminarPlantilla').modal('hide');
          $('#modalMensajePlantilla').modal({
            show: true
          });
          listarPlantillas('');
        }else{
          $('#tituloMP').empty();
          $("#parrafoMP").empty();
          $("#tituloMP").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
          $("#parrafoMP").append('Ha ocurrido un error al intentar eliminar el Plantilla.');
          $('#modalEliminarPlantilla').modal('hide');
          $('#modalMensajePlantilla').modal({
            show: true
          });
          listarPlantillas('');
        }
        feather.replace()
        $('[data-toggle="tooltip"]').tooltip()
      }
    }
    });
  });

  $('#buscarEAC').on('change', function(e){
     filtroEAC = $('#buscarEAC').val();

     if(filtroEAC.length = 0)
        filtroEAC = "";
      listarEAC(filtroEAC);
  });

  function listarPlantillas(filtro)
  {
    var baseurl = window.origin + '/Plantilla/buscarPlantilla';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {plantilla: filtro},
    success: function(data) {
    if (data)
    {
        $("#tbodyPlantilla").empty();
        for (var i = 0; i < data.length; i++){
          var row = '<tr>';
          row = row.concat('\n<th scope="row" class="text-center align-middle registro">',data[i]['id_plantilla'],'</th>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['nombre'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['descripcion'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro">',data[i]['abreviacion'],'</td>');
          row = row.concat('\n<td class="text-center align-middle registro"><span class="badge badge-primary badge-pill">',data[i]['cant_usu'],'</span></td>');
          row = row.concat('\n<td class="text-right align-middle registro">');
          row = row.concat('\n<a id="trash_',data[i]['id_plantilla'],'" class="trash" href="#" data-id="',data[i]['id_plantilla'],'" data-nombre="',data[i]['nombre'],'" data-toggle="modal" data-target="#modalEliminarPlantilla">');
          row = row.concat('\n<i data-feather="trash-2"  data-toggle="tooltip" data-placement="top" title="eliminar"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n<a id="edit_',data[i]['id_plantilla'],'" class="edit" type="link" href="ModificarPlantilla/?idPlantilla=',data[i]['id_plantilla'],'" data-id="',data[i]['id_plantilla'],'" data-nombre="',data[i]['nombre'],'">');
          row = row.concat('\n<i data-feather="edit-3"  data-toggle="tooltip" data-placement="top" title="modificar"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n</td>');
          row = row.concat('\n<tr>');

        $("#tbodyPlantilla").append(row);
      }
      feather.replace()
      $('[data-toggle="tooltip"]').tooltip()
    }
    }
    });
  }

  function listarEAC(filtro){
    var eacs = [];
    if(document.getElementById('tablaEAC').dataset.eac.split(',').length > 0 && document.getElementById('tablaEAC').dataset.eac.split(',') != "")
      if(document.getElementById('tablaEAC').dataset.eac.split(',').length == 1)
        eacs = [document.getElementById('tablaEAC').dataset.eac];
      else
        eacs = document.getElementById('tablaEAC').dataset.eac.split(',');

    var baseurl = window.origin + '/Plantilla/buscarEAC';   

    jQuery.ajax({
    type: "POST",
    url: baseurl, //"buscarEAC",
    dataType: 'json',
    data: {eac: filtro},
    success: function(data) {
      if (data)
      {
          $("#tbodyEAC").empty();
          count = 0;
          for (var i = 0; i < data.length; i++){
            count++;
            var clases = "";//((count == 2) ? 'list-group' : '');
            if(count == 15)
              count = 0;
            var row = '';
            row = row.concat('<tr class="',clases,'">');
            row = row.concat('\n<td class="text-center" hidden>',data[i]['id_usuario'],'</td>');
            row = row.concat('\n<th class="text-center" scope="col">',data[i]['cod_eac'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['nombres'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['apellidos'],'</td>');
            row = row.concat('\n <td class="text-center" >',data[i]['email'],'</td>');
            row = row.concat('\n<td class="text-center " >');
            
            checked = "";
            var indiceEAC = eacs.indexOf(data[i]['id_usuario'].toString());
            if(indiceEAC != -1)
              checked = "checked";

            row = row.concat('\n<input id="check_',data[i]['id_usuario'],'" type="checkbox" class="pauta" data-idUsuario="', data[i]['id_usuario'],'" ', checked, '>');
            row = row.concat('\n</td>');
            row = row.concat('\n<tr>');
          $("#tbodyEAC").append(row);
        }
        //feather.replace()
        //$('[data-toggle="tooltip"]').tooltip()
      }
    }
    });
  }

  $('#tListaEAC').on('click', '.pauta', function(e) {
      idEAC = $(e.currentTarget).data('idusuario');
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
      document.getElementById('tablaEAC').dataset.eac = eacs;
  });

  $('#check_todos').on('click', function(e) {

      var tListaEAC = document.getElementById("tListaEAC");
      var r=1;
      var eacs = [];
      cant = 0;
      checked = ($("#check_todos").text() == 'Deseleccionar Todos' ? false : true);
      if(document.getElementById('tablaEAC').dataset.eac.split(',').length > 0 && document.getElementById('tablaEAC').dataset.eac.split(',') != "")
        if(document.getElementById('tablaEAC').dataset.eac.split(',').length == 1)
          eacs = [document.getElementById('tablaEAC').dataset.eac];
        else
          eacs = document.getElementById('tablaEAC').dataset.eac.split(',');
      while(row=tListaEAC.rows[r++])
      {
        if(row.cells.length > 0)
        {
          idEAC = row.cells[0].innerHTML;          
          if(idEAC != null)
          {
            var indiceEAC = eacs.indexOf(idEAC.toString());
            if(indiceEAC != -1)
            {
              if(!checked)
                eacs.splice(indiceEAC, 1);
            }else
              if(checked)
                eacs.push([idEAC]);

            $("#check_"+idEAC).prop("checked", checked);
          }
        }
      }

      document.getElementById('tablaEAC').dataset.eac = eacs;

      if(checked)
        $("#check_todos").text('Deseleccionar Todos');
      else
        $("#check_todos").text('Seleccionar Todos');
  });

  $("#agregarPlantilla").submit(function(e) {
    var loader = document.getElementById("loader");
    loader.removeAttribute('hidden');
    /*$("div.loader").addClass('show');*/
    var validacion = $("#agregarPlantilla").validate();
    if(validacion.numberOfInvalids() == 0)
    {
      event.preventDefault();
      /*var eacsPlantilla = [];
      if(document.getElementById('tablaEAC').dataset.eac.split(',').length > 0 && document.getElementById('tablaEAC').dataset.eac.split(',') != "")
        if(document.getElementById('tablaEAC').dataset.eac.split(',').length == 1)
          eacsPlantilla = [document.getElementById('tablaEAC').dataset.eac];
        else
          eacsPlantilla = document.getElementById('tablaEAC').dataset.eac.split(',');*/

      var baseurl = (window.origin + '/Plantilla/guardarPlantilla');
      var nombrePlantilla = $('#inputNombre').val();
      var observacionesPlantilla = $('#inputObservaciones').val();
      var idPlantilla = null;
      var esAgregado = 1;
      var formPlantilla = document.getElementById('agregarPlantilla');

      if(formPlantilla.dataset['idplantilla'])
        idPlantilla = formPlantilla.dataset['idplantilla'];

      if($("#inputIdPlantilla").val())
      {
        idPlantilla = $('#inputIdPlantilla').val();
        esAgregado = 0;
      }

      var categorias = document.getElementById('categorias');
      var cat_pre_plantilla = [];
     
      var preguntas = [];
      var cant = 0;
      var mensajeError = '';
      $(categorias.children).each(function(){
        var categoria = [];
        if(this.dataset.idcategoria)
        {
          categoria.push(this.dataset.idcategoria);
          categoria.push(this.dataset.nombre);
          if(this.dataset.preguntas != "")
          {
            categoria.push(preguntas.concat([this.dataset.preguntas.split(',')][0]));
          }else{
            mensajeError = mensajeError.concat('La Categoria ' + this.dataset.nombre + ' debe tener al menos una pregunta.');
            return;
          }
          cat_pre_plantilla.push(categoria);
        }
      });

      if(mensajeError.length == 0)
      {
        jQuery.ajax({
        type: "POST",
        url: baseurl,
        dataType: 'json',
        data: {idPlantilla: idPlantilla, nombrePlantilla: nombrePlantilla, observacionesPlantilla: observacionesPlantilla, esAgregado: esAgregado, categoriasPreguntasPlantilla: cat_pre_plantilla },
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
              if(!$("#inputIdPlantilla").val())
              {
                $("#agregarPlantilla")[0].reset();
                $('#categorias').empty();
                document.getElementById('agregarPlantilla').dataset.categorias = null;
                document.getElementById('agregarPlantilla').dataset.idplantilla = null;

              }
              loader.setAttribute('hidden', '');
              $('#modalMensajePlantilla').modal({
                show: true
              });
              
              var baseurl = (window.origin + '/Plantilla/obtenerIdPlantilla');
              jQuery.ajax({
              type: "POST",
              url: baseurl,
              //dataType: 'json',
              //data: {idPlantilla: idPlantilla, nombrePlantilla: nombrePlantilla, observacionesPlantilla: observacionesPlantilla, esAgregado: esAgregado /*, eacsPlantilla: eacsPlantilla*/ },
              success: function(data) {
                if (data)
                {
                  $('#agregarPlantilla').attr('data-idplantilla', data);
                }
              }
            });
              
            }else{
              $('#tituloMP').empty();
              $("#parrafoMP").empty();
              $("#tituloMP").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
              $("#parrafoMP").append(data['mensaje']);
              loader.setAttribute('hidden', '');
              $('#modalMensajePlantilla').modal({
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
        alert(mensajeError);
        loader.setAttribute('hidden', '');
        return;
      }
    }else
    {
      loader.setAttribute('hidden', '');
    }
  });

  $('#modalMensajePlantilla').on('hidden.bs.modal', function (e) {
    
  });

  $("#agregarCategoria").on('click', function(e) {
   
    var idCategoria = $("#categoria").val();
    var nombreCategoria = $("#categoria option:selected").text();
    if(idCategoria < 0)
    {
      alert('Debe ingresar una categoria');
    }else{
      var formPlantilla = document.getElementById('agregarPlantilla');

      if(formPlantilla.dataset['idplantilla'])
        idPlantilla = formPlantilla.dataset['idplantilla'];

      var categoriasPlantilla = [];

      if(formPlantilla.dataset.categorias.split(',').length > 0 && formPlantilla.dataset.categorias.split(',') != "")
        if(formPlantilla.dataset.categorias.split(',').length == 1)
          categoriasPlantilla = [formPlantilla.dataset.categorias];
        else
          categoriasPlantilla = formPlantilla.dataset.categorias.split(',');

      var indiceCategoriaPlantilla = categoriasPlantilla.indexOf(idCategoria.toString());
      if(indiceCategoriaPlantilla == -1)
      {
          categoriasPlantilla.push([idCategoria]);
          formPlantilla.dataset.categorias = categoriasPlantilla;
           $('.collapse.show').removeClass("show");
            var collapse = '';
            collapse = collapse.concat('<div class="card" id="categoria_',idCategoria,'" data-idcategoria="',idCategoria,'" data-nombre="', nombreCategoria,'" data-preguntas="" >');
            collapse = collapse.concat('<div class="card-header" id="heading_',idCategoria,'">');
            collapse = collapse.concat('<div class="row">');
            collapse = collapse.concat('<div class="col-sm-6 text-left mt-2">');
            collapse = collapse.concat('<h5>');
            collapse = collapse.concat(nombreCategoria);
            collapse = collapse.concat('</h5>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('<div class="col-sm-6 text-right">');
            collapse = collapse.concat('<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse',idCategoria,'" aria-expanded="true" aria-controls="collapse',idCategoria,'">');            
            collapse = collapse.concat('<i data-feather="chevron-down"></i>');
            collapse = collapse.concat('</button>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('<div id="collapse',idCategoria,'" class="collapse show" aria-labelledby="heading_',idCategoria,'" data-parent="#categorias">');
            collapse = collapse.concat('<div id="body_cat_',idCategoria,'" class="card-body">');
            collapse = collapse.concat('<div class="text-right text-right mt-3">');
            collapse = collapse.concat('<button type="button" class="btn btn-success" data-idcategoria="',idCategoria,'" data-nombre="',nombreCategoria,'" data-toggle="modal" data-target="#modalAgregarPreguntaPlantilla">Agregar Preguntas</button>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('</div>');
            collapse = collapse.concat('</div>');
            $('#categorias').append(collapse);
            feather.replace();
      }else
      {
        alert('ya se encuentra la categoria');
      }
     

    }
     
  });

  $('#modalAgregarPreguntaPlantilla').on('show.bs.modal', function (event) {
    var botonACategoria = $(event.relatedTarget);
    var idCategoria = botonACategoria.data('idcategoria');
    var nombreCategoria = botonACategoria.data('nombre');
    //var botonCategoria = document.getElementById('categoria_' + idCategoria);

    //var preguntas = [];

    /*if(botonACategoria)
      if(botonCategoria.dataset.preguntas.split(',').length > 0 && botonCategoria.dataset.preguntas.split(',') != "")
        if(botonCategoria.dataset.preguntas.split(',').length == 1)
          preguntas = [botonCategoria.dataset.preguntas];
        else
          preguntas = botonCategoria.dataset.preguntas.split(',');*/

    var baseurl = window.origin + '/Plantilla/listarPreguntas';

    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    //data: {eac: filtro},
    success: function(data) {
      if (data)
      {
        var categorias = document.getElementById("categorias");
        var preguntas = [];
        var rowPreguntas = '';

        $(categorias.children).each(function(){
          if(this.dataset.preguntas != "")
            preguntas = preguntas.concat([this.dataset.preguntas.split(',')][0]);
        });

          $("#tbodyPreguntas").empty();
          count = 0;
          for (var i = 0; i < data.length; i++){
            count++;
            var clases = "";//((count == 2) ? 'list-group' : '');
            if(count == 15)
              count = 0;
            if(!preguntas.includes(data[i]['id_pregunta']))
            {
              var row = '';
              row = row.concat('<tr>');
              row = row.concat('\n<th scope="row" class="text-center align-middle registro">',data[i]['id_pregunta'],'</th>');
              row = row.concat('\n<th class="text-left align-middle registro" >',data[i]['nombre'],'</td>');
              row = row.concat('\n<td class="text-left align-middle registro" hidden>',data[i]['descripcion'],'</td>');
              //row = row.concat('\n<td class="text-center">',data[i]['apellidos'],'</td>');
              row = row.concat('\n<td class="text-center"><input id="check_',data[i]['id_pregunta'],'" data-nombrepregunta="',data[i]['nombre'],'" data-idpregunta="',data[i]['id_pregunta'],'" type="checkbox" class="pauta">');
              //row = row.concat('\n<input id="check_',data[i]['id_usuario'],'" type="checkbox" class="pauta" data-idUsuario="', data[i]['id_usuario'],'" ', checked, '>');
              row = row.concat('\n</td>');
              row = row.concat('\n<tr>');
              $("#tbodyPreguntas").append(row);
              $("#tituloAPP").empty();
              $("#tituloAPP").append('Agregar preguntas a la categor&iacute;a ' + nombreCategoria);
            }
            
          //$("#tituloAPP").data('idcategoria', idCategoria);
          
        }
        document.getElementById('tituloAPP').dataset.idcategoria = idCategoria;
        document.getElementById('tituloAPP').dataset.nombrecategoria = nombreCategoria;
        //feather.replace()
        //$('[data-toggle="tooltip"]').tooltip()
      }
    }
    });

    //var modal = $(this)
    //modal.find('.modal-title').text('New message to ')
    //modal.find('.modal-body input').val(recipient)
  });

 $("#agregarPreguntaPlantilla").on('click', function(e) {

    var categorias = document.getElementById("categorias");    
    var idCategoria = document.getElementById('tituloAPP').dataset.idcategoria;
    var table = "";
    var preguntas = [];
    var rowPreguntas = '';

    $(categorias.children).each(function(){
      if(this.dataset.preguntas != "")
        preguntas = this.dataset.preguntas.split(',').map(Number);
    });

    var contienePreguntas = false;

    if(preguntas.length > 0)
    {
      contienePreguntas = true;
    }else
    {
      rowPreguntas = rowPreguntas.concat('<ul class="list-group" id="listaPreguntas_', idCategoria,'">');
    }
    $("input:checkbox:checked").each(function(){
      var idPregunta = $(this).data('idpregunta');
      var nombrePregunta = $(this).data('nombrepregunta');
      preguntas.push(idPregunta);
      rowPreguntas =  rowPreguntas.concat('<li id="pregunta_', idPregunta,'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">',nombrePregunta,'<button type="button" data-idpregunta="',idPregunta,'" data-idcategoria="',idCategoria,'" class="btn btn-link btn-sm p-0 eliminarPregunta"><i data-feather="x-square" data-toggle="tooltip" data-placement="top" title="Quitar Pregunta" class="eliminarPre"></i></button></li>');
    });

    if(contienePreguntas)
    {
      document.getElementById('listaPreguntas_' + idCategoria).append($(rowPreguntas)[0]);
    }else
    {
      rowPreguntas = rowPreguntas.concat('</ul>');
       document.getElementById('body_cat_' + idCategoria).prepend($(rowPreguntas)[0]);
    }
    feather.replace();
    document.getElementById('categoria_' + idCategoria).dataset.preguntas = preguntas;
    $('#modalAgregarPreguntaPlantilla').modal('hide');
  });

  /*
  $('#categorias').on('hidden.bs.collapse', function (e) {
    $(this).parent().find(".collapseIcon").empty().append('<i data-feather="chevron-down" data-toggle="tooltip" data-placement="top" title="" ></i>');
  });

  $('#categorias').on('show.bs.collapse', function (e) {
    $(this).parent().find(".collapseIcon").empty().append('<i data-feather="chevron-up" data-toggle="tooltip" data-placement="top" title="" ></i>');
  });

  */
  $('#categorias').on('click', '.eliminarPregunta', function(e) {//$('.eliminarPregunta').on('click', function(e){
    idpregunta = $(e.currentTarget).data('idpregunta');
    idcategoria = $(e.currentTarget).data('idcategoria');
    var preguntas = [];
    var categoria = document.getElementById('categoria_' + idcategoria);
    preguntas = categoria.dataset.preguntas.split(',').map(Number);
    preguntas.splice(preguntas.indexOf(idpregunta), 1);
    categoria.dataset.preguntas = preguntas;
    document.getElementById('pregunta_' + idpregunta).remove();
  });

});

$(document).ready(function() {

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $("#agregarEquipo").validate({
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
      inputAbreviacion: {
        required: true,
        minlength: 1,
        maxlength: 10
      },
      inputObservaciones: {
        maxlength: 100
      },
    },
    messages:{
      inputNombre: {
        required: "Se requiere un Nombre de Equipo.",
        minlength: "Se requieren m&iacute;nimo {0} caracteres.",
        maxlength: "Se requiere no mas de {0} caracteres."
      },
      inputAbreviacion: {
        required: "Se requiere una Abreviacion para el Equipo.",
        minlength: "Se requiere m&iacute;nimo {0} caracteres.",
        maxlength: "Se requiere no mas de {0} caracteres."
      },
      inputObservaciones: {
        maxlength: "Se requiere no mas de {0} caracteres."
      },
    }
  });

  $("#rango").change(function() {
    idRango= $("#rango").val();
    var baseurl = window.origin + '/Equipo/listarEvaluaciones';
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

  $('#buscarEquipo').on('input',function(e){
     filtroEquipo = $('#buscarEquipo').val();

     if(filtroEquipo.length = 0)
        filtroEquipo = "";
    listarEquipos(filtroEquipo);
  });

  $("#categoria").change(function() {
    micategoria= $("#categoria").val();
    var baseurl = window.origin + '/Inicio/llenacombo';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    //dataType: 'json',
    data: {micategoria: micategoria},
    success: function(res) {
      if (res)
      {
        // Show Entered Value
        $('#subcategoria').empty();
        //$('#subcategoria option').remove();
        $('#subcategoria').append(res);
        /*jQuery("div#result").show();
        jQuery("div#value").html(res.username);
        jQuery("div#value_pwd").html(res.pwd);*/
      }
    }
    });
  });

  $('#modalEliminarEquipo').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var idEquipo = $(e.relatedTarget).data('id');
    var nombreEquipo = $(e.relatedTarget).data('nombre');
    //populate the textbox
    $("#tituloEE").text('Eliminar ' + nombreEquipo);
    $("#parrafoEE").text('¿Estás seguro que deseas eliminar "' + nombreEquipo + '"?');

    $("#tituloEE").removeData("idequipo");
    $("#tituloEE").attr("data-idequipo", idEquipo);
    //$("#tituloEE").removeData("nombreequipo");
    //$("#tituloEE").attr("data-nombreEquipo", nombreEquipo);
  });

 $('#eliminarEquipo').click(function(e){    
    idEquipo = $('#tituloEE').data('idequipo');
    //var nombreEquipo = $('#tituloEE').data('nombreequipo');
    var baseurl = window.origin + '/Equipo/eliminarEquipo';    

    jQuery.ajax({
    type: "POST",
    url: baseurl,
    //dataType: 'json',
    data: {idEquipo: idEquipo},
    success: function(data) {
      if (data)
      {
        if(data == '1')
        {
          $('#tituloME').empty();
          $("#parrafoME").empty();
          $("#tituloME").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
          $("#parrafoME").append('Se ha eliminado exitosamente el Equipo.');
          $('#modalEliminarEquipo').modal('hide');
          $('#modalMensajeEquipo').modal({
            show: true
          });
          listarEquipos('');
        }else{

          $('#tituloME').empty();
          $("#parrafoME").empty();
          $("#tituloME").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
          $("#parrafoME").append('Ha ocurrido un error al intentar eliminar el Equipo.');
          $('#modalEliminarEquipo').modal('hide');
          $('#modalMensajeEquipo').modal({
            show: true
          });
          listarEquipos('');
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

 function listarEquipos(filtro)
 {
    var baseurl = window.origin + '/Equipo/buscarEquipo';
    jQuery.ajax({
    type: "POST",
    url: baseurl,
    dataType: 'json',
    data: {equipo: filtro},
    success: function(data) {
    if (data)
    {
        $("#tbodyEquipo").empty();
        for (var i = 0; i < data.length; i++){
          var row = '<tr>';
          row = row.concat('\n<th scope="row" class="text-center align-middle">',data[i]['id_equipo'],'</th>');
          row = row.concat('\n<td class="text-center align-middle">',data[i]['nombre'],'</td>');
          row = row.concat('\n<td class="text-center align-middle">',data[i]['descripcion'],'</td>');
          row = row.concat('\n<td class="text-center align-middle">',data[i]['abreviacion'],'</td>');
          row = row.concat('\n<td class="text-center align-middle"><span class="badge badge-primary badge-pill">',data[i]['cant_usu'],'</span></td>');
          row = row.concat('\n<td class="text-center align-middle">');
          row = row.concat('\n<a id="trash_',data[i]['id_equipo'],'" class="trash" href="#" data-id="',data[i]['id_equipo'],'" data-nombre="',data[i]['nombre'],'" data-toggle="modal" data-target="#modalEliminarEquipo">');
          row = row.concat('\n<i data-feather="trash-2"  data-toggle="tooltip" data-placement="top" title="eliminar"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n<a id="edit_',data[i]['id_equipo'],'" class="edit btn btn-link" type="link" href="ModificarEquipo/?idEquipo=',data[i]['id_equipo'],'" data-id="',data[i]['id_equipo'],'" data-nombre="',data[i]['nombre'],'">');
          row = row.concat('\n<i data-feather="edit-3"  data-toggle="tooltip" data-placement="top" title="modificar"></i>');
          row = row.concat('\n</a>');
          //row = row.concat('\n<a id="view_',data[i]['id_equipo'],'" class="view" href="#">');
          //row = row.concat('\n<i data-feather="search"  data-toggle="tooltip" data-placement="top" title="ver"></i>');
          //row = row.concat('\n</a>');
          row = row.concat('\n</td>');
          row = row.concat('\n<tr>');

        $("#tbodyEquipo").append(row);
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

    var baseurl = window.origin + '/Equipo/buscarEAC';   

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

  $( "#agregarEquipo").submit(function( event ) {

    var loader = document.getElementById("loader");
    loader.removeAttribute('hidden');
    /*$("div.loader").addClass('show');*/
    var validacion = $("#agregarEquipo").validate();
    if(validacion.errorList.length == 0)
    {
      event.preventDefault();
      var eacsEquipo = [];
      if(document.getElementById('tablaEAC').dataset.eac.split(',').length > 0 && document.getElementById('tablaEAC').dataset.eac.split(',') != "")
        if(document.getElementById('tablaEAC').dataset.eac.split(',').length == 1)
          eacsEquipo = [document.getElementById('tablaEAC').dataset.eac];
        else
          eacsEquipo = document.getElementById('tablaEAC').dataset.eac.split(',');

      var baseurl = (window.origin + '/Equipo/guardarEquipo');
      var nombreEquipo = $('#inputNombre').val();
      var abreviacionEquipo = $('#inputAbreviacion').val();
      var observacionesEquipo = $('#inputObservaciones').val();
      var idEquipo = null;
      if($("#inputIdEquipo").val())
        idEquipo = $('#inputIdEquipo').val();

      jQuery.ajax({
      type: "POST",
      url: baseurl,
      dataType: 'json',
      data: {idEquipo: idEquipo, nombreEquipo: nombreEquipo, abreviacionEquipo: abreviacionEquipo, observacionesEquipo: observacionesEquipo, eacsEquipo: eacsEquipo },
      success: function(data) {
        if (data)
        {
          //data = JSON.parse(data);
          if(data['respuesta'] == '1')
          {
            $('#tituloME').empty();
            $("#parrafoME").empty();
            $("#tituloME").append('<i class="plusTitulo mb-2" data-feather="check"></i> Exito!!!');
            $("#parrafoME").append(data['mensaje']);
            loader.setAttribute('hidden', '');
            $('#modalMensajeEquipo').modal({
              show: true
            });
            /*$("#agregarEquipo")[0].reset();
            $("#check_todos").text('Seleccionar Todos');
            $(".pauta").prop("checked", false);*/
          }else{
            $('#tituloME').empty();
            $("#parrafoME").empty();
            $("#tituloME").append('<i class="plusTituloError mb-2" data-feather="x-circle"></i> Error!!!');
            $("#parrafoME").append(data['mensaje']);
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
    }
  });

  $('#tDatos').on('click', '.edit', function(e) {
    //alert('se modificará el equipo' + ' ' + $(e.currentTarget).data('id'));
    //$.redirect('demo.php',
    //$.redirect('ModificarEquipo', {'idEquipo': $(e.currentTarget).data('id')});
     $.post("ModificarEquipo", {'idEquipo': $(e.currentTarget).data('id') } );
  });

  feather.replace()
  $('[data-toggle="tooltip"]').tooltip()

});
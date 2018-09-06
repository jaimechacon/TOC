
$(document).ready(function() {

  $("#rango").change(function() {
    idRango= $("#rango").val();
    jQuery.ajax({
      type: "POST",
      url: "listarEvaluaciones",
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

      jQuery.ajax({
      type: "POST",
      url: "buscarEquipo",
      dataType: 'json',
      data: {equipo: filtroEquipo},
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
            row = row.concat('\n<a id="trash_',data[i]['id_equipo'],'" class="trash" href="#" data-id="',data[i]['id_equipo'],'" data-nombre="',data[i]['nombre'],'"  data-toggle="modal" data-target="#modalEliminarEquipo">');
            row = row.concat('\n<i data-feather="trash-2"></i>');
            row = row.concat('\n</a>');
            row = row.concat('\n<a id="edit_',data[i]['id_equipo'],'" class="edit" href="#">');
            row = row.concat('\n<i data-feather="edit"></i>');
            row = row.concat('\n</a>');
            row = row.concat('\n</td>');
            row = row.concat('\n<tr>');
          $("#tbodyEquipo").append(row);
        }
        feather.replace()
      }
      }
      });
  });

  $("#categoria").change(function() {
    micategoria= $("#categoria").val();
    //alert(micategoria);

    jQuery.ajax({
    type: "POST",
    url: "Inicio/llenacombo",
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
    $("#tituloEE").attr("data-idEquipo", idEquipo);
    //$("#tituloEE").removeData("nombreequipo");
    //$("#tituloEE").attr("data-nombreEquipo", nombreEquipo);
  });

 $('#eliminarEquipo').click(function(e){    
    idEquipo = $('#tituloEE').data('idequipo');
    //var nombreEquipo = $('#tituloEE').data('nombreequipo');
   
    jQuery.ajax({
    type: "POST",
    url: "eliminarEquipo",
    dataType: 'json',
    data: {idEquipo: idEquipo},
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
          row = row.concat('\n<a id="trash_',data[i]['id_equipo'],'" class="trash" href="#" data-id="',data[i]['id_equipo'],'" data-nombre="',data[i]['nombre'],'"  data-toggle="modal" data-target="#modalEliminarEquipo">');
          row = row.concat('\n<i data-feather="trash-2"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n<a id="edit_',data[i]['id_equipo'],'" class="edit" href="#">');
          row = row.concat('\n<i data-feather="edit"></i>');
          row = row.concat('\n</a>');
          row = row.concat('\n</td>');
          row = row.concat('\n<tr>');
          $("#tbodyEquipo").append(row);
        }
        feather.replace()
      }
    }
    });
  });


 $('#buscarEAC').on('input',function(e){
     filtroEAC = $('#buscarEAC').val();

     if(filtroEAC.length = 0)
        filtroEAC = "";

      jQuery.ajax({
      type: "POST",
      url: "buscarEAC",
      dataType: 'json',
      data: {eac: filtroEAC},
      success: function(data) {
      if (data)
      {
          $("#tbodyEAC").empty();
          for (var i = 0; i < data.length; i++){
            var row = '<tr>';
            row = row.concat('\n<td class="text-center" hidden>',data[i]['id_usuario'],'</td>');
            row = row.concat('\n<th class="text-center" scope="col">',data[i]['cod_eac'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['nombres'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['apellidos'],'</td>');
            row = row.concat('\n <td class="text-center" >',data[i]['email'],'</td>');
            row = row.concat('\n<td class="text-center " >');
            row = row.concat('\n<input type="checkbox" class="pauta" data-idUsuario="', data[i]['id_usuario'],'" id="incluido_eac_',data[i]['id_usuario'],'">');
            row = row.concat('\n</td>');
            row = row.concat('\n<tr>');
          $("#tbodyEAC").append(row);
        }
        feather.replace()
      }
      }
      });
  });

  $('input[type=checkbox].pauta').click(function(e) {
      idEAC = $(e.currentTarget).data('idusuario');
      checked = null;
      if(idEAC != null)
      {      
        if($(this).is(':checked')) {
            checked = true;
        } else {
            checked = false;
        }
      }

      jQuery.ajax({
      type: "POST",
      url: "listaEAC",
      //dataType: 'json',
      data: {idEac: idEAC, checked: checked},
      success: function(data) {
      if (data)
      {
          /*$("#tbodyEAC").empty();
          for (var i = 0; i < data.length; i++){
            var row = '<tr>';
            row = row.concat('\n<td class="text-center" hidden>',data[i]['id_usuario'],'</td>');
            row = row.concat('\n<th class="text-center" scope="col">',data[i]['cod_eac'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['nombres'],'</td>');
            row = row.concat('\n<td class="text-center" colspan="5">',data[i]['apellidos'],'</td>');
            row = row.concat('\n <td class="text-center" >',data[i]['email'],'</td>');
            row = row.concat('\n<td class="text-center " >');
            row = row.concat('\n<input type="checkbox" class="pauta" data-idUsuario="', data[i]['id_usuario'],'" id="incluido_eac_',data[i]['id_usuario'],'">');
            row = row.concat('\n</td>');
            row = row.concat('\n<tr>');
          $("#tbodyEAC").append(row);
        }
        feather.replace()
*/
        alert(data);
      }
      }
      });

  });


  feather.replace()

});
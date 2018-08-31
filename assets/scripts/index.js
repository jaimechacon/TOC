
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
     if(filtroEquipo.length > 0)
     {
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
                row = row.concat('\n<div class="in-line">');
                row = row.concat('\n<a class="trash" href="#">');
                row = row.concat('\n<i data-feather="trash-2"></i>');
                row = row.concat('\n</a>');
                row = row.concat('\n<a class="edit" href="#">');
                row = row.concat('\n<i data-feather="edit"></i>');
                row = row.concat('\n</a>');
                row = row.concat('\n</div>');
                row = row.concat('\n</td>');
                row = row.concat('\n<tr>');
              $("#tbodyEquipo").append(row);
            }
            feather.replace()
          }
        }
        });
     }else{
        jQuery.ajax({
        type: "POST",
        url: "buscarEquipo",
        dataType: 'json',
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
                row = row.concat('\n<div class="in-line">');
                row = row.concat('\n<a class="" href="">');
                row = row.concat('\n<i data-feather="trash-2"></i>');
                row = row.concat('\n</a>');
                row = row.concat('\n<a class="" href="">');
                row = row.concat('\n<i data-feather="edit"></i>');
                row = row.concat('\n</a>');
                row = row.concat('\n</div>');
                row = row.concat('\n</td>');
                //row = row.concat('\n<td class="text-center align-middle"><span class="badge badge-primary badge-pill">',data[i]['cant_usu'],'</span></td>');
                //row = row.concat('\n<td class="text-center align-middle"><div class="in-line"><a class="" href="Inicio"><i data-feather="trash-2"></i></a><a class="" href="Inicio"><i data-feather="edit"></i></a></div></td>');
                row = row.concat('\n<tr>');
              $("#tbodyEquipo").append(row);
            }
            feather.replace()
          }
        }
        });
     }
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

  


  feather.replace()

});

  
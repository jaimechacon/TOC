
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
                row = row.concat('\n<th scope="row" class="text-center align-middle">'+data[i]['COD_USUARIO']+'</th>');
                row = row.concat('\n<td class="text-center align-middle">'+data[i]['EAC']+'</td>');

                for (var c = 1; c <=  data[0]['CANT_CAMPANIAS']; c++) {
                  row = row.concat('\n<td class="text-center align-middle">\n<a href="AgregarEvaluacion/?idEAC='+data[i]['ID_USU']+'&idCamp='+data[i][('ID_CAMP_'+c)]+'" class="badge badge-pill ');
                  if(data[i][('CANT_EVAL_'+c)] == 0)
                  {
                    row = row.concat('badge-danger">'+data[i][('CANT_EVAL_'+c)]+'   /   '+data[i][('TOTAL_EAC_'+c)]); 
                  }else
                    if(data[i][('CANT_EVAL_'+c)] > 0 && data[i][('CANT_EVAL_'+c)] < data[i][('TOTAL_EAC_'+c)])
                    {
                       row = row.concat('badge-warning">'+data[i][('CANT_EVAL_'+c)]+'   /   '+data[i][('TOTAL_EAC_'+c)]);
                    }else{
                      row = row.concat('badge-success">'+data[i][('CANT_EVAL_'+c)]+'   /   '+data[i][('TOTAL_EAC_'+c)]);
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

});


$(document).ready(function() {

  feather.replace();
  $('[data-toggle="tooltip"]').tooltip()

 // inicio prueba ajax de Pagina inicio
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
  // fin prueba ajax de Pagina inicio



});
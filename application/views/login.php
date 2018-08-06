<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gesti&oacute;n de Calidad</title>

  <!-- Core CSS - Include with every page -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">-->


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="http://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
      
  <link href="<?php echo base_url();?>assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/main-style.css" rel="stylesheet" />
</head>  
  <body class="text-center">
    <form class="form-signin" action="<?php echo base_url();?>Login/ingresar" method="POST">
      <img class="mb-4" src="<?php echo base_url();?>/assets/img/logo.png" alt="" width="150">
      <h1 class="h3 mb-3 font-weight-normal">Inicie sesi&oacute;n</h1>
      <?php if(isset($message)) {
      echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
      }
      ?>

      <label for="email" class="sr-only">Correo</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Correo" required autofocus>
      <label for="contrasenia" class="sr-only">Password</label>
      <input type="password" id="contrasenia" name="contrasenia" class="form-control" placeholder="Contrase&ntilde;a" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="recordar"> Recordar contrase&ntilde;a
        </label>
      </div>
      <button id="iniciarSesion" name="iniciarSesion" class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesi&oacute;n</button>
      <p class="mt-5 mb-3 text-muted">&reg; GSBPO - Gesti&oacute;n de Calidad 2018</p>
    </form>
  </body>
</html>
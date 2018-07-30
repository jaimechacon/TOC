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
      
  <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/main-style.css" rel="stylesheet" />

</head>  
  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="assets/img/logo.png" alt="" width="150">
      <h1 class="h3 mb-3 font-weight-normal">Inicie sesi&oacute;n</h1>
      <label for="email" class="sr-only">Correo</label>
      <input type="email" id="email" class="form-control" placeholder="Correo" required autofocus>
      <label for="contrasenia" class="sr-only">Password</label>
      <input type="password" id="contrasenia" class="form-control" placeholder="Contrase&ntilde;a" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="Recordar contrase&ntilde;a"> Recordar contrase&ntilde;a
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>
  </body>
</html>
<?php
  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  $user = $_POST['user'];
  $pass = $_POST['pass'];
   
  // Esto se puede remplazar por un usuario real guardado en la base de datos.
  if($user == 'Carlos' && $pass == 'Carlos2021'){
    // Guardo en la sesión el email del usuario.
    $_SESSION['user'] = $user;
     
    // Redirecciono al usuario a la página principal del sitio.
    
    header("Location: inicio.php"); 
  }else{
    echo 'El Usuario o contraseña son incorrecto, <a href="index.html">vuelva a intenarlo</a>.<br/>';
  }
 
?>
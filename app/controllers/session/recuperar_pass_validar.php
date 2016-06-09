<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

if ( !empty($_POST) ) {
  $email=$_POST['email'];

  if (User::exist_user($email)) {
    $user = User::exist_user($email);
    redirect_to_message('Recuperar contraseña',"Se envío un e-mail a '$email' con la contraseña ($user->password)",'/');
  }else {
    redirect_to_message('Recuperar contraseña',"El usuario '$email' no existe",'/session/recuperar_pass.php');
  }
}
else {
  echo "<script> alert('ERROR')</script>";
}

//header('Location: ' . "index.php");

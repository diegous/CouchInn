<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

if ( !empty($_POST) ) {
  $email=$_POST['email'];

  if (User::exist_user($email)) {
    $user = User::exist_user($email);
    redirect_with_alert('success',"Se envío un e-mail a '$email' con la contraseña ($user->password)",'/');
  }else {
    redirect_with_alert('danger',"El usuario '$email' no existe",'/session/recuperar_pass.php');
  }
} else {
  header('Location: ' . "/");
}


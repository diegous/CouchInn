<?php

include "loader.php";

if ( !empty($_POST) ) {
  $email=$_POST['email'];

  if (User::exist_user($email)) {
    //echo "<script> alert('El mail fue enviado correctamente " .$email." ') </script>";
    echo "<form action='alert_page.php' method='post' name='frm'>
    <input type='hidden' name='title' value='Recuperar contraseña' >
    <input type='hidden' name='url' value='index.php'>
    <input type='hidden' name='message' value='El e-mail fue enviado correctamente " .$email."' >
    </form>
    <script language='JavaScript'> document.frm.submit(); </script>";
    }
  else {
    //echo "<script> alert('El usuario no existe')</script>";
    echo "<form action='alert_page.php' method='post' name='frm'>
    <input type='hidden' name='title' value='Recuperar contraseña' >
    <input type='hidden' name='url' value='recuperar_pass.php'>
    <input type='hidden' name='message' value='El usuario no existe' >
    </form>
    <script language='JavaScript'> document.frm.submit(); </script>";
  }
}
else {
  echo "<script> alert('ERROR')</script>";
}

//header('Location: ' . "index.php");

<?php

include "loader.php";

if ( !empty($_POST) ) {
  $email=$_POST['email'];
  
  if (User::exist_user($email)) {
    echo "<script> alert('El mail fue enviado correctamente " .$email." ') </script>";
    }  
  else {
    echo "<script> alert('El usuario no existe')</script>";
  }
}
else {
  echo "<script> alert('ddddd')</script>";
}

//header('Location: ' . "index.php");

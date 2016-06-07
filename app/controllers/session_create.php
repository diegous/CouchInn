<?php

include "loader.php";

if ($user = User::check_login($_POST["email"], $_POST["password"])) {
  $_SESSION['user'] = $user;
  header('Location: ' . "index.php");
}
else {
  //echo "<script> alert('Usuario o password incorrecto')</script>";
  //header('Location: ' . "views/login_view.php");
  echo "<form action='alert_page.php' method='post' name='frm'>
    <input type='hidden' name='title' value='Usuario o password incorrecto' >
    <input type='hidden' name='url' value='index.php'>
    <input type='hidden' name='message' value='Usuario o password incorrecto' >
    </form>
    <script language='JavaScript'> document.frm.submit(); </script>";
}

//header('Location: ' . "index.php");
//exit();

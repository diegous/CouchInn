<?php

include "shared/loader.php";

//check_login();

if ($_POST["id"] && $_POST["password"] && $_POST["name"] && $_POST["last_name"] && $_POST["birthday"]) {
  echo "entra al if<br>";
  $user = User::get_by_id($_POST["id"]);

  $user->password = $_POST['password'];
  $user->name = $_POST['name'];
  $user->last_name = $_POST['last_name'];
  $user->birthday = $_POST['birthday'];
  $user->phone = $_POST['phone'];

  $user->update();

  $_SESSION['user'] = $user;
}

header('Location: ' . "user_edit.php");
exit();

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//check_login();

if ($_POST["id"] && $_POST["password"] && $_POST["name"] && $_POST["last_name"] && $_POST["birthday"]) {
  $user = User::get_by_id($_POST["id"]);

  $user->password = $_POST['password'];
  $user->name = $_POST['name'];
  $user->last_name = $_POST['last_name'];
  $user->birthday = $_POST['birthday'];
  $user->phone = $_POST['phone'];

  $user->update();

  $_SESSION['user'] = $user;
  redirect_with_alert('success',"El usuario ha sido modificado",'/user/user_profile.php?id=' . $user->id);
}


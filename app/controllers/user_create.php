<?php

include "loader.php";

if ( ! $email = $_POST['email'] ) {
  header('Location: ' . "user_new.php?warning=missing_fields");
  exit();
}

if ( ! $password = $_POST['password'] ) {
  header('Location: ' . "user_new.php?warning=missing_fields");
  exit();
}

$name      = $_POST['name'] ? $_POST['name'] : NULL;
$last_name = $_POST['last_name'] ? $_POST['last_name'] : NULL;
$birthday  = $_POST['birthday'] ? $_POST['birthday'] : NULL;
$phone     = $_POST['phone'] ? $_POST['phone'] : NULL;

$user = new User(NULL, TRUE, $email, $password, $name, $last_name, $birthday, $phone, 0, 0);
$user->save_new();


header('Location: ' . "index.php");
exit();

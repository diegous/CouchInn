<?php

include "loader.php";

if ($user = User::check_login($_POST["email"], $_POST["password"])) {
  $_SESSION['user'] = $user;
}

header('Location: ' . "index.php");
exit();

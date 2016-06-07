<?php

include "loader.php";

redirect_if_logged_in();

if ($user = User::check_login($_POST["email"], $_POST["password"])) {
  $_SESSION['user'] = $user;
  echo TRUE;
}
else {
  echo FALSE;
}

exit();

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_logged_in();

$user = User::check_login($_POST["email"], $_POST["password"]);
if ($user) {
  // This goes here to avoid creating an automated task
  // that runs every day at 00:00
  Reservation::end_confirmed_reservations();
  Reservation::expire_pending_reservations();

  $_SESSION['user'] = $user;
  echo 2;
}else if($user===false){
  echo 1;
}else{
  echo 0;
}

exit();

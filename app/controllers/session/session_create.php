<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_logged_in();

if ($user = User::check_login($_POST["email"], $_POST["password"])) {
  // This goes here to avoid creating an automated task
  // that runs every day at 00:00
  Reservation::end_confirmed_reservations();

  $_SESSION['user'] = $user;
  echo TRUE;
}
else {
  echo FALSE;
}

exit();

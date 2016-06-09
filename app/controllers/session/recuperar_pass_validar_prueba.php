<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_logged_in();

if (User::exist_user($_POST['email'])) {
    $user = User::exist_user($_POST['email']);
    echo TRUE;
  }
else {
  echo FALSE;
  }

exit();

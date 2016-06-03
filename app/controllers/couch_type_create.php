<?php

include "loader.php";

if ($_POST["description"]) {
  $couch_type = new CouchType(NULL, TRUE, $_POST["description"]);

  if (!$couch_type->already_exists()) {
    $couch_type->save_new();
  }
}


header('Location: ' . "couch_type_list.php");
exit();

<?php

include "loader.php";

check_admin();

if ($_POST["id"]) {
  $couch_type = CouchType::get_by_id($_POST["id"]);
  $couch_type->enable();
}


header('Location: ' . 'couch_type_list.php');
exit();

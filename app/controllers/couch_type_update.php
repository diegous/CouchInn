<?php

include "loader.php";

check_admin();

if ($_POST["id"] && $_POST["description"]) {
  $couch_type = CouchType::get_by_id($_POST["id"]);
  $couch_type->description = $_POST["description"];
  $couch_type->update();
}

header('Location: ' . "couch_type_list.php");
exit();

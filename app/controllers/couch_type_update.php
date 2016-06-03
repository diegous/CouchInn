<?php

include "loader.php";

check_admin();

if ($_POST["id"] && $_POST["description"]) {
  $couch_type = new CouchType($_POST["id"], $_POST["description"]);
  $couch_type->update();
}

header('Location: ' . "couch_type_list.php");
exit();

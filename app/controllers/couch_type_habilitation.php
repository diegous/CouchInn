<?php

include "loader.php";

redirect_if_not_admin();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $couch_type = CouchType::get_by_id($_GET["id"]);

  if ($_GET["action"] == "enable") {
    $couch_type->enable();
  } else if ($_GET["action"] == "disable") {
    $couch_type->disable();
  }
}

header('Location: ' . 'couch_type_list.php');
exit();

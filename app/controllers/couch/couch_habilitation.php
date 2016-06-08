<?php

include "loader.php";

//redirect_if_not_admin();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $couch = Couch::get_by_id($_GET["id"]);

  if ($_GET["action"] == "enable") {
    $couch->enable();
  } else if ($_GET["action"] == "disable") {
    $couch->disable();
  }
}

header('Location: couch.php?id=' . $_GET["id"]);

exit();
<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $couch = Couch::get_by_id($_GET["id"]);

  if ($_GET["action"] == "enable") {
    $couch->enable();
    redirect_to_message('Couch habilitado',"El couch ha sido habilitado",'/couch/couch.php?id=' . $_GET["id"]);
  } else if ($_GET["action"] == "disable") {
    $couch->disable();
    redirect_to_message('Couch deshabilitado',"El couch ha sido deshabilitado",'/couch/couch.php?id=' . $_GET["id"]);
  }
}
/*
header('Location: ' . '/couch/couch.php?id=' . $_GET["id"]);
exit();
*/


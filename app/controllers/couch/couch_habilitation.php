<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $couch = Couch::get_by_id($_GET["id"]);

  if ($_GET["action"] == "enable") {
    $couch->enable();
    redirect_with_alert('success',"El couch ha sido habilitado",'/couch/couch.php?id=' . $_GET["id"]);
  } else
    if ($_GET["action"] == "disable") {
      if($_SESSION['user']->is_admin) {
        $couch->disable_as_admin();
        $couch->disable_reservation_couch();
      }
      else{
        $couch->disable();
        $couch->disable_reservation_couch();
      }
      redirect_with_alert('success',"El couch ha sido deshabilitado",'/couch/couch.php?id=' . $_GET["id"]);

    }
}
/*
header('Location: ' . '/couch/couch.php?id=' . $_GET["id"]);
exit();
*/


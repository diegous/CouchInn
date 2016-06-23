<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $couch_type = CouchType::get_by_id($_GET["id"]);
  $message="El Tipo de Couch fue ";
  if ($_GET["action"] == "enable") {
    $couch_type->enable();
    $message .= "habilitado." ;
  } else if ($_GET["action"] == "disable") {
    $couch_type->disable();
    $message .= "deshabilitado." ;
  }
  redirect_with_alert('success',$message,'/couch_type/couch_type_list.php');
}else{

  header('Location: ' . '/couch_type/couch_type_list.php');
  exit();
}


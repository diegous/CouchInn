<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$alert_variables = check_for_alert();

$content = "couch/couch_view.php";
$title = "Ver couch";

if (isset($_GET['id'])) {
  $couch = Couch::get_by_id($_GET["id"]);
  $picture_list = Picture::get_by_couch_id($_GET["id"]);
  $couch_type = CouchType::get_by_id($couch->type_id);
  $owner = User::get_by_id($couch->user_id);

  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/index.php');
  exit();
}

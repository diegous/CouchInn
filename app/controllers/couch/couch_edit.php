<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();

$content = "couch/couch_edit_view.php";
$title = "Editar datos de un couch";

if (isset($_GET["id"])) {
  $couch = Couch::get_by_id($_GET["id"]);
  include $DRV . "/skeleton.php";
} else {
header('Location: ' . '/couch/couch.php?id=' . $_GET["id"]);
  exit();
}

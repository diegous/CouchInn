<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();

$content = "couch_type/couch_type_edit_view.php";
$title = "Editar tipo de couch";

if (isset($_GET["id"])) {
  $couch_type = CouchType::get_by_id($_GET["id"]);
  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/couch_type/couch_type_list.php');
  exit();
}

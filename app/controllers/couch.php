<?php

include "loader.php";

$content = "couch_view.php";
$title = "Ver couch";

if ($_GET['id']) {
  $couch = Couch::get_by_id($_GET["id"]);
  $picture_list = Picture::get_by_couch_id($_GET["id"]);
  
  include "../views/skeleton.php";
} else {
  header('Location: ' . "index.php");
  exit();
}
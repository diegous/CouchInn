<?php
include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

if ($_POST["id"] && $_POST["title"] && $_POST["description"] && $_POST["capacity"] && $_POST["location"]) {
  
  $couch = Couch::get_by_id($_POST["id"]);

  $couch->title = $_POST['title'];
  $couch->description = $_POST['description'];
  $couch->capacity = $_POST['capacity'];
  $couch->location = $_POST['location'];

  $couch->update();

}

header('Location: ' . '/couch/couch.php?id=' . $_POST["id"]);
exit();

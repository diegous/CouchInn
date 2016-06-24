<?php
// include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";
$dont_check=true;
include $_SERVER['DOCUMENT_ROOT'] . "/couch/image/couch_image_validation.php";
include $_SERVER['DOCUMENT_ROOT'] . "/couch/image/couch_image_operations.php";


$requiredParams=["id","type","title","description","capacity","location"];
$files=$_FILES;
check_pre_upload($requiredParams,$files);

if ($_POST["id"] && $_POST["title"] && $_POST["type"] && $_POST['description'] && $_POST["capacity"] && $_POST["location"]) {

  $couch = Couch::get_by_id($_POST["id"]);

  $couch->title = $_POST['title'];
  $couch->description = $_POST['description'];
  $couch->type_id = $_POST['type'];
  $couch->capacity = $_POST['capacity'];
  $couch->location = $_POST['location'];

  $couch->update();

  image_operations($_POST,$_FILES,$couch->id);
}

echo json_encode($errorTable);

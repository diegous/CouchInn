<?php

include "loader.php";

$couch_type_id = $_GET["id"];

$couch_type = CouchType::get_by_id($couch_type_id);
$couch_type->delete();

header('Location: ' . "couch_type_list.php");
exit();
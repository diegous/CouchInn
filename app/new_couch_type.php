<?php

include "loader.php";

$couch_type = new CouchType(NULL, $_GET["description"]);
$couch_type->save_new();

header('Location: ' . "view_couch_types.php");

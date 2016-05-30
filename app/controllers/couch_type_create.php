<?php

include "loader.php";

$couch_type = new CouchType(NULL, $_POST["description"]);
$couch_type->save_new();

header('Location: ' . "couch_type_list.php");

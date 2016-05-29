<?php

include "loader.php";

$couch_type = new CouchType($_GET["id"], $_GET["description"]);
$couch_type->update();

header('Location: ' . "view_couch_types.php");

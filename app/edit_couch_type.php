<?php

include "loader.php";

$content = "couch_type_edit.php";
$title = "Editar tipo de couch";

$couch_type = CouchType::get_by_id($_GET["id"]);

include "views/skeleton.php";


<?php

include "loader.php";

$content = "couch_type_list.php";
$title = "Listado de tipos de couch";

$couch_type_list = CouchType::get_all();

include "views/skeleton.php";

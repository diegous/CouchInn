<?php

include "loader.php";

$content = "couch_create_view.php";
$title = "Dar couch de alta";

$couch_type_list=CouchType::get_all_enabled();

include "../views/skeleton.php";

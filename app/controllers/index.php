<?php

include "loader.php";

$title = "Inicio";
$content = "main.php";

$couch_list = Couch::get_all();

$couch_types = array();

foreach ($couch_list as $key => $couch) {
  $type_id = $couch->type_id;
  $couch_types[$type_id] = CouchType::get_by_id($type_id);
}

include "../views/skeleton.php";

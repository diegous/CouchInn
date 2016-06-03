<?php

include "loader.php";

$title = "Inicio";
$content = "main.php";

$couch_list = Couch::get_all();

$couch_types = array();
$images = array();

foreach ($couch_list as $couch) {
  $type_id = $couch->type_id;
  $couch_types[$type_id] = CouchType::get_by_id($type_id);

  $user = User::get_by_id($couch->user_id);

  // if couch owner is premium
  if ($user->is_premium) {
    $couch_images = Picture::get_by_couch_id($couch->id);

    // If couch has pictures, save first
    if ($couch_images) {
      $images[$couch->id] = $couch_images[0]->filename;
    }
  }
}

include "../views/skeleton.php";

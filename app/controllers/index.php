<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$title = "Inicio";
$content = "couch/couch_list_view.php";

$couch_list = Couch::get_all();
$couch_types = CouchType::get_all();

$images = get_pictures_for_coachs($couch_list);

if(isset($_SESSION['user']) && !($_SESSION['user']->is_admin)):
  $comment_list_user = CouchComment::get_by_user_id($_SESSION['user']->id);
endif;

include $DRV . "/skeleton.php";


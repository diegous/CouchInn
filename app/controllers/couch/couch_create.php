<?php



include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";
redirect_if_not_logged_in();

$content = "couch/couch_create_view.php";
$title = "Dar couch de alta";
$max_couch_photos=Couch::$maximum_amount_of_pictures;

$couch_type_list=CouchType::get_all_enabled();

include $DRV."/skeleton.php";

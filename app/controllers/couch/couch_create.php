<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$content = "couch_create_view.php";
$title = "Dar couch de alta";

$couch_type_list=CouchType::get_all_enabled();

include $DRV."/skeleton.php";

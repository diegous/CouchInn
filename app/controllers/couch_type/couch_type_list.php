<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();


$content = "couch_type/couch_type_list_view.php";
$title = "Listado de tipos de couch";

$couch_type_list = CouchType::get_all();

include $DRV . "/skeleton.php";

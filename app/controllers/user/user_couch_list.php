<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();



$title = "Mis Couchs";
$content = "couch/couch_list_view.php";
$couch_list=Couch::get_by_field_value('user_id',$_SESSION['user']->id);
$list_header="Listado de mis Couch";

include $DR . "/couch/couch_list_setup.php";
include $DRV . "/skeleton.php";

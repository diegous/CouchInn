<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$title = "Inicio";
$content = "couch/couch_list_view.php";

// function enabled_or_owned_by_user($couch){
//   return ($couch->enabled==1) || ($_SESSION['user']->id == $couch->user_id);
// }


$list_header="Listado de couch";

$user=(isset($_SESSION['user']) ? $_SESSION['user'] : null );
$couch_list = filter_couch_list_for_display(Couch::get_all(),$user);

include $DR . "/couch/couch_list_setup.php";
include $DRV . "/skeleton.php";


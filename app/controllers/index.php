<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$title = "Inicio";
$content = "couch/couch_list_view.php";

function enabled_or_owned_by_user($couch){
  return ($couch->enabled===1) || ($_SESSION['user']->id == $couch->user_id);
}

$list_header="Listado de couch";

if(isset($_SESSION['user'])){
  if($_SESSION['user']->is_admin){
    $couch_list = Couch::get_all();
  }else{
    $couch_list = array_filter(Couch::get_all(),"enabled_or_owned_by_user");
  }
}else{
  $couch_list =Couch::get_all_enabled();
}


include $DR . "/couch/couch_list_setup.php";
include $DRV . "/skeleton.php";


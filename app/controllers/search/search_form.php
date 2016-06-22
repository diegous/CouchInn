<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$content = "search/search_form_view.php";
$title = "Buscar Couchs";


// Set default values in case no search was made yet
$search_form['title'] = isset($_GET['title']) ? $_GET['title'] : "";
$search_form['location'] = isset($_GET['location']) ? $_GET['location'] : "";
$search_form['description'] = isset($_GET['description']) ? $_GET['description'] : "";
$search_form['couch_type'] = isset($_GET['couch_type']) ? $_GET['couch_type'] : 0;
$search_form['capacity'] = isset($_GET['capacity']) ? $_GET['capacity'] : 0;

// If
if (isset($_GET['title'])) {
  $couch_list = Couch::search($search_form['title'],
                              $search_form['description'],
                              $search_form['couch_type'],
                              $search_form['location'],
                              $search_form['capacity']);
  $user=(isset($_SESSION['user']) ? $_SESSION['user'] : null );
  $couch_list = filter_couch_list_for_display($couch_list,$user);
  $list_header="";
  include $DR . "/couch/couch_list_setup.php";
}


include $DRV . "/skeleton.php";

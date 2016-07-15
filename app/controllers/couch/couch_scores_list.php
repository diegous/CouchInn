<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();


$user = $_SESSION["user"];

$reservation_list = Reservation::get_by_couch_id($_GET['id']);
$couch_list = Couch::get_all();
$user_list = User::get_all();

$title = "Listado puntajes del Couch";
$content = "couch/couch_scores_list_view.php";

include $DRV."/skeleton.php";

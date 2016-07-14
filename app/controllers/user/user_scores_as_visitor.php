<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

$user=$_SESSION["user"];


$couch_list=Couch::get_all();
$reservation_list=Reservation::get_all_scored_reservations_for_user($user->id);
$owner_list=User::get_all();


$title="Listado puntajes como Usuario Visitante";
$content="user/user_scores_as_visitor_view.php";

include $DRV."/skeleton.php";



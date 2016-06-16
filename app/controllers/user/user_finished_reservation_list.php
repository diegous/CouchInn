<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

$user=$_SESSION["user"];


$couch_list=Couch::get_all();
$owner_list=User::get_all();
$reservation_list=
  Reservation::reservations_for_user_upto_date_in_state($user->id,today_formatted(),"Finalizada");

$title="Listado de Couchs donde me hospedé";
$content="/user/user_finished_reservation_list_view.php";

include $DRV."/skeleton.php";

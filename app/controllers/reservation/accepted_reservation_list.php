<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();


$content = "reservation/accepted_reservation_list_view.php";
$title = "Listado de reservas aceptadas";

$date_start=getDateOrFalse(isset($_GET["date_start"])?$_GET["date_start"]:"");

$date_end=getDateOrFalse(isset($_GET["date_end"])?$_GET["date_end"]:"");

if($date_start && $date_end){
  $couch_list=Couch::get_all();
  $user_list=User::get_all();
  $reservation_list=
    Reservation::reservations_by_state_between_dates("Confirmada",$date_start,$date_end);
}
include $DRV . "/skeleton.php";


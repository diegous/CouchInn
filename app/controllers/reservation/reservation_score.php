<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

$content = "reservation/reservation_score_view.php";
$title = "Puntuar reserva";

if ($_GET["id"] && $_GET["for"]) {
  $reservation = Reservation::get_by_id($_GET["id"]);
  $score_for = $_GET["for"];


  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/index.php');
  exit();
}

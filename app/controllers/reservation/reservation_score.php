<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

if ($_GET["id"] && $_GET["for"] && $_GET["score"]) {
  $reservation = Reservation::get_by_id($_GET["id"]);

  if ($_GET["for"] == "couch") {
    echo "entra al if";
    $reservation->score_for_couch = $_GET["score"];
    $redirect_to = "/user/user_reservation_list.php";
  } else {
    $reservation->score_for_user = $_GET["score"];
    $redirect_to = "/couch/couch.php?id=" . $reservation->couch_id;
  }

  $reservation->update();

  header('Location: ' . $redirect_to);
} else {
  header('Location: ' . 'index.php');
}
exit();

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

if ($_POST["for"]) {
  if ($_POST["id"] && $_POST["score"] && $_POST["comment"]) {
    $reservation = Reservation::get_by_id($_POST["id"]);

    if ($_POST["for"] == "couch") {
      $reservation->score_for_couch = $_POST["score"];
      $reservation->comment_for_couch = $_POST["comment"];
      $redirect_to = "/user/user_reservation_list.php";
      create_alert('success', 'Se guard&oacute; el puntaje del Couch');
    } else {
      $reservation->score_for_user = $_POST["score"];
      $reservation->comment_for_user = $_POST["comment"];
      $redirect_to = "/couch/couch.php?id=" . $reservation->couch_id;
      create_alert('success', 'Se guard&oacute; el puntaje del Usuario');
    }

    $reservation->update();

    header('Location: ' . $redirect_to);
  } else {
    create_alert('danger', 'Hubo alg&uacute;n problema para guardar el puntaje');
    header('Location: ' . '/reservation/reservation_score.php?id=8&for=' . $_POST['for']);
  }
} else {
  header('Location: ' . 'index.php');
}
exit();

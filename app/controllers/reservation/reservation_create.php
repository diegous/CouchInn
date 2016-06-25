<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

if (isset($_POST["start_date"]) && isset($_POST["end_date"]) && isset($_POST["couch_id"])) {
  $pending_state = ReservationState::get_by_description('Pendiente');

  $reservation = new Reservation(NULL,
                                 TRUE,
                                 $_SESSION['user']->id,
                                 $_POST["couch_id"],
                                 $pending_state->id,
                                 $_POST["start_date"],
                                 $_POST["end_date"]);

  $confirmed_reservation = Reservation::confirmed_reservation_conflicting_with($reservation);

  if ($confirmed_reservation) {
    $message = 'Su reserva se solapa con otra que va de <b>' . $confirmed_reservation->start_date . '</b>';
    $message .= ' a <b>' . $confirmed_reservation->end_date . '</b>';
    create_alert('danger', $message);
  } else {
    if ($reservation->save_new())
      create_alert('success', 'Su pedido de reserva se ha registrado exitosamente');
    else
      create_alert('danger', 'No se pudo crear el pedido de reserva');
  }

  header('Location: ' . '/couch/couch.php?id=' . $_POST['couch_id']);
  exit();

} else {

  header('Location: ' . '/');
  exit();

}


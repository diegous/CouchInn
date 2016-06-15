<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

if (isset($_GET["id"]) && isset($_GET["action"])) {
  $reservation = Reservation::get_by_id($_GET["id"]);
  $state_list = ReservationState::get_all();
  $users = User::get_all();

  if ($reservation && ($reservation->user_id == $_SESSION['user']->id)) {
    switch ($_GET["action"]) {
      case "confirm":
        $reservation->state_id = $state_list["Confirmada"];
        $reservation->update();
        $message = 'La reserva fue confirmada';

        if ($rejected_reservations = Reservation::cancel_conflicting_reservations($reservation)){
          $message .= ". Las siguientes reservas fueron rechazadas:";
          foreach ($rejected_reservations as $rejected) {
            $message .= "<br>- Para " . $users[$rejected->user_id]->email;
            $message .= " de " . $rejected->start_date . " a " . $rejected->end_date;
          }
        }

        create_alert('success', $message);
        break;
      case "reject":
        $reservation->state_id = $state_list["Rechazada"];
        $reservation->update();
        create_alert('success', "La reserva fue rechazada");
        break;
      case "finalize":
        $reservation->state_id = $state_list["Finalizada"];
        $reservation->update();
        break;
      case "expire":
        $reservation->state_id = $state_list["Vencida"];
        $reservation->update();
        break;
      default:
        create_alert('danger', "No se pudo modificar la reserva");
    }
    header('Location: ' . "/couch/couch.php?id=" . $reservation->couch_id);
    exit();
  }

  header('Location: ' . "/");
  exit();
}

header('Location: ' . "/");
exit();

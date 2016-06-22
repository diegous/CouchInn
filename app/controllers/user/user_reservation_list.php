<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

$user=$_SESSION["user"];


$couch_list=Couch::get_all();
$owner_list=User::get_all();
$reservations=Reservation::reservations_for_user($user->id);
$reservation_states=reservationState::get_all();
$reservation_map=reservations_to_a_map($reservations);

function reservations_to_a_map($reservation_list){
  $reservation_states=$GLOBALS["reservation_states"];
  $reservation_map=[
    "Pendiente"=>array(),
    "Confirmada"=>array(),
    "Rechazada"=>array(),
    "Finalizada"=>array(),
    "Vencida"=>array()
  ];
  foreach ($reservation_list as $value) {
    $reservation_state=$reservation_states[$value->state_id];
    $reservation_map[$reservation_state->description][]=$value;
  }
  return $reservation_map;
}

$orden_de_reservas=[
  "Finalizada",
  "Vencida",
  "Pendiente",
  "Confirmada",
  "Rechazada"
];


$title="Listado de Couchs donde me hospedé";
$content="/user/user_reservation_list_view.php";

include $DRV."/skeleton.php";



/*

  Edit Edit   Copy Copy   Delete Delete   1   1   Pendiente
  Edit Edit   Copy Copy   Delete Delete   2   1   Confirmada
  Edit Edit   Copy Copy   Delete Delete   3   1   Rechazada
  Edit Edit   Copy Copy   Delete Delete   4   1   Finalizada
  Edit Edit   Copy Copy   Delete Delete   5   1   Vencida
*/

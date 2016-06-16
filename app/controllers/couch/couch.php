<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$alert_variables = check_for_alert();

$content = "couch/couch_view.php";
$title = "Ver couch";

if (isset($_GET['id'])) {
  $couch = Couch::get_by_id($_GET["id"]);
  $picture_list = Picture::get_by_couch_id($_GET["id"]);
  $couch_type = CouchType::get_by_id($couch->type_id);
  $owner = User::get_by_id($couch->user_id);
  $comment_list = CouchComment::get_by_couch_id($_GET["id"]);

  $state_list = ReservationState::get_all();
  $reservation_list = Reservation::get_by_couch_id($_GET['id']);
  $user_list = User::get_all();

  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/index.php');
  exit();
}

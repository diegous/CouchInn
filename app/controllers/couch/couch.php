<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";



$content = "couch/couch_view.php";
$title = "Ver couch";

if (isset($_GET['id'])) {
  $couch = Couch::get_by_id($_GET["id"]);

  if( ! $couch->is_enabled() ){
    $visible = isset($_SESSION['user']) && $couch->is_visible_for_user( $_SESSION['user'] );
    if( ! $visible ){
      header('Location: ' . '/index.php');
      exit();
    }
  }

  $picture_list = Picture::get_by_couch_id($_GET["id"]);
  $couch_type = CouchType::get_by_id($couch->type_id);
  $owner = User::get_by_id($couch->user_id);
  $comment_list = CouchComment::get_by_couch_id($_GET["id"]);
//  $comment_couch_user = Couch::get_by_id($comment_list_user->couch_id);

  $state_list = ReservationState::get_all();
  $reservation_list = Reservation::get_by_couch_id($_GET['id']);
  $user_list = User::get_all();

  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/index.php');
  exit();
}

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$user_logged_in=!empty($_SESSION) && $_SESSION['user'];

if (isset($_GET['id'])){
	$user = User::get_by_id($_GET['id']);
	
	$content = "user/user_profile_view.php";
	$title = "Listado de datos de usuario";

  $list_of_scores=Reservation::get_all_scores_for_user($user->id);
  $average_score=
    ( count($list_of_scores)>0 ?
      array_sum($list_of_scores)/count($list_of_scores) : null );
  

	include $DRV . "/skeleton.php";
}


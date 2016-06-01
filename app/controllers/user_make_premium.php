<?php

include "loader.php";




$user_logged_in=!empty($_SESSION) && $_SESSION['user'];
$user_was_premium=$user_logged_in && $_SESSION['user']->is_premium;
$user_has_paid=isset($_POST["paid_for_premium"])&& !empty($_POST["paid_for_premium"]);

if($user_logged_in){
	
	$content="user_make_premium_view.php";
	$title = "Solicitacion de cuenta premium";

	if($user_has_paid){

		$_SESSION['user']->is_premium=true;
		$_SESSION['user']->update();
		
	}


	include "../views/skeleton.php";

}


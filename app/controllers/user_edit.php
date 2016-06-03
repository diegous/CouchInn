<?php

include "loader.php";

$user_logged_in=!empty($_SESSION) && $_SESSION['user'];

if($user_logged_in){
	$content = "user_edit_view.php";
	$title = "Listado de datos de usuario";

	$user = $_SESSION['user'];
	include "../views/skeleton.php";
}


//couchinn/app/controllers
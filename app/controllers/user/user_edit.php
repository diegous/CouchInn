<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$user_logged_in=!empty($_SESSION) && $_SESSION['user'];

if($user_logged_in){
	$content = "user/user_edit_view.php";
	$title = "Modificar datos de usuario";

	$user = $_SESSION['user'];
	include $DRV . "/skeleton.php";
}


//couchinn/app/controllers

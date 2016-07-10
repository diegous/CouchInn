<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$user_logged_in=!empty($_SESSION) && $_SESSION['user'];

if($user_logged_in){
	$content = "user/user_profile_view.php";
	$title = "Listado de datos de usuario";

	$user = $_SESSION['user'];
	include $DRV . "/skeleton.php";
}
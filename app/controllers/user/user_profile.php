<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$user_logged_in=!empty($_SESSION) && $_SESSION['user'];

if (isset($_GET['id'])){
	$user = User::get_by_id($_GET['id']);
	
	$content = "user/user_profile_view.php";
	$title = "Listado de datos de usuario";

	include $DRV . "/skeleton.php";
}
<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_logged_in();

$user_was_premium=$_SESSION['user']->is_premium;
$user_has_paid=isset($_SESSION["just_became_premium"]) && $_SESSION["just_became_premium"]==true ;



$content = "user/user_make_premium_view.php";
$title = "Solicitacion de cuenta premium";

if($user_has_paid){
  $_SESSION["just_became_premium"]=false;
  $_SESSION['user']->is_premium=true;
	$_SESSION['user']->update();

}

include $DRV . "/skeleton.php";



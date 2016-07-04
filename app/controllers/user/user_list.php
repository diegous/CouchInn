<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();

$title = "Lista de usuarios";
$content = "user/user_list_view.php";

$user_list = User::get_all();

include $DRV . "/skeleton.php";

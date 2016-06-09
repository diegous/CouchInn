<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$content = "shared/alert_page_view.php";
$title = $_POST["title"];
$url = $_POST["url"];
$message = $_POST["message"];

include $DRV . "/skeleton.php";

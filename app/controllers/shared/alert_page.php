<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$content = "shared/alert_page_view.php";
$title = $_GET["title"];
$url = $_GET["url"];
$message = $_GET["message"];

include $DRV . "/skeleton.php";

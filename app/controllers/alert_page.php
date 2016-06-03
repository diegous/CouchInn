<?php

include "loader.php";

$content = "alert_page_view.php";
$title = $_POST["title"];
$url = $_POST["url"];
$message = $_POST["message"];

include "../views/skeleton.php";

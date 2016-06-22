<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_with_alert($_GET["alert"],$_GET["message"],$_GET["url"]);

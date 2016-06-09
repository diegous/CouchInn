<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();

$content = "payment/payment_between_dates_view.php";
$title = "Ganancias entre dos fechas";

include $DRV . "/skeleton.php";


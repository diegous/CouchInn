<?php

$check_card_step=false;
include $_SERVER['DOCUMENT_ROOT'] . "/payment/payment_system_validation.php";

redirect_if_not_logged_in();

$content = "payment/payment_system_view.php";
$title = "Sistema de Pago";

include $DRV . "/skeleton.php";

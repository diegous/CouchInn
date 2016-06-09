<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$check_card_step=false;
include $DR . "/payment/payment_system_validation.php";

$content = "payment_system_view.php";
$title = "Sistema de Pago";
include $DRV . "/skeleton.php";




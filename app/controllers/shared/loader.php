<?php

// Define document root shorthand. Document root is at app/controllers/
// DR -> /app/controllers
$DR = $_SERVER['DOCUMENT_ROOT'];
// DRV -> /app/views
$DRV = $DR . "/../views";

// Include Classes
include $DR . "/../model/GenericModel.php";
include $DR . "/../model/User.php";
include $DR . "/../model/CouchType.php";
include $DR . "/../model/Couch.php";
include $DR . "/../model/Picture.php";
include $DR . "/../model/Payment.php";

// Include Helper functions
include $DR . "/shared/helper_functions.php";

// Start session (this must start after loading the classes)
session_start();

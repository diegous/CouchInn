<?php

// Define document root shorthand. Document root is at app/controllers/
// DR -> /app/controllers
$DR = $_SERVER['DOCUMENT_ROOT'];
// DRV -> /app/views
$DRV = $DR . "/../views";

$PICTUREDIR = "/resources/images";
$COUCHPICTUREDIR = $PICTUREDIR."/couches";
$COUCHPICTUREDIRFULL = $DR.$COUCHPICTUREDIR;


// Include Classes
include $DR . "/../model/GenericModel.php";
include $DR . "/../model/Couch.php";
include $DR . "/../model/CouchType.php";
include $DR . "/../model/Payment.php";
include $DR . "/../model/CouchComment.php";
include $DR . "/../model/Picture.php";
include $DR . "/../model/Reservation.php";
include $DR . "/../model/ReservationState.php";
include $DR . "/../model/User.php";

// Include Helper functions
include $DR . "/shared/helper_functions.php";

// Start session (this must start after loading the classes)
session_start();

/*
 *  Constructores estaticos
 */
Picture::class_initialize();

// Load comments for a user's couchs
if (isset($_SESSION['user']) && !($_SESSION['user']->is_admin)) {
  $comment_list_user = CouchComment::get_by_user_id($_SESSION['user']->id);
}

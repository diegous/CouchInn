<?php

// Include Classes
include "../../model/GenericModel.php";
include "../../model/User.php";
include "../../model/CouchType.php";
include "../../model/Couch.php";
include "../../model/Picture.php";
include "../../model/Payment.php";

// Start session (this must start after loading the classes)
session_start();

// Function to get DB connection used by classes
function get_connection() {
  $con = new mysqli("localhost", "root", "", "couchinn");

  if ($con->connect_error)
    die('Connect Error: ' . $con->connect_error);

  return $con;
}

// Session checkers
function redirect_if_not_logged_in() {
  if (!isset($_SESSION['user'])) {
    header('Location: ' . 'index.php');
    exit();
  }
}

function redirect_if_not_admin() {
  if (!isset($_SESSION['user']) || !$_SESSION['user']->is_admin) {
    header('Location: ' . 'index.php');
    exit();
  }
}

function redirect_if_logged_in() {
  if (isset($_SESSION['user'])) {
    header('Location: ' . 'index.php');
    exit();
  }
}

function create_alert($alert, $message) {
    $_SESSION['alert'] = $alert;
    $_SESSION['message'] = $message;
}

function check_for_alert() {
  if (isset($_SESSION['alert']) && isset($_SESSION['message'])) {
    $alert_variables = [
      "alert"   => $_SESSION['alert'],
      "message" => $_SESSION['message'],
    ];

    unset($_SESSION['alert']);
    unset($_SESSION['message']);

    return $alert_variables;
  } else {
    return NULL;
  }
}

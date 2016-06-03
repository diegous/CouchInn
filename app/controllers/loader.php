<?php


// Include Classes
include "../model/GenericModel.php";
include "../model/User.php";
include "../model/CouchType.php";
include "../model/Couch.php";
include "../model/Picture.php";

// Start session (this must start after loading the classes)
session_start();

// Function to get DB connection used by classes
function get_connection() {
  $con = new mysqli("localhost", "root", "", "couchinn");

  if ($con->connect_error)
    die('Connect Error: ' . $con->connect_error);

  return $con;
}

// If user isn't loged in
function check_login() {
  if (!$_SESSION['user']) {
    header('Location: ' . 'index.php');
    exit();
  }
}

// If user isn't admin, redirect to home page
function check_admin() {
  if (!$_SESSION['user'] || !$_SESSION['user']->is_admin) {
    header('Location: ' . 'index.php');
    exit();
  }
}

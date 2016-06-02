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
function get_connection(){
  $con = new mysqli("localhost", "root", "", "couchinn");

  if ($con->connect_error)
    die('Connect Error: ' . $con->connect_error);

  return $con;
}

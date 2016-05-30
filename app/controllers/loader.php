<?php

include "../model/GenericModel.php";
include "../model/User.php";
include "../model/CouchType.php";

function get_connection(){
  $con = new mysqli("localhost", "root", "", "couchinn");

  if ($con->connect_error)
    die('Connect Error: ' . $con->connect_error);

  return $con;
}

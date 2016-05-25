<?php

$content = "main.php";

$con = new mysqli("localhost", "root", "", "couchinn");

if (mysqli_connect_errno()) {
    echo "error: " . mysqli_connect_errno();
} else {
    $result = $con->query("SELECT * FROM users");
    $user_amount = $result->num_rows;

    $result->close();
}

mysqli_close($con);

include("views/skeleton.php");
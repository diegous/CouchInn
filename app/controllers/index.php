<?php

include "loader.php";

$title = "Inicio";

$content = "main.php";
// -------------- TEST - GET_BY_ID
// $a_user = User::get_by_id(19);
// echo $a_user;
// echo "<br><br><br>";

// -------------- TEST - DELETE
// if ($a_user->delete() === TRUE)
//   echo "se borro";
// else
//   echo "NO BORRO NADA";

// -------------- TEST - NEW USER
// $a_new_user = new User(19, "mailPI@m.c", "123", "UP-GREYED2", NULL, NULL, NULL, 0,  0);
// echo $a_new_user;
// echo "<br><br><br>";

// -------------- TEST - UPDATE
// if ( $a_new_user->update() )
//   echo "update successfull";
// else
//   echo " - - NO UPDATE - - ";
// echo "<br><br><br>";

// -------------- TEST - SAVE_NEW
// $a_new_user->save_new();
// echo "new user id: " . $a_new_user->id . "<br><br>";

// -------------- TEST - GET_ALL
// $users = User::get_all();
// foreach ($users as $key => $value)
//   echo $value . "<br>";

//////////
//	Controlador de couch_list
//////////
$couch_list = Couch::get_all();
//////////

include "../views/skeleton.php";

<?php

include "loader.php";

$errors_table=Array();

if ( ! $email = $_POST['email']) {
	$errors_table["error_email"]="empty";
}elseif(User::exist_user($email)){
	$errors_table["error_email"]="user exists";
}

if ( ! $password = $_POST['password'] ) {
	$errors_table["error_password"]="empty";
}

//si no hay errores
if( count($errors_table)==0 ){
	$name      = $_POST['name'] ? $_POST['name'] : NULL;
	$last_name = $_POST['last_name'] ? $_POST['last_name'] : NULL;
	$birthday  = $_POST['birthday'] ? $_POST['birthday'] : NULL;
	$phone     = $_POST['phone'] ? $_POST['phone'] : NULL;

	$user = new User(NULL, TRUE, $email, $password, $name, $last_name, $birthday, $phone, 0, 0);
	$user->save_new();

	echo "";
}
echo json_encode($errors_table);

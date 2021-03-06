<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$errors_table=Array();

if ( ! $email = $_POST['email']) {
	$errors_table["error_email"]="vacio";
}elseif(User::exist_user($email)){
	$errors_table["error_email"]="email ya existe";
}

if ( ! $password = $_POST['password'] ) {
	$errors_table["error_password"]="vacio";
}

//si no hay errores
if( count($errors_table)==0 ){
	$name      = $_POST['name'] ? $_POST['name'] : NULL;
	$last_name = $_POST['last_name'] ? $_POST['last_name'] : NULL;
	$birthday  = $_POST['birthday'] ? $_POST['birthday'] : NULL;
	$phone     = $_POST['phone'] ? $_POST['phone'] : NULL;

	if ($_SESSION['user']->is_admin) {
		$is_admin = 1;
	} else {
		$is_admin = 0;
	}

	$user = new User(NULL, TRUE, $email, $password, $name, $last_name, $birthday, $phone, $is_admin, 0);
	$user->save_new();

	echo "success";
}else{

	echo json_encode($errors_table);
}

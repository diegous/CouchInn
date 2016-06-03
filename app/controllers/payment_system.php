<?php

include "loader.php";



$check_card_step=isset($_POST["codigo_tarjeta"])&& !empty($_POST["codigo_tarjeta"]);
$regex_tarjeta=Array();

$wronginput=false;
$regex_map=[
	"credito"=>"\d{3} \d{5} \d{14}",
	"debito"=>"\d{9} \d{6} \d{3}",
];
if($check_card_step){
	$regex_tarjeta=$regex_map[$_POST["type_card"]];
	$wronginput=$check_card_step && !preg_match('/'.$regex_tarjeta.'/',$_POST["codigo_tarjeta"]);

	if(!$wronginput){
		echo "<form action='user_make_premium.php' method='post' name='frm'>
		<input type='hidden' name='paid_for_premium' value='true' >
	</form>
	<script language='JavaScript'> document.frm.submit(); </script>";			
	}
}

if($wronginput || !$check_card_step){
	$content = "payment_system_view.php";
	$title = "Sistema de Pago";
	include "../views/skeleton.php";
}


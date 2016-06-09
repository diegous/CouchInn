<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";



if(! isset($check_card_step) )
  $check_card_step=isset($_POST["codigo_tarjeta"])&& !empty($_POST["codigo_tarjeta"]);


$regex_map=[
  "credito"=>"\d{3} \d{5} \d{14}",
];

if($check_card_step){
  $regex_tarjeta=$regex_map[$_POST["type_card"]];
  if(preg_match('/'.$regex_tarjeta.'/',$_POST["codigo_tarjeta"])){
    $_SESSION["just_became_premium"]=true;
    echo json_encode(["error"=>false]);
  }else{
    echo json_encode(["error"=>true]);
  }
}

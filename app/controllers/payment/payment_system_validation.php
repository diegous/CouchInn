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
    if(isset($_POST["finish_transaction"])&& !empty($_POST["finish_transaction"])){
      echo "<form action='/user/user_make_premium.php' method='post' name='frm'>
       <input type='hidden' name='paid_for_premium' value='true' hidden='true'>
       </form>
       <script language='JavaScript'> document.frm.submit(); </script>";
    }else{
      echo json_encode(["error"=>false]);
    }
  }else{
    echo json_encode(["error"=>true]);
  }
}

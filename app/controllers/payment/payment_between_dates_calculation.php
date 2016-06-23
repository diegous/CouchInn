<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

redirect_if_not_admin();


$errorTable=Array();

$date_start=getDateOrFalse((isset($_POST["date_start"])&& !empty($_POST["date_start"]))
                                ?$_POST["date_start"]:"");

$date_end=getDateOrFalse((isset($_POST["date_end"])&& !empty($_POST["date_end"]))
                                ?$_POST["date_end"]:"");


if( $date_start && $date_end ){

  if($date_start > $date_end){
    $errorTable["error"]="fechas mal escritas";
  }else{
    $lista= Payment::all_between_dates($date_start,$date_end) ;
    $errorTable["error"]=false;
    $errorTable["sum"]=0;
    foreach ($lista as $value) {
      $errorTable["sum"]+= $value->amount ;
    }
  }
}else{
  $errorTable["error"]=(
    ($date_start?"":" (fecha inicio mal escrita) ").
    ($date_end?"":" (fecha fin mal escrita) ")
  );



}


echo json_encode($errorTable);

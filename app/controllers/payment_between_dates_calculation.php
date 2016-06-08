<?php 

include "date_validation.php";
include "loader.php";


$errorTable=Array();

$date_start=getDateOrFalse((isset($_POST["date_start"])&& !empty($_POST["date_start"]))
                                ?$_POST["date_start"]:"");

$date_end=getDateOrFalse((isset($_POST["date_end"])&& !empty($_POST["date_end"]))
                                ?$_POST["date_end"]:"");

function payment_between_dates($start,$end) {

  $query = 'SELECT * FROM payments';
  $query .= ' WHERE date BETWEEN "' . $start . '" AND "' . $end . '";';

  $result = array();
  if($connection = get_connection()){

    $query_result = $connection->query($query);


    while ($row = $query_result->fetch_assoc())
      $result[] = $row["amount"];

    $query_result->close();
    $connection->close();
      
  }

  return $result;
}

if( $date_start && $date_end ){
  
  if($date_start > $date_end){
    $errorTable["error"]="fechas mal escritas";
  }else{
    $lista= payment_between_dates($date_start,$date_end) ;
    $errorTable["error"]=false;
    $errorTable["sum"]=0;
    foreach ($lista as $value) {
      $errorTable["sum"]+= $value ;
    }
  }
}else{
  $errorTable["error"]=(
    ($date_start?"":" (fecha inicio mal escrita) ").
    ($date_end?"":" (fecha fin mal escrita) ")
  );
  


}


echo json_encode($errorTable);

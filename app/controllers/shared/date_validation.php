<?php

$date_format_couchinn='Y-m-d';

function getDateOrFalse($str){
  if(($timestamp = DateTime::createFromFormat($GLOBALS["date_format_couchinn"], $str))==true){
    return date($GLOBALS["date_format_couchinn"],$timestamp->getTimestamp());
  }else{
    return false;
  }
}

function today_formatted(){
  return date($GLOBALS["date_format_couchinn"]);
}

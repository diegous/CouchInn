<?php

function getDateOrFalse($str){
  if(($timestamp = DateTime::createFromFormat('Y-m-d', $str))==true){
    return date("Y-m-d",$timestamp->getTimestamp());
  }else{
    return false;
  }
}

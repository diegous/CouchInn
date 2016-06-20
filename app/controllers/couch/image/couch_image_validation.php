<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

function filter_array_keys(array $array, $callback){
  $ret=array();
  foreach ($array as $key => $value) {
    if($callback($key)){
      $ret[$key]=$value;
    }
  }
  return $ret;
}

function map_keys($callback,array $array){
  $ret=array();
  foreach ($array as $key => $value) {
    $ret[$callback($key)]=$value;
  }

  return $ret;
}


function filtermap_keys($callback,array $array){
  $ret=array();
  foreach ($array as $key => $value) {
    $newKey=$callback($key);
    if($newKey!==null){
      $ret[$newKey]=$value;
    }
  }
  return $ret;
}


function unloaded_files($array){
  $callable=function($val){return strpos($val,"file")===0;};
  return array_keys(filter_array_keys($array,$callable));
}

function what_params_dont_exist($requiredParams,$paramArray){
  return array_diff ($requiredParams, array_keys($paramArray));
}

function what_elems_are_empty($array,$ignoredFunction=null){
  if(!$ignoredFunction)
    $ignoredFunction=function($val){return strpos($val,"file")!==0;};
  $res=filter_array_keys($array,$ignoredFunction);
  $res=array_keys(array_filter($res,function($val){return $val==="";}));
  return $res;
}

function what_elems_are_not_images($paramArray){
  $callable=function($val){
    $pos=strpos($val["type"],'image/');
    return $pos!==0;
  };
  return array_filter($paramArray,$callable);
}

function which_files_exist_already($files){
  $callable=function($val){return file_exists(Picture::get_full_path($val["name"]));};
  return array_filter($files , $callable);
}

function what_images_are_too_big($files){
  $callable=function($val){return $val["size"] > Picture::$size_limit;};
  return array_filter($files , $callable);
}

function first_number_in_string($string){
  $matches=null;
  preg_match('/\d+/', $string, $matches);
  return $matches[0];
}

function exit_if_error(){
  $errorTable=$GLOBALS["errorTable"];
  if($errorTable["error"]!==false){
    exit(json_encode($errorTable));
  }
}

function check_form_sent($requiredParams){
  
  $errorTable=$GLOBALS["errorTable"];
  $absentList=what_params_dont_exist($requiredParams,$_POST);
  if(count($absentList)>0){
    $errorTable["error"]="absent elems";
    $errorTable["errorMessage"]="Campos no enviados:".json_encode($absentList);
  }

  exit_if_error();
}


function check_for_empty_fields($form_elems){
  $errorTable=$GLOBALS["errorTable"];
  $emptyParams=what_elems_are_empty($form_elems);
  if(count($emptyParams)>0){
    $errorTable["error"]="empty fields";
    $errorTable["errorMessage"]="campos vacios".json_encode($emptyParams);
  }
  exit_if_error();
}



function check_valid_image_files($files){
  $errorTable=$GLOBALS["errorTable"];
  if(count($files)+count(unloaded_files($_POST)) !==(Couch::$maximum_amount_of_pictures)){
    $errorTable["error"]="no images";
    $errorTable["errorMessage"]="No se estan enviando las imagenes seleccionadas";
  }else{
    $nonPictures=what_elems_are_not_images($files);
    if( count($nonPictures)>0 ) {
      $errorTable["error"]="non image";
      $filenames=array_values(array_map(function($val){ return $val["name"];},$nonPictures));
      $errorTable["errorMessage"]="Subio archivos que no son imagenes:";
      $inputNames=array_keys(array_map(function($val){ return $val["name"];},$nonPictures));
      $errorTable["which"]=$inputNames;
    }else{
      $bigFiles=what_images_are_too_big($files);
      if(count($bigFiles)>0){
        $errorTable["error"]="too big";
        $inputField=array_keys(array_map(function($val){ return $val["name"];},$bigFiles));
        $errorTable["errorMessage"]="Archivos demasiado grandes";
        $errorTable["which"]=$inputField;
        
      }else{
        $existingFiles=which_files_exist_already($files);
        if((count($existingFiles)>0)){
          $errorTable["error"]="impossible";
          $errorTable["errorMessage"]="Archivos ya existen:".json_encode($existingFiles);
        }
      }
    }
  }
  exit_if_error();
}



function check_pre_upload($requiredParams,$files){
  $errorTable=$GLOBALS["errorTable"];
  check_form_sent($requiredParams);
  check_for_empty_fields($_POST);
  check_valid_image_files($files);
}

$errorTable=[
  "error"=>false
];

if( ! isset($dont_check ) ){
  $requiredParams=["userid","type","titulo","descripcion","capacidad","lugar"];
  $files=$_FILES;
  check_pre_upload($requiredParams,$files);
  
  echo json_encode($errorTable);
}


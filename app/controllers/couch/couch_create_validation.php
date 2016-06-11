<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$errorTable=[
  "error"=>false
];

function filter_array_keys(array $array, $callback){
    $matchedKeys = array_filter(array_keys($array), $callback);

    return array_intersect_key($array, array_flip($matchedKeys));
}

function unloadedFiles($array){
  $callable=function($val){return strpos($val,"file")===0;};
  return array_keys(filter_array_keys($array,$callable));
}

function whatParamsDontExist($requiredParams,$paramArray){
  return array_diff ($requiredParams, array_keys($paramArray));
}

function whatElemsAreEmpty($array,$ignoredFunction=null){
  if(!$ignoredFunction)
    $ignoredFunction=function($val){return strpos($val,"file")!==0;};
  $res=filter_array_keys($array,$ignoredFunction);
  $res=array_keys(array_filter($res,function($val){return $val==="";}));
  return $res;
}

function whatElemsAreNotImages($paramArray){
  $callable=function($val){return strpos($val["type"],'image')!==0 ;};
  return array_filter($paramArray,$callable);
}

function whichFilesExistAlready($files){
  $callable=function($val){return file_exists($GLOBALS["COUCHPICTUREDIR"]."/".$val["name"]);};
  return array_filter($files , $callable);
}

function whatImagesAreTooBig($files){
  $callable=function($val){return $val["size"] > Picture::$size_limit;};
  return array_filter($files , $callable);
}

function firstNumberInString($string){
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

$requiredParams=["userid","type","titulo","descripcion","capacidad","lugar"];
$absentList=whatParamsDontExist($requiredParams,$_POST);
if(count($absentList)>0){
  $errorTable["error"]="absent elems";
  $errorTable["errorMessage"]="Campos no enviados:".json_encode($absentList);
}

exit_if_error();

$emptyParams=whatElemsAreEmpty($_POST);
if(count($emptyParams)>0){
  $errorTable["error"]="empty fields";
  $errorTable["errorMessage"]="campos vacios".json_encode($emptyParams);
}

exit_if_error();

$files=$_FILES;
if(count($_FILES)+count(unloadedFiles($_POST)) !==(Couch::$maximum_amount_of_pictures)){
  $errorTable["error"]="no images";
  $errorTable["errorMessage"]="No se estan enviando las imagenes seleccionadas";
}else{
  $nonPictures=whatElemsAreNotImages($files);
  if( count($nonPictures)>0 ) {
    $errorTable["error"]="non image";
    $filenames=array_values(array_map(function($val){ return $val["name"];},$nonPictures));
    $errorTable["errorMessage"]="Subio archivos que no son imagenes:";
    $inputNames=array_keys(array_map(function($val){ return $val["name"];},$nonPictures));
    $errorTable["which"]=$inputNames;
  }else{
    $bigFiles=whatImagesAreTooBig($files);
    if(count($bigFiles)>0){
      $errorTable["error"]="too big";
      $names=array_keys(array_map(function($val){ return $val["name"];},$bigFiles));
      $errorTable["errorMessage"]="Archivos demasiado grandes";
      $errorTable["which"]=$names;
      
    }else{
      $existingFiles=whichFilesExistAlready($files);
      if((count($existingFiles)>0)){
        $errorTable["error"]="impossible";
        $errorTable["errorMessage"]="Archivos ya existen:".json_encode($existingFiles);
      }
    }
  }
}


exit_if_error();
// $errorTable["error"]="dummy";
// $errorTable["errorMessage"]="dummy:\n".json_encode(array_keys($_FILES));
// exit_if_error();


$couch = new Couch(NULL, TRUE, TRUE, intval($_POST["userid"]), intval($_POST["type"]), $_POST["titulo"],
                       $_POST["descripcion"], intval($_POST["capacidad"]), $_POST["lugar"]);
$errorTable["error"]= ! $couch->save_new();
if ($errorTable["error"]) {
  $errorTable["errorMessage"]='No se pudo crear el couch';
} else {
  $errorTable["errorMessage"]='Fue agregado un nuevo couch';
}

exit_if_error();

$noneUploaded=Array();
foreach ($files as $key=>$file) {
  $couchImageId=firstNumberInString($key);
  $imageFilename=($couch->user_id.'-'.$couch->id.'-'.$couchImageId);
  $imagePath=$COUCHPICTUREDIRFULL."/".$imageFilename;

  if (move_uploaded_file($file["tmp_name"], $imagePath)) {
    $picture=new Picture(NULL,true,intval($couch->id),$imageFilename);
    $errorTable["error"]= ! $picture->save_new();
    if ($errorTable["error"]) {
      $errorTable["errorMessage"]='No se pudo crear el couch';
    } else {
      $errorTable["errorMessage"]='Fue agregado un nuevo couch';
    }  
    exit_if_error();
  } else {
    $noneUploaded[]=$file["name"];
  }
}


if(count($noneUploaded)>0){
  $errorTable["error"]="upload";
  $errorTable["errorMessage"]="No se pudo subir las imagenes '".$noneUploaded."'";
}


echo json_encode($errorTable);


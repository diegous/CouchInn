<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$errorTable=[
  "error"=>true
];


$errorTable["error"]= ! isset($_POST["titulo"]);

if($errorTable["error"]){
  $errorTable["errorMessage"]="no envio titulo por post";
}else{
  $couch = new Couch(NULL, TRUE, TRUE, intval($_POST["userid"]), intval($_POST["type"]), $_POST["titulo"], $_POST["descripcion"], intval($_POST["capacidad"]), $_POST["lugar"]);
  $errorTable["error"]= ! $couch->save_new();
  if ($errorTable["error"]) {
    $errorTable["errorMessage"]='No se pudo crear el couch';
  } else {
    $errorTable["errorMessage"]='Fue agregado un nuevo couch';
  }
}


echo json_encode($errorTable);


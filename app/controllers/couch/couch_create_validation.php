<?php

$dont_check=true;
include $_SERVER['DOCUMENT_ROOT'] . "/couch/image/couch_image_validation.php";
include $_SERVER['DOCUMENT_ROOT'] . "/couch/image/couch_image_operations.php";

//test for  structure
// $imageData=createImageData($_POST,$_FILES);
// exit(
//   'nope:<br>$_POST:'.json_encode($_POST).
//   '<br>$_FILES'.json_encode($_FILES).
//   '<br>processed:'.json_encode($imageData)
// );

$requiredParams=["userid","type","titulo","descripcion","capacidad","lugar"];
$files=$_FILES;
check_pre_upload($requiredParams,$files);

$couch = new Couch(
    NULL,
    TRUE,
    TRUE,
    intval($_POST["userid"]),
    intval($_POST["type"]),
    $_POST["titulo"],
    $_POST["descripcion"],
    intval($_POST["capacidad"]),
    $_POST["lugar"]
  );
$errorTable["error"] = ! $couch->save_new();
if ($errorTable["error"]) {
  $errorTable["errorMessage"]='No se pudo crear el couch';
} else {
  $errorTable["errorMessage"]='Fue agregado un nuevo couch';

}
$errorTable["couchId"]=$couch->id;

exit_if_error();

image_operations($_POST,$_FILES,$couch->id);

// $noneUploaded=Array();
// foreach ($files as $key=>$file) {
//   $couchImageId = first_number_in_string($key);
//   $imageFilename =
//     ($couch->id.'-'.$couchImageId.".".pathinfo($file["name"],PATHINFO_EXTENSION));
//   $imagePath=$COUCHPICTUREDIRFULL."/".$imageFilename;

//   if (move_uploaded_file($file["tmp_name"], $imagePath)) {
//     $picture = new Picture(NULL,true,intval($couch->id),$imageFilename);
//     $errorTable["error"] = ! $picture->save_new();
//     if ($errorTable["error"]) {
//       $errorTable["errorMessage"] = 'No se pudo crear un Picture';
//     } else {
//       $errorTable["errorMessage"] = 'Fue agregado un Picture';
//     }  
//     exit_if_error();
//   } else {
//     $noneUploaded[] = $file["name"];
//   }
// }


// if(count($noneUploaded) > 0){
//   $errorTable["error"] = "upload";
//   $errorTable["errorMessage"] =
//     "No se pudo subir las imagenes '".json_encode($noneUploaded)."'";
// }


echo json_encode($errorTable);


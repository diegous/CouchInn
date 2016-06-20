<?php 





function file_op_picture($imagedata,$couch_id,$oldfilename,$beforeCallback,$afterCallback){

  $file=$imagedata["file"];

  $errorTable=$GLOBALS["errorTable"];

  $oldImagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$oldfilename;
  $newfilename=
    substr($oldfilename,0,strrpos($oldfilename, ".")).".".pathinfo($imageData["file"]["filename"],PATHINFO_EXTENSION);
  $newImagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$newfilename ;
  $beforeCallback($oldImagePath);
  if (move_uploaded_file($file["tmp_name"], $newImagePath)) {
    $errorTable["error"] = $afterCallback($couch_id);
    if ($errorTable["error"]) {
      $errorTable["errorMessage"] = 'No se pudo crear un Picture';
    } else {
      $errorTable["errorMessage"] = 'Fue agregado un Picture';
    }  
  } else {
    $errorTable["error"] = "upload";
    $errorTable["errorMessage"] = "No se pudo subir la imagen '".$filename."'";
  }
}


function overwrite_picture($imagedata,$picture){

  $oldfilename =$picture->filename;

  $file=$imagedata["file"];

  $errorTable=$GLOBALS["errorTable"];

  $oldImagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$oldfilename;
  $newfilename=
    substr($oldfilename,0,strrpos($oldfilename, ".")).".".pathinfo($file["name"],PATHINFO_EXTENSION);
  $newImagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$newfilename ;
  if(file_exists($oldImagePath)){
    unlink($oldImagePath);
  }
  if (move_uploaded_file($file["tmp_name"], $newImagePath)) {
    // $picture->enable();
    $picture->enabled=true;
    $picture->filename=$newfilename;
    $picture->update();
    $errorTable["error"] = false;
    if ($errorTable["error"]) {
      $errorTable["errorMessage"] = 'No se pudo modificar un Picture';
    } else {
      $errorTable["errorMessage"] = 'Se pudo modificar un Picture';
    }  
  } else {
    $errorTable["error"] = "upload";
    $errorTable["errorMessage"] = "No se pudo subir la imagen '".$newfilename."'";
  }
  exit_if_error();

}



function create_picture($imagedata,$couch_id){
  $file=$imagedata["file"];
  $errorTable=$GLOBALS["errorTable"];
  $imageFilename =
    ($couch_id.'-'.$imagedata["imageIndex"].".".pathinfo($file["name"],PATHINFO_EXTENSION));
  $imagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$imageFilename;
  
  if(file_exists($imagePath)){
    unlink($imagePath);
  }
  if (move_uploaded_file($file["tmp_name"], $imagePath)) {
    $picture = (new Picture(NULL,true,intval($couch_id),$imageFilename));
    $errorTable["error"] = ! $picture->save_new();
    if ($errorTable["error"]) {
      $errorTable["errorMessage"] = 'No se pudo crear un Picture';
    } else {
      $errorTable["errorMessage"] = 'Fue agregado un Picture';
    }  
  } else {
    $errorTable["error"] = "upload";
    $errorTable["errorMessage"] = "No se pudo subir la imagen '".$filename."'";
  }
  exit_if_error();
}



function delete_picture($picture){
  $picture->disable();
  // $picture->delete_op();
  // $picture->update();
  // echo '<br>'.json_encode($picture).'<br>';
  $imagePath=$GLOBALS["COUCHPICTUREDIRFULL"]."/".$picture->filename;
  if(file_exists($imagePath)){
    unlink($imagePath);
  }
}


function get_pictures_for_couch($couch_id){
  $pictures=Picture::get_by_couch_id($couch_id,false);
  $ret=array();
  $imageIndex=0;
  foreach ($pictures as $key => $value) {
    if(strlen($value->filename)>0){
      $name = $value->filename;
      $tmp =  strpos($name, "-");
      $pos1 = ($tmp===FALSE? 0 : $tmp+1 );
      $pos2 = strpos($name, ".", $pos1);
      if($pos2!==FALSE){
        $imageIndex= substr($name,$pos1,$pos2-$pos1);
        $ret[$imageIndex]=$value;
      }else{
        $imageIndex+=1;
        $ret[$imageIndex]=$value;
      }
    }
  }
  return $ret;
}

function createImageData($form,$files){
  $ret=array();

  $actionsCallback=function($key){
    return strpos($key,"action-")===0 ? str_replace("action-","",$key) : NULL ;
  };
  $actions=filtermap_keys($actionsCallback,$form);

  $filesCallbackKeys=function($key){
    if(strpos($key,"file") > -1){
      $newKey=str_replace("file","",$key);
      return $newKey;
    }else{
      return null;
    }
  };
  $filesCallbackPost=function($val){return false;};

  $fileMap=
    array_map($filesCallbackPost, filtermap_keys($filesCallbackKeys,$form))+
    filtermap_keys($filesCallbackKeys,$files)
  ;
  // echo "<br>fileMap:".json_encode($fileMap);
  foreach ($actions as $imageIndex => $value) {
    $ret[$imageIndex]=[
      "action"=>$value,
      "file"  =>$fileMap[$imageIndex],
      "imageIndex"=>$imageIndex
    ];
  };

  return $ret;
}



function image_operations($form,$files,$couch_id){
  $imageData=createImageData($form,$files);
  $pictures=get_pictures_for_couch($couch_id);

  // exit('<br>'.
  //   'imageData:'.json_encode($imageData).'br'.
  //   'pictures:'.json_encode($pictures).'br'

  // );

  foreach ($imageData as $imageIndex => $value) {
    $action = $value["action"];
    $file = $value["file"];
    $imageIndex=$value["imageIndex"];
    $pictureIsInDatabase=isset($pictures[$imageIndex]);
    if($action==="upload"){
      if($file!==false){
        if($pictureIsInDatabase){
          // echo "<br>overwrite_picture:(".json_encode($value).")";
          overwrite_picture($value,$pictures[$imageIndex]);
        }else{
          // echo "<br>create_picture:(".json_encode($value).")";
          create_picture($value,$couch_id);
        }
      }
    }elseif($action==="delete"){
      if($pictureIsInDatabase ){
        // echo "<br>delete_picture:(".json_encode($value).")";
        delete_picture($pictures[$imageIndex]);
      }
    }else{
      exit("nonexistent action:".$action);
    }
  }

}



/*
   
Action enums

  -"upload" to upload an image
  -"delete" to delete an image
   
 
imageIndex values
 
  -"0"     a new image
  -"[1-]"  an already existing image

File values:
  (file)   the user provided a file
  (nofile) the user didn't provide a file
 
Combinations
 
  upload 0 (file)   a new image
  upload 0 (nofile) does nothing
  remove 0          does nothing
 
 
 
  upload [1-] (file)   modify an image
  upload [1-] (nofile) nothing
  remove [1-] (*)      remove an image
 
 
Database conditions:
  modify image:
    (exists in database)          modify element in database,replace file
    (doesn't exists in database)  create element in database,create file

  a new image:
    (exists in database)          modify element in database,replace file
    (doesn't exists in database)  create element in database,create file
  
  remove image:
    (exists in database)          remove in database,remove file
    (doesn't exists in database)  do nothing        ,do nothing

*/

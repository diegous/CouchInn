<?php

class Picture extends GenericModel {
  protected static $table_name = 'pictures';
  protected static $table_fields = 'enabled, couch_id, filename';
  public    static $size_limit = null;//inicializa en class_initialize
  private   static $initialized = false;//inicializa en class_initialize

  public $id;
  public $enabled;
  public $couch_id;
  public $filename;

  public static function class_initialize() {
    if(! self::$initialized ){
      //El tamaño de las imagenes sera el de los bytes enviables por POST
      self::$size_limit = (floatval(ini_get('post_max_size'))*(pow(2,20)));
      self::$initialized=true;
    }
  }

  public function __construct($id, $enabled, $couch_id, $filename) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->couch_id = $couch_id;
    $this->filename = $filename;
  }

  static function new_object_from_array($arr) {
    return new Picture($arr['id'],
                    $arr['enabled'],
                    $arr['couch_id'],
                    $arr['filename']);
  }

  public function __toString() {
    $result = "'" . $this->enabled . "', ";
    $result .= "'" . $this->couch_id . "', ";
    $result .= "'" . $this->filename . "'";

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled='" . $this->enabled . "', ";
    $result .= "couch_id='" . $this->couch_id . "', ";
    $result .= "filename='" . $this->filename . "' ";
    return $result;
  }

  public function full_path(){
    return $GLOBALS["COUCHPICTUREDIR"]."/".$this->filename;
  }

  public static function get_full_path($filename){
    return $GLOBALS["COUCHPICTUREDIR"]."/".$filename;
  }

  //retorna la posicion de la imagen dentro del couch usando el nombre de archivo
  //formato de archivo:<couch_id>-<posicion_interna>.<extension_original>
  //la posicion interna debe comenzar en 1 sino da error
  public function get_position(){
    if(strlen($this->filename)>0){
      $name = $this->filename;
      $pos1 = strpos($name, "-")+1 ;
      $pos2 = strpos($name, ".", $pos1);
      return substr($name,$pos1,$pos2-$pos1);
    }else{
      return 0;
    }
  }

  public static function get_by_couch_id($an_id,$must_be_enabled=true) {
    $query = 'SELECT * FROM ' . static::$table_name . ' WHERE couch_id=' . $an_id;
    if($must_be_enabled){
      $query .= " and enabled='1'";
    }
    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc())
      $result[] = static::new_object_from_array($row);

    $query_result->close();
    $connection->close();

    return $result;
  }

}

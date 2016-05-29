<?php

class CouchType extends GenericModel {
  protected static $table_name = 'couch_types';
  protected static $table_fields = 'description';

  public $id;
  public $description;

  public function __construct($id, $description) {
    $this->id = $id;
    $this->description = $description;
  }

  static function new_object_from_array($arr) {
    return new CouchType($arr['id'],
                    $arr['description']);
  }

  public function __toString() {
    $result = "'" . $this->description . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result = "description='" . $this->description . "' ";

    return $result;
  }
}

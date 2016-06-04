<?php

class CouchType extends GenericModel {
  protected static $table_name = 'couch_types';
  protected static $table_fields = 'enabled, description';

  public $id;
  public $enabled;
  public $description;

  public function __construct($id, $enabled = 1, $description) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->description = $description;
  }

  static function new_object_from_array($arr) {
    return new CouchType($arr['id'],
                    $arr['enabled'],
                    $arr['description']);
  }

  public function __toString() {
    $result = "" . $this->enabled . ", ";
    $result .= "'" . $this->description . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled=" . $this->enabled . ", ";
    $result .= "description='" . $this->description . "' ";

    return $result;
  }

  public function update() {
    if (!$this->already_exists()){
      parent::update();
    }
  }

  public function already_exists() {
    $query = 'SELECT * FROM ' . static::$table_name;
    $query .= ' WHERE UPPER(description)="' . strtoupper(trim($this->description)) . '"';
    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    if ($query_result && $row = $query_result->fetch_assoc()) {
      $result = static::new_object_from_array($row);
      $query_result->close();
    } else {
      $result = NULL;
    }

    $connection->close();

    return $result;
  }
}

<?php

class Picture extends GenericModel {
  protected static $table_name = 'pictures';
  protected static $table_fields = 'couch_id, filename';

  public $id;
  public $couch_id;
  public $filename;

  public function __construct($id, $couch_id, $filename) {
    $this->id = $id;
    $this->couch_id = $couch_id;
    $this->filename = $filename;
  }

  static function new_object_from_array($arr) {
    return new Picture($arr['id'],
                    $arr['couch_id'],
                    $arr['filename']);
  }

  public function __toString() {
    $result = "'" . $this->couch_id . "', ";
    $result .= "'" . $this->filename . "'";

    return $result;
  }

  protected function values_for_update() {
    $result = "couch_id='" . $this->couch_id . "' ";
    $result .= "filename='" . $this->filename . "'";
    return $result;
  }

  public static function get_by_couch_id($an_id) {
    $query = 'SELECT * FROM ' . static::$table_name . ' WHERE couch_id=' . $an_id;
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
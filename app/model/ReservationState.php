<?php

class ReservationState extends GenericModel {
  protected static $table_name = 'reservation_states';
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
    return new ReservationState(
      $arr['id'],
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

  public static function get_all() {
    $states = parent::get_all();

    foreach ($states as $key => $value) {
      $states[$value->description] = $key;
    }

    return $states;
  }

  public static function get_by_description($description) {
    $result = static::get_by_field_value('description', $description);

    if (sizeof($result) > 0){
      $keys = array_keys($result);
      $result = $result[$keys[0]];
    } else {
      $result = NULL;
    }

    return $result;
  }
}

<?php

class Reservation extends GenericModel {
  protected static $table_name = 'reservations';
  protected static $table_fields = 'enabled, user_id, couch_id, state_id, start_date, end_date';

  public $id;
  public $enabled;
  public $user_id;
  public $couch_id;
  public $state_id;
  public $start_date;
  public $end_date;

  public function __construct($id, $enabled = 1, $user_id, $couch_id, $state_id, $start_date, $end_date) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->user_id = $user_id;
    $this->couch_id = $couch_id;
    $this->state_id = $state_id;
    $this->start_date = $start_date;
    $this->end_date = $end_date;
  }

  static function new_object_from_array($arr) {
    return new Reservation(
      $arr['id'],
      $arr['enabled'],
      $arr['user_id'],
      $arr['couch_id'],
      $arr['state_id'],
      $arr['start_date'],
      $arr['end_date']
    );
  }

  public function __toString() {
    $result = "" . $this->enabled . ", ";
    $result .= "'" . $this->user_id . "', ";
    $result .= "'" . $this->couch_id . "', ";
    $result .= "'" . $this->state_id . "', ";
    $result .= "'" . $this->start_date . "', ";
    $result .= "'" . $this->end_date . "'";

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled=" . $this->enabled . ", ";
    $result .= "user_id='" . $this->user_id . "', ";
    $result .= "couch_id='" . $this->couch_id . "', ";
    $result .= "state_id='" . $this->state_id . "', ";
    $result .= "start_date='" . $this->start_date . "', ";
    $result .= "end_date='" . $this->end_date . "'";

    return $result;
  }
}

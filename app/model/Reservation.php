<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/date_validation.php';

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
    $result = "" . $this->id . ", ";
    $result .= "" . $this->enabled . ", ";
    $result .= "" . $this->user_id . ", ";
    $result .= "" . $this->couch_id . ", ";
    $result .= "" . $this->state_id . ", ";
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

  public static function get_by_couch_id($id) {
    return parent::get_by_field_value("couch_id", $id);
  }

  public static function cancel_conflicting_reservations($reservation) {
    $states = ReservationState::get_all();

    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE id!=" . $reservation->id;
    $query .= " AND couch_id=" . $reservation->couch_id;
    $query .= " AND state_id=" . $states['Pendiente'];
    $query .= " AND start_date <= '" . $reservation->end_date . "'";
    $query .= " AND end_date >= '" . $reservation->start_date . "'";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[$row['id']] = static::new_object_from_array($row);
      $result[$row['id']]->state_id = $states["Rechazada"];
      $result[$row['id']]->update();
    }

    $query_result->close();
    $connection->close();

    return $result;
  }
  
  public static function reservations_for_user_upto_date_in_state($user_id,$upto_date,$state_name) {
    $upto_date=getDateOrFalse($upto_date);
    if($upto_date===false){
          return [];
    }

    $states = ReservationState::get_all();

    $query =  " SELECT * from ".static::$table_name;
    $query .= " WHERE user_id=".$user_id;
    $query .= " AND end_date <= '".$upto_date."'";
    $query .= " AND state_id=".$states[$state_name];

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[$row['id']] = static::new_object_from_array($row);
    }

    return $result;

    $query_result->close();
    $connection->close();
  }
}




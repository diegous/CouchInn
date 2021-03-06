<?php
include $_SERVER['DOCUMENT_ROOT'].'/shared/date_validation.php';

class Reservation extends GenericModel {
  protected static $table_name = 'reservations';
  protected static $table_fields = 'enabled, user_id, couch_id, state_id, start_date, end_date, score_for_couch, comment_for_couch, score_for_user, comment_for_user';

  public $id;
  public $enabled;
  public $user_id;
  public $couch_id;
  public $state_id;
  public $start_date;
  public $end_date;
  public $score_for_couch;
  public $comment_for_couch;
  public $score_for_user;
  public $comment_for_user;

  public function __construct($id, $enabled = 1, $user_id, $couch_id, $state_id, $start_date, $end_date, $score_for_couch = -1, $comment_for_couch = "", $score_for_user = -1, $comment_for_user = "") {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->user_id = $user_id;
    $this->couch_id = $couch_id;
    $this->state_id = $state_id;
    $this->start_date = $start_date;
    $this->end_date = $end_date;
    $this->score_for_couch = $score_for_couch;
    $this->comment_for_couch = $comment_for_couch;
    $this->score_for_user = $score_for_user;
    $this->comment_for_user = $comment_for_user;
  }

  static function new_object_from_array($arr) {
    return new Reservation(
      $arr['id'],
      $arr['enabled'],
      $arr['user_id'],
      $arr['couch_id'],
      $arr['state_id'],
      $arr['start_date'],
      $arr['end_date'],
      $arr['score_for_couch'],
      $arr['comment_for_couch'],
      $arr['score_for_user'],
      $arr['comment_for_user']
    );
  }

  public function __toString() {
    $result = "" . $this->enabled . ", ";
    $result .= "" . $this->user_id . ", ";
    $result .= "" . $this->couch_id . ", ";
    $result .= "" . $this->state_id . ", ";
    $result .= "'" . $this->start_date . "', ";
    $result .= "'" . $this->end_date . "', ";
    $result .= "" . $this->score_for_couch . ", ";
    $result .= "'" . $this->comment_for_couch . "', ";
    $result .= "" . $this->score_for_user . ", ";
    $result .= "'" . $this->comment_for_user . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled=" . $this->enabled . ", ";
    $result .= "user_id='" . $this->user_id . "', ";
    $result .= "couch_id='" . $this->couch_id . "', ";
    $result .= "state_id='" . $this->state_id . "', ";
    $result .= "start_date='" . $this->start_date . "', ";
    $result .= "end_date='" . $this->end_date . "', ";
    $result .= "score_for_couch=" . $this->score_for_couch . ", ";
    $result .= "comment_for_couch='" . $this->comment_for_couch . "', ";
    $result .= "score_for_user=" . $this->score_for_user . ", ";
    $result .= "comment_for_user='" . $this->comment_for_user . "' ";

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

  public static function reservations_for_user($user_id) {

    $states = ReservationState::get_all();

    $query =  " SELECT * from ".static::$table_name;
    $query .= " WHERE user_id=".$user_id;
    // $query .= " AND end_date <= '".$upto_date."'";
    $query .= " ORDER BY start_date ;";

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

  public static function reservations_by_state($description) {

    $state = ReservationState::get_by_description($description);

    return parent::get_by_field_value("state_id",$state->id);
  }

  //Incluye la reserva aun si esta solo parcialmente dentro de rango de fechas
  public static function reservations_by_state_between_dates($description,$start_date,$end_date) {

    $state = ReservationState::get_by_description($description);

    $query =  " SELECT * from ".static::$table_name;
    $query .= " WHERE state_id=".$state->id;
    $query .= " AND (start_date>='" . $start_date . "'";
    $query .= " AND start_date<='" . $end_date . "'";
    $query .= " OR end_date>='" . $start_date . "'";
    $query .= " AND end_date<='" . $end_date . "')";
    $query .= " ORDER BY start_date ;";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[$row['id']] = static::new_object_from_array($row);
    }


    $query_result->close();
    $connection->close();
    return $result;
  }

  public static function end_confirmed_reservations() {
    $states = ReservationState::get_all();
    $yesterday = date('Y-m-d', strtotime( '-1 days' ));

    $query =  "UPDATE " . static::$table_name;
    $query .= " SET state_id=" . $states['Finalizada'];
    $query .= " WHERE state_id=" . $states['Confirmada'];
    $query .= " AND end_date<='" . $yesterday . "'";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = $connection->affected_rows;
    $connection->close();

    return $result;
  }

  public static function expire_pending_reservations() {
    $states = ReservationState::get_all();
    $yesterday = date('Y-m-d', strtotime( '-1 days' ));

    $query =  "UPDATE " . static::$table_name;
    $query .= " SET state_id=" . $states['Vencida'];
    $query .= " WHERE state_id=" . $states['Pendiente'];
    $query .= " AND start_date<='" . $yesterday . "'";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = $connection->affected_rows;
    $connection->close();

    return $result;
  }

  public static function reservations_as_couch_owner($user_id){
    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE couch_id IN ";
    $query .= " (SELECT couch_id FROM couchs";
    $query .= " WHERE user_id=" . $user_id . " ";
    $query .= " )";

    $connection = get_connection();
    $query_result = $connection->query($query);
    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[] = static::new_object_from_array($row);
    }
    $query_result->close();
    $connection->close();
    return $result;
  }

  public static function get_all_scores_for_user($user_id){
    $query = "SELECT score_for_user FROM " . static::$table_name;
    $query .= " WHERE user_id=" . $user_id . " ";
    $query .= " AND score_for_user > -1";

    $connection = get_connection();
    $query_result = $connection->query($query);
    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[] = (int)$row["score_for_user"];
    }
    $query_result->close();
    $connection->close();
    return $result;
  }

  public static function get_all_scored_reservations_for_user($user_id){
    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE user_id=" . $user_id . " ";
    $query .= " AND score_for_user > -1";
    $query .= " ORDER BY couch_id AND start_date";

    $connection = get_connection();
    $query_result = $connection->query($query);
    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[] =  static::new_object_from_array($row);
    }
    $query_result->close();
    $connection->close();
    return $result;
  }


  public static function confirmed_reservation_conflicting_with($reservation) {
    $states = ReservationState::get_all();

    $query =  "SELECT * FROM " . static::$table_name;
    $query .= " WHERE state_id=" . $states['Confirmada'];
    $query .= " AND couch_id=" . $reservation->couch_id;
    $query .= " AND start_date<='" . $reservation->end_date . "'";
    $query .= " AND end_date>='" . $reservation->start_date . "'";

    $connection = get_connection();
    $query_result = $connection->query($query);

    if ($row = $query_result->fetch_assoc())
      $result = static::new_object_from_array($row);
    else
      $result = NULL;

    $query_result->close();
    $connection->close();

    return $result;
  }
}




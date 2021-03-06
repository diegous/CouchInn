<?php

class Couch extends GenericModel {
  protected static $table_name = 'couchs';
  protected static $table_fields = 'enabled, published, user_id, type_id, title, description, capacity, location';
  public    static $maximum_amount_of_pictures = 3;


  public $id;
  public $enabled;
  public $published;
  public $user_id;
  public $type_id;
  public $title;
  public $description;
  public $capacity;
  public $location;

  public function __construct($id, $enabled , $published, $user_id, $type_id,$title,$description,$capacity,$location) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->published = $published;
    $this->user_id = $user_id;
    $this->type_id=$type_id;
    $this->title=$title;
    $this->description=$description;
    $this->capacity=$capacity;
    $this->location=$location;
  }

  static function new_object_from_array($arr) {
    return new Couch($arr['id'],
                    $arr['enabled'],
                    $arr['published'],
                    $arr['user_id'],
                    $arr['type_id'],
                    $arr['title'],
                    $arr['description'],
                    $arr['capacity'],
                    $arr['location']);
  }

  public function __toString() {
    $result = $this->enabled . ", ";
    $result .= $this->published . ", ";
    $result .=  $this->user_id . ", ";
    $result .=  $this->type_id . ", ";
    $result .= "'" . $this->title . "', ";
    $result .= "'" . $this->description . "', ";
    $result .= $this->capacity . ", ";
    $result .= "'" . $this->location . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result =  "enabled=" . $this->enabled . ", ";
    $result .= "published=" . $this->published . ", ";
    $result .= "user_id='" .  $this->user_id . "', ";
    $result .= "type_id='" . $this->type_id . "', ";
    $result .= "title='" . $this->title . "', ";
    $result .= "description='" . $this->description . "', ";
    $result .= "capacity='" . $this->capacity . "', ";
    $result .= "location='" . $this->location . "' ";

    return $result;
  }


  public function disable_as_admin() {
    $this->enabled = 2;
    $this->update();

    return $query_result;
  }

  public function is_enabled(){
    return $this->enabled==1 && $this->published==1;
  }
  public function is_visible_for_user($user){
    return $this->is_enabled() || $user->is_admin ||($user->id == $this->user_id);
  }

  public static function search($title, $description, $couch_type, $location, $capacity, $dates_enabled, $start_date, $end_date) {
    if (!$capacity)
      $capacity = 0;

    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE title LIKE '%" . $title . "%'";
    $query .= " AND location LIKE '%" . $location . "%'";
    $query .= " AND description LIKE '%" . $description . "%'";
    $query .= " AND capacity>=" . $capacity;

    if ($dates_enabled && $start_date && $end_date) {
      $states = ReservationState::get_all();

      $query .= " AND id NOT IN ";
      $query .= " (SELECT couch_id FROM reservations";
      $query .= " WHERE start_date<='" . $end_date . "'";
      $query .= " AND end_date>='" . $start_date . "'";
      $query .= " AND state_id=" . $states["Confirmada"];
      $query .= " )";
    }

    if ($couch_type != 0)
      $query .= " AND type_id=" . $couch_type;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc()) {
      $element = static::new_object_from_array($row);
      $result[$element->id] = $element;
    }

    $query_result->close();
    $connection->close();

    return $result;
  }

  public function disable_reservation_couch() {
    $states = ReservationState::get_all();

    $query =  'UPDATE reservations ';
    $query .= ' SET state_id=' . $states['Rechazada'];;
    $query .= ' WHERE couch_id=' . $this->id;
    $query .= ' AND state_id IN ';
    $query .= '(' . $states["Confirmada"];
    $query .= ', ' . $states["Pendiente"] . ')';

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }
/*
  public function enabled_reservation_couch() {
    $query =  'UPDATE reservations ';
    $query .= 'SET enabled=TRUE ';
    $query .= 'WHERE couch_id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }
*/
}

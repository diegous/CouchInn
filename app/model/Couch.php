<?php

class Couch extends GenericModel {
  protected static $table_name = 'couchs';
  protected static $table_fields = 'enabled, published, user_id, type_id, title, description, capacity, location';

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

  public static function search($title, $description, $couch_type, $location, $capacity) {
    if (!$capacity)
      $capacity = 0;

    $query = "SELECT * FROM " . static::$table_name . " WHERE";
    $query .= " title LIKE '%" . $title . "%' AND";
    $query .= " location LIKE '%" . $location . "%' AND";
    $query .= " description LIKE '%" . $description . "%' AND";
    $query .= " capacity>=" . $capacity;

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
}

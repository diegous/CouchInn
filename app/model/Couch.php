<?php

class Couch extends GenericModel {
  protected static $table_name = 'couchs';
  protected static $table_fields = 'type_id,title,description,capacity,location';

  public $id;
  public $type_id;
  public $title;
  public $description;
  public $capacity;
  public $location;

  public function __construct($id, $type_id,$title,$description,$capacity,$location) {
    $this->id = $id;
    $this->type_id=$type_id;
    $this->title=$title;
    $this->description=$description;
    $this->capacity=$capacity;
    $this->location=$location;
  }

  static function new_object_from_array($arr) {
    return new Couch($arr['id'],
                    $arr['type_id'],
                    $arr['title'],
                    $arr['description'],
                    $arr['capacity'],
                    $arr['location']);
  }

  public function __toString() {
    $result =  $this->type_id . ", ";
    $result .= "'" . $this->title . "', ";
    $result .= "'" . $this->description . "', ";
    $result .= $this->capacity . ", ";
    $result .= "'" . $this->location . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result =  "type_id=" . $this->type_id . ", ";
    $result .= "title='" . $this->title . "', ";
    $result .= "description='" . $this->description . "', ";
    $result .= "capacity=" . $this->capacity . ", ";
    $result .= "location='" . $this->location . "' ";

    return $result;
  }
}

<?php

class Couch extends GenericModel {
  protected static $table_name = 'couchs';
  protected static $table_fields = 'enabled, user_id, type_id, title, description, capacity, location';

  public $id;
  public $enabled;
  public $user_id;
  public $type_id;
  public $title;
  public $description;
  public $capacity;
  public $location;

  public function __construct($id, $enabled, $user_id, $type_id,$title,$description,$capacity,$location) {
    $this->id = $id;
    $this->enabled = $enabled;
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
                    $arr['user_id'],
                    $arr['type_id'],
                    $arr['title'],
                    $arr['description'],
                    $arr['capacity'],
                    $arr['location']);
  }

  public function __toString() {
    $result = $this->enabled . ", ";
    $result .=  $this->type_id . ", ";
    $result .=  $this->user_id . ", ";
    $result .= "'" . $this->title . "', ";
    $result .= "'" . $this->description . "', ";
    $result .= $this->capacity . ", ";
    $result .= "'" . $this->location . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result =  "enabled=" . $this->enabled . ", ";
    $result .=  "type_id=" . $this->type_id . ", ";
    $result .=  "user_id=" .  $this->user_id . ", ";
    $result .= "title='" . $this->title . "', ";
    $result .= "description='" . $this->description . "', ";
    $result .= "capacity=" . $this->capacity . ", ";
    $result .= "location='" . $this->location . "' ";

    return $result;
  }

}

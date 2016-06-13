<?php

abstract class GenericModel {
  public static function get_all() {
    return static::get_by_field_value('1', '1');
  }

  public function get_all_enabled() {
    return static::get_by_field_value('enabled', 'true');;
  }

  public static function get_by_field_value($field_name, $value) {
    $query = 'SELECT * FROM ' . static::$table_name;
    $query .= ' WHERE ' . $field_name . "='" . $value . "'";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc())
      $result[$row['id']] = static::new_object_from_array($row);

    $query_result->close();
    $connection->close();

    return $result;
  }

  public static function get_by_id($an_id) {
    $result = static::get_by_field_value('id', $an_id);

    if (sizeof($result) > 0){
      $keys = array_keys($result);
      $result = $result[$keys[0]];
    } else {
      $result = NULL;
    }

    return $result;
  }

  public function save_new() {
    $query =  'INSERT INTO ' . static::$table_name . ' ';
    $query .= '(' . static::$table_fields . ')';
    $query .= ' VALUES (' . $this . ')';

    $connection = get_connection();

    if ( $connection->query($query) ) {
      $this->id = $connection->insert_id;
      $connection->close();

      return true;
    } else {
      $connection->close();
      return false;
    }
  }

  public function update() {
    $query =  'UPDATE ' . static::$table_name . ' ';
    $query .= 'SET ' . $this->values_for_update() . ' ';
    $query .= 'WHERE id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = $connection->affected_rows;
    $connection->close();

    return $result;
  }

  public function disable() {
    $query =  'UPDATE ' . static::$table_name . ' ';
    $query .= 'SET enabled=FALSE ';
    $query .= 'WHERE id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }

  public function enable() {
    $query =  'UPDATE ' . static::$table_name . ' ';
    $query .= 'SET enabled=TRUE ';
    $query .= 'WHERE id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }

  abstract protected function values_for_update();
}

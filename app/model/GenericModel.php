<?php

abstract class GenericModel {
  public static function get_all() {
    $query = 'SELECT * FROM ' . static::$table_name;
    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc())
      $result[] = static::new_object_from_array($row);

    $query_result->close();
    $connection->close();

    return $result;
  }


  public function get_all_enabled() {
    $query = 'SELECT * FROM ' . static::$table_name . ' WHERE enabled=true';
    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc())
      $result[] = static::new_object_from_array($row);

    $query_result->close();
    $connection->close();

    return $result;
  }


  public static function get_by_id($an_id) {
    $query = 'SELECT * FROM ' . static::$table_name . ' WHERE id=' . $an_id;
    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    if ($row = $query_result->fetch_assoc())
      $result = static::new_object_from_array($row);
    else
      $result = NULL;

    $query_result->close();
    $connection->close();

    return $result;
  }

  public function save_new() {
    $query =  'INSERT INTO ' . static::$table_name . ' ';
    $query .= '(' . static::$table_fields . ')';
    $query .= 'VALUES (' . $this . ')';

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

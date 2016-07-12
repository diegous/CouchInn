<?php

class User extends GenericModel {
  protected static $table_name = 'users';
  protected static $table_fields = 'enabled, email, password, name, last_name, birthday, phone, is_admin, is_premium';

  public $id;
  public $enabled;
  public $email;
  public $password;
  public $name;
  public $last_name;
  public $birthday;
  public $phone;
  public $is_admin;
  public $is_premium;

  public function __construct($id, $enabled = 1, $email, $password, $name = NULL, $last_name = NULL, $birthday = NULL, $phone = NULL, $is_admin = 0, $is_premium = 0) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->email = $email;
    $this->password = $password;
    $this->name = $name;
    $this->last_name = $last_name;
    $this->birthday = $birthday;
    $this->phone = $phone;
    $this->is_admin = $is_admin;
    $this->is_premium = $is_premium;
  }

  static function new_object_from_array($arr) {
    return new User($arr['id'],
                    $arr['enabled'],
                    $arr['email'],
                    $arr['password'],
                    $arr['name'],
                    $arr['last_name'],
                    $arr['birthday'],
                    $arr['phone'],
                    $arr['is_admin'],
                    $arr['is_premium']);
  }

  public function __toString() {
    $result = "'" . $this->enabled . "', ";
    $result .= "'" . $this->email . "', ";
    $result .= "'" . $this->password . "', ";
    $result .= "'" . $this->name . "', ";
    $result .= "'" . $this->last_name . "', ";
    $result .= "'" . $this->birthday . "', ";
    $result .= "'" . $this->phone . "', ";
    $result .= $this->is_admin . ", ";
    $result .= $this->is_premium;

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled='" . $this->enabled . "', ";
    $result .= "email='" . $this->email . "', ";
    $result .= "password='" . $this->password . "', ";
    $result .= "name='" . $this->name . "', ";
    $result .= "last_name='" . $this->last_name . "', ";
    $result .= "birthday='" . $this->birthday . "', ";
    $result .= "phone='" . $this->phone . "', ";
    $result .= "is_admin=" . $this->is_admin . ", ";
    $result .= "is_premium=" . $this->is_premium;

    return $result;
  }

  public static function check_login($an_email, $a_password) {
    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE email='" . $an_email . "'";
    $query .= " AND password='" . $a_password . "'";
//    $query .= " AND enabled=TRUE ";

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    if ($row = $query_result->fetch_assoc()){
      $result = static::new_object_from_array($row);
      if($result->enabled==false){
        $result = false;
      }
    }else{
      $result = NULL;
    }

    $query_result->close();
    $connection->close();

    return $result;
  }

   public static function exist_user($an_email) {
    $query = "SELECT * FROM " . static::$table_name;
    $query .= " WHERE email='" . $an_email . "'";

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

  public static function enabled_admins() {
    $query = 'SELECT * FROM ' . static::$table_name;
    $query .= ' WHERE is_admin=1 AND enabled=1';

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc())
      $result[$row['id']] = static::new_object_from_array($row);

    $query_result->close();
    $connection->close();

    return $result;
  }

  /*Desabilitar los couch de un usuario*/
  public function disable_couch_user() {
    $query =  'UPDATE couchs ';
    $query .= 'SET enabled=FALSE ';
    $query .= 'WHERE user_id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }

  /*Habilitar los couch de un usuario*/
  public function enabled_couch_user() {
    $query =  'UPDATE couchs ';
    $query .= 'SET enabled=TRUE ';
    $query .= 'WHERE user_id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }

  /* Desabilitar reservas que hizo un usuario*/
  public function disable_reservation_user() {
    $query =  'UPDATE reservations ';
    $query .= 'SET state_id = 3 ';
    $query .= 'WHERE state_id IN (1,2) ';
    $query .= 'AND user_id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $connection->close();

    return $query_result;
  }

  /*Deshabilitar reservas de los couchs de un usuario*/
  public static function disable_reservation_couch_user() {
    $query = 'SELECT * FROM couchs ';
    $query .= ' WHERE enabled= 1 ';
    $query .= 'AND user_id=' . $this->id;

    $connection = get_connection();
    $query_result = $connection->query($query);

    $result = array();

    while ($row = $query_result->fetch_assoc()){
      $result[$row['id']] = static::new_object_from_array($row);

      $query_ud =  'UPDATE reservations ';
      $query_ud .= 'SET state_id = 3 ';
      $query_ud .= 'WHERE state_id IN (1,2) ';
      $query_ud .= 'AND couch_id= ' . $result[$row['id']]->couch_id;

      $connection_ud = get_connection();
      $query_result_ud = $connection_ud->query($query_ud);

      $connection_ud->close();

      /*return $query_result;  */
      /*
      $result[$row['id']]->state_id = $states["Rechazada"];
      $result[$row['id']]->update();
      */
    }

    $query_result->close();
    $connection->close();

    return $result;
  }

}

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
    $query .= " AND enabled=TRUE ";

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
}

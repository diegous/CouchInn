<?php

class User extends GenericModel {
  protected static $table_name = 'users';
  protected static $table_fields = 'email, password, name, last_name, birthday, phone, is_admin, is_premium';

  public $id;
  public $email;
  public $password;
  public $name;
  public $last_name;
  public $birthday;
  public $phone;
  public $is_admin;
  public $is_premium;

  public function __construct($id, $email,  $password,  $name,  $last_name,  $birthday,  $phone,  $is_admin,  $is_premium) {
    $this->id = $id;
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
    $result = "'" . $this->email . "', ";
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
    $result = "email='" . $this->email . "', ";
    $result .= "password='" . $this->password . "', ";
    $result .= "name='" . $this->name . "', ";
    $result .= "last_name='" . $this->last_name . "', ";
    $result .= "birthday='" . $this->birthday . "', ";
    $result .= "phone='" . $this->phone . "', ";
    $result .= "is_admin=" . $this->is_admin . ", ";
    $result .= "is_premium=" . $this->is_premium;

    return $result;
  }
}

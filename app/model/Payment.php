<?php
 
class Payment extends GenericModel {
  protected static $table_name = 'payments';
  protected static $table_fields = 'enabled , user_id , amount , date' ;

  public $id;
  public $enabled;
  public $user_id;
  public $amount;
  public $date;

  public function __construct($id, $enabled, $user_id, $amount,$date) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->user_id = $user_id;
    $this->amount = $amount;
    $this->date = $date;
  }

  static function new_object_from_array($arr) {
    return new Payment($arr['id'],
                    $arr['enabled'],
                    $arr['user_id'],
                    $arr['amount'],
                    $arr['date']);
  }

  public function __toString() {
    $result = "'" . $this->enabled . "', ";
    $result .= "'" . $this->user_id . "', ";
    $result .= $this->amount . ", ";
    $result .= "'" . $this->date . "'" ; 

    return $result;
  }

  protected function values_for_update() {
    $result = "enabled='" . $this->enabled . "' ";
    $result .= "user_id='" . $this->user_id . "' ";
    $result .= "amount='" . $this->amount . "' ";
    $result .= "date='" . $this->date . "'";
    return $result;
  }



  static function all_between_dates($start,$end) {

    $query = 'SELECT * FROM payments';
    $query .= ' WHERE date BETWEEN "' . $start . '" AND "' . $end . '";';

    $result = array();
    if($connection = get_connection()){

      $query_result = $connection->query($query);


      while ($row = $query_result->fetch_assoc())
        $result[] = Payment::new_object_from_array($row);

      $query_result->close();
      $connection->close();
        
    }

    return $result;
  }

}

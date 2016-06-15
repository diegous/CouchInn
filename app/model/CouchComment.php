<?php

class CouchComment extends GenericModel {
  protected static $table_name = 'couch_comments';
  protected static $table_fields = 'id, enabled, user_id, couch_id, comment_question, date, comment_answer';

  public $id;
  public $enabled;
  public $user_id;
  public $couch_id;
  public $comment_question;
  public $date;
  public $comment_answer;

  public function __construct($id, $enabled, $user_id, $couch_id, $comment_question, $date, $comment_answer) {
    $this->id = $id;
    $this->enabled = $enabled;
    $this->user_id = $user_id;
    $this->couch_id = $couch_id;
    $this->comment_question = $comment_question;
    $this->date = $date;
    $this->comment_answer = $comment_answer;
  }

  static function new_object_from_array($arr) {
    return new CouchComment($arr['id'],
                    $arr['enabled'],
                    $arr['user_id'],
                    $arr['couch_id'],
                    $arr['comment_question'],
                    $arr['date'],
                    $arr['comment_answer']);
  }

  public function __toString() {
    $result = $this->enabled . ", ";
    $result .=  $this->user_id . ", ";
    $result .=  $this->couch_id . ", ";
    $result .= "'" . $this->comment_question . "', ";
    $result .= "'" . $this->date . "', ";
    $result .= "'" . $this->comment_answer . "' ";

    return $result;
  }

  protected function values_for_update() {
    $result =  "enabled=" . $this->enabled . ", ";
    $result .= "user_id='" .  $this->user_id . "', ";
    $result .= "couch_id='" . $this->couch_id . "', ";
    $result .= "comment_question='" . $this->comment_question . "', ";
    $result .= "date='" . $this->date . "', ";
    $result .= "comment_answer='" . $this->comment_answer . "' ";

    return $result;
  }

  public static function get_by_couch_id($an_couch_id) {
    $query = 'SELECT * FROM ' . static::$table_name . ' WHERE couch_id=' . $an_couch_id . ' ORDER BY date desc';

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

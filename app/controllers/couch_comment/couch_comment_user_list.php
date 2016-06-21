<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

$alert_variables = check_for_alert();

$content = "couch_comment/couch_comment_user_view.php";
$title = "Preguntas sin responder";

if(isset($_SESSION['user']) && !($_SESSION['user']->is_admin)) {
  $comment_list_user = CouchComment::get_by_user_id($_SESSION['user']->id);
//  $comment_couch_user = Couch::get_by_id($comment_list_user->couch_id);

  include $DRV . "/skeleton.php";
} else {
  header('Location: ' . '/index.php');
  exit();
}

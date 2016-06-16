<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();

if (isset($_POST["id"]) && isset($_POST["respuesta"])) {
  $couch_comment = CouchComment::get_by_id($_POST["id"]);
  $couch_comment->comment_answer = $_POST["respuesta"];

  if ($couch_comment->update()) {
      create_alert('success', 'Se respondio la pregunta');
    } else {
      create_alert('danger', 'Se produjo un error');
    }
  }

header('Location: ' . '/couch/couch.php?id=' . $couch->user_id);
exit();

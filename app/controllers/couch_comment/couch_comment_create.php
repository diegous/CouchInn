<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();


if (isset($_POST["question"])) {
  $couch_comment = new CouchComment(
    NULL,
    TRUE,
    $_POST['user_id'],
    $_POST['couch_id'],
    $_POST["question"],
    NULL,
    NULL
  );

  if ($couch_comment->save_new()) {
    create_alert('success', 'Se creo la pregunta');
  } else {
    create_alert('danger', 'No se pudo crear la pregunta');
  }
}

header('Location: ' . '/couch/couch.php?id=' . $_POST['couch_id']);
exit();

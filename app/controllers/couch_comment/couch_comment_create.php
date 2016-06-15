<?php

include $_SERVER['DOCUMENT_ROOT'] . "/shared/loader.php";

//redirect_if_not_admin();

if (isset($_POST["preguntar"])) {
  $couch_comment = new CouchComment(NULL, TRUE, intval($_SESSION['user']->id), intval($_POST['couch_id']), $_POST["preguntar"], NULL, NULL);

    if ($couch_comment->save_new()) {
      create_alert('success', 'Fue agregado un nuevo tipo de couch');
    } else {
      create_alert('danger', 'No se pudo crear el tipo de couch');
    }
  }

header('Location: ' . '/couch/couch.php?id=' . $_POST["id"]);
exit();

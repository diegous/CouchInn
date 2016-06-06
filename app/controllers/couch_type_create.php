<?php

include "loader.php";

redirect_if_not_admin();

if (isset($_POST["description"])) {
  $couch_type = new CouchType(NULL, TRUE, $_POST["description"]);

  if ($couch_type->already_exists()) {
    create_alert('warning', 'Ya existe un tipo de couch con el mismo nombre');
  } else {
    if ($couch_type->save_new()) {
      create_alert('success', 'Fue agregado un nuevo tipo de couch');
    } else {
      create_alert('danger', 'No se pudo crear el tipo de couch');
    }
  }
}

header('Location: ' . 'couch_type_list.php');
exit();

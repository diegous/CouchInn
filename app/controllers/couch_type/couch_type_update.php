<?php

include "shared/loader.php";

redirect_if_not_admin();

if (isset($_POST["id"]) && isset($_POST["description"])) {
  $couch_type = CouchType::get_by_id($_POST["id"]);
  $couch_type->description = $_POST["description"];

  if ($couch_type->already_exists()) {
    create_alert('warning', 'Ya existe un tipo de couch con el mismo nombre');
  } else {
    if ($couch_type->update()) {
      create_alert('success', 'Los datos fueron actualizados');
    } else {
      create_alert('danger', 'Se produjo un error');
    }
  }
}

header('Location: ' . "couch_type_list.php");
exit();

<?php

include "shared/loader.php";

redirect_if_not_admin();
$alert_variables = check_for_alert();

$content = "couch_type/couch_type_list_view.php";
$title = "Listado de tipos de couch";

$couch_type_list = CouchType::get_all();

include "../views/skeleton.php";

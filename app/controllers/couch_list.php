<?php

include "loader.php";

$content = "couch_list_view.php";
$title = "Listado de couch";

$couch_list = Couch::get_all();

include "../views/skeleton.php";

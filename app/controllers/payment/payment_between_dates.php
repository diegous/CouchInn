<?php

include "shared/loader.php";

redirect_if_not_admin();

$content = "payment/payment_between_dates_view.php";
$title = "Ganancias entre dos fechas";

include "../views/skeleton.php";


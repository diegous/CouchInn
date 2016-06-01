<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">
    <title>CouchInn - <?= $title ?></title>
  </head>
  <body>

    <div class="center-column">
      <? include("header.php") ?>

      <? include($content) ?>

      <? include("footer.php") ?>
    </div>

  </body>
</html>

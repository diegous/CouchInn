<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="views/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/site.css">
    <title>CouchInn - <?= $title ?></title>
  </head>
  <body>
  
    <div class="center-column">
      <?php include("header.php") ?>

      <?php include($content) ?>

      <?php include("footer.php") ?>
    </div>

  </body>
</html>

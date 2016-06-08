<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/siteFunctions.js"></script>

    <title>CouchInn - <?= $title ?></title>
  </head>
  <body>

    <div class="center-column">
      <? include("header.php") ?>

      <? include($content) ?>

      <!--<? include("footer.php") ?>-->
    </div>

  </body>
</html>

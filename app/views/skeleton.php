<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/site.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/login.css">
    <script src="/resources/js/jquery.min.js"></script>
    <script src="/resources/js/jquery.form.min.js"></script>
    <script src="/resources/js/bootstrap.min.js"></script>
    <script src="/resources/js/siteFunctions.js"></script>

    <title>CouchInn - <?= $title ?></title>
  </head>
  <body>

    <div class="center-column">
      <? include($DRV . "/shared/header.php") ?>

      <? include($content) ?>

    </div>

    <? include("shared/footer.php") ?>

  </body>
</html>

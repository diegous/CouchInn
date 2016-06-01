<head>  
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" charset="utf-8" src="js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" type="text/css" media="all" href="css/login.css">
</head>




<? if(!empty($_SESSION) && $_SESSION['user']) : ?>
  <strong>Usuario actual: <?= $_SESSION['user']->email ?></strong><br>
  <? if(! $_SESSION['user']->is_premium): ?>
    <a href="user_make_premium.php">Adquirir Cuenta Premium</a>
  <? else: ?>
    Ya es Usuario Premium
  <? endif ?>
   - 
  <a href="session_close.php">Cerrar Sesi&oacute;n</a>
<? else : ?>
  <a href="#" data-toggle="modal" data-target="#login-modal">Iniciar Sesi&oacute;n</a>

  <div class="modal fade" id="login-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="loginmodal-container">
        <h1>Iniciar Sesi&oacute;n</h1><br>
        <form action="session_create.php" method="post">
          <input type="email" name="email" placeholder="Email">
          <input type="password" name="password" placeholder="Contrase&ntilde;a">
          <input type="submit" name="login" class="login loginmodal-submit" value="Enviar">
        </form>

        <div class="login-help">
          <a href="user_new.php">Registrarse</a> - <a href="#">Olvid&eacute; mi contrase&ntilde;a</a>
        </div>
      </div>
    </div>
  </div>
<? endif ?>

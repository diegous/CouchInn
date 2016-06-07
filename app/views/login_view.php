<head>
  <div class="logo-container">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" charset="utf-8" src="js/bootstrap.min.js"></script>
  </div>

  <? if ($_SESSION && $_SESSION['user']): ?>
    <strong>Usuario actual: <a href="user_edit.php"><?= $_SESSION['user']->email ?></a></strong>

    <? if($_SESSION['user']->is_admin) : ?>
      <span class="glyphicon glyphicon-cog" style="color:black" title="Usuario administrador" aria-hidden="true"></span>
    <? endif ?>

    <? if($_SESSION['user']->is_premium) : ?>
      <span class="glyphicon glyphicon-star" style="color:goldenrod" title="Usuario premium" aria-hidden="true"></span>
    <? endif ?>

    <br>

    <? if($_SESSION['user']->is_admin): ?>
      <span class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
          Opciones de Administraci&oacute;n
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="menu administrador">
          <li><a href="couch_type_list.php">Ver tipos de couch</a></li>
        </ul>
      </span>
    <? endif ?>
    <a href="session_close.php">Cerrar Sesi&oacute;n</a>

  <? else : ?>
    <a href="#" data-toggle="modal" data-target="#login-modal">Iniciar Sesi&oacute;n</a>
    -
    <a href="user_new.php" >Registrarse</a>

    <div class="modal fade" id="login-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Iniciar Sesi&oacute;n</h1><br>
          <form id="login-form" onsubmit="return checkLogin(this)">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contrase&ntilde;a" required>
            <input type="submit" class="login loginmodal-submit" value="Enviar">
          </form>
          <div class="login-help">
            <a href="user_new.php">Registrarse</a> - <a href="recuperar_pass.php">Olvid&eacute; mi contrase&ntilde;a</a>
          </div>
        </div>
      </div>
    </div>
  <? endif ?>
</head>

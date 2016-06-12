<div>
  <div class="logo-container">
  </div>

  <? if ($_SESSION && $_SESSION['user']): ?>
    <strong>Usuario actual: <a href="/user/user_edit.php"><?= $_SESSION['user']->email ?></a></strong>

    <? if($_SESSION['user']->is_admin) : ?>
      <span class="glyphicon glyphicon-cog" style="color:black" title="Usuario administrador" aria-hidden="true"></span>
    <? endif ?>

    <? if($_SESSION['user']->is_premium) : ?>
      <span class="glyphicon glyphicon-star" style="color:goldenrod" title="Usuario premium" aria-hidden="true"></span>
    <? endif ?>

    <br>

    <a href="/session/session_close.php">Cerrar Sesi&oacute;n</a>

  <? else : ?>
    <!--
    <a href="#" data-toggle="modal" data-target="#login-modal">Iniciar Sesi&oacute;n</a>
    -
    <a href="/user/user_new.php" >Registrarse</a>
    -->
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
            <a href="/session/recuperar_pass.php">Olvid&eacute; mi contrase&ntilde;a</a>
          </div>
        </div>
      </div>
    </div>
  <? endif ?>
</div>

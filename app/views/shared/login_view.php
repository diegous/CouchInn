<style>
.bad-input{
  background: #FCC;
}
</style>

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

  <? else : ?>
    <div class="modal fade" id="login-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Iniciar Sesi&oacute;n</h1><br>
          <form id="login-form" onsubmit="return checkLogin(this)">
            <div id="incorrect-login-label" class="alert alert-danger hidden" 
              role="alert" style="color:red;align:left">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              Combinación usuario/contraseña incorrecto
            </div>
            <input class="login-input" type="email" name="email" placeholder="Email" required>
            <input class="login-input" type="password" name="password" placeholder="Contrase&ntilde;a" required>
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

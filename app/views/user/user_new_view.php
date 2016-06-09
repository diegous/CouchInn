<? include($DRV . "/shared/alerts.php") ?>
<script type="text/javascript" src="/user/js/user_new_validation.js"></script>

<div class="panel panel-default">
  <div class="panel-heading">Registrarse</div>
  <form class="panel-body" action="" method="post">
    <div class="form-group">
      <label for="email">Email</label><br>
      <input id="email" class="form-control" type="email" name="email" required>
      <label id="label-error-email" class="label-error" hidden=true></label>
    </div>

    <div class="form-group">
      <label for="password">Contrase&ntilde;a</label><br>
      <input id="password" class="form-control" type="password" name="password" required>
    </div>

    <div class="form-group">
      <label for="name">Nombre</label><br>
      <input id="name" class="form-control" type="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="last_name">Apellido</label><br>
      <input id="last_name" class="form-control" type="last_name" name="last_name" required>
    </div>

    <div class="form-group">
      <label for="birthday">Fecha de nacimiento(AAAA-MM-DD)</label><br>
      <input id="birthday" class="form-control" type="date" name="birthday" required
        pattern="\d{4}-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])">
    </div>

    <div class="form-group">
      <label for="phone">Tel&eacute;fono</label><br>
      <input id="phone" class="form-control" type="text" name="phone">
    </div>

    <button type="submit" class="btn btn-default">Guardar</button>
  </form>
</div>

<? if ( isset($_GET['warning']) && $_GET['warning'] == "missing_fields"): ?>
  <div class="red">
    <p>Falt&oacute; alg&uacute;n campo obligatorio</p>
  </div>
<? endif ?>

<div class="panel panel-default">
  <div class="panel-heading">Registrarse</div>
  <form class="panel-body" action="user_create.php" method="post">

    <div class="form-group">
      <label for="email">Email</label><br>
      <input id="email" class="form-control" type="email" name="email">
    </div>

    <div class="form-group">
      <label for="password">Contrase&ntilde;a</label><br>
      <input id="password" class="form-control" type="password" name="password">
    </div>

    <div class="form-group">
      <label for="name">Nombre</label><br>
      <input id="name" class="form-control" type="name" name="name">
    </div>

    <div class="form-group">
      <label for="last_name">Apellido</label><br>
      <input id="last_name" class="form-control" type="last_name" name="last_name">
    </div>

    <div class="form-group">
      <label for="bithday">Fecha de nacimiento</label><br>
      <input id="bithday" class="form-control" type="date" name="bithday">
    </div>

    <div class="form-group">
      <label for="phone">Tel&eacute;fono</label><br>
      <input id="phone" class="form-control" type="text" name="phone">
    </div>

    <button type="submit" class="btn btn-default">Guardar</button>
  </form>
</div>

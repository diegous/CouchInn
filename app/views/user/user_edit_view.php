<h1>Modificar datos de usuario</h1>
<table class="table">
  <tbody>
    <form action="/user/user_update.php" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>">
      <tr>
        <div class="form-group">
          <label for="email">Email</label><br>
          <input id="email" class="form-control" type="email"
                 name="" value="<?= $user->email; ?>" disabled>
        </div>
      </tr>
      <tr>
        <div class="form-group">
          <label for="password">Contrase&ntilde;a</label><br>
          <input id="password" class="form-control" type="password"
                 name="password" value="<?= $user->password; ?>" required>
        </div>
      </tr>
      <tr>
        <div class="form-group">
          <label for="name">Nombre</label><br>
          <input id="name" class="form-control" type="name"
                 name="name" value="<?= $user->name; ?>" required>
        </div>
      </tr>
      <tr>
        <div class="form-group">
          <label for="last_name">Apellido</label><br>
          <input id="last_name" class="form-control" type="last_name"
                 name="last_name" value="<?= $user->last_name; ?>" required>
        </div>
      </tr>
      <tr>
        <div class="form-group">
          <label for="birthday">Fecha de nacimiento</label><br>
          <input id="birthday" class="form-control" type="date"
                 name="birthday" value="<?= $user->birthday; ?>" required>
        </div>
      </tr>
      <tr>
        <div class="form-group">
          <label for="phone">Tel&eacute;fono</label><br>
          <input id="phone" class="form-control" type="text"
                 name="phone" value="<?= $user->phone; ?>">
        </div>
      </tr>
      <button type="submit" class="btn btn-default">Guardar</button>
    </form>
    <hr>

    <h2>Acciones De Couch:</h2>
    <a href="/couch/couch_create.php">Crear couch</a>
    <h2>Cuenta Premium:</h2>
    <? if(! $_SESSION['user']->is_premium): ?>
      <form id="hidden-amount-form" action="/payment/payment_system.php" method="post">
        <input type="input" name="amount" value="30" hidden="true">
        <a onclick="document.getElementById('hidden-amount-form').submit()" >
          Adquirir Cuenta Premium</a>
      </form>
    <? else: ?>
      Ya es Usuario Premium
    <? endif ?>
  </tbody>
</table>

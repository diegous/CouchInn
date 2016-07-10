<hr>
<a href="/user/user_edit.php">Modificar Datos de Usuario - </a>
<a href="#">Deshabilitar Usuario</a>
<hr>

<h2>Datos de usuario</h2>

<label>Email      :</label>
<?= $user->email; ?><br>
<label>Nombre     :</label>
<?= $user->name; ?><br>
<label>Apelido    :</label>
<?= $user->last_name; ?><br>
<label>Cumpleaños:</label>
<?= $user->birthday; ?><br>
<? if($user->phone): ?>
  <label>Telefono  :</label>
  <?= $user->phone; ?><br>
<? endif ?>
<label>Puntuacion:</label>
#  <br>

<hr>

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
<br><br>

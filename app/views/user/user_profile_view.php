
<? if($_SESSION) : ?>
  <? if($_SESSION['user']==$user): ?>
    <hr>
    <a href="/user/user_edit.php">Modificar Datos de Usuario - </a>
    <a href="/user/user_habilitation.php?id=<?= $user->id; ?> &amp; action=disable" onclick="return confirm('¿Está seguro que desea deshabilitar su usuario? Recuerde que esta accion es permanente y no puede revertirse. En caso afirmativo, se cerrará la sesión.')">Deshabilitar Usuario</a>
    <hr>
  <? endif ?>
<? endif ?>

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
<? if(! $user->is_admin ): ?>
  <label>Puntuacion:</label>
  <? if($average_score===null): ?>
    No tiene puntuacion
  <? else: ?>
    <a href="/user/user_scores_as_visitor.php?id=<?= $user->id ?>"><?=$average_score?></a>
  <? endif ?>
<? endif ?>
<br>

<? if($_SESSION) : ?>
  <? if($_SESSION['user']==$user): ?>
    <hr>
    <? if(! $_SESSION['user']->is_admin): ?>
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
    <? endif ?>
  <? endif ?>
<? endif ?>
<br><br>

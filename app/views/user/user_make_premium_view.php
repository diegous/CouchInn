
<br>


<? if($user_was_premium): ?>
  Ya es un usuario premium.
  <br>
  <a href="/index.php">Volver</a>
<? elseif($user_has_paid): ?>
  Se ha vuelto un usuario premium.
  <br>
  <a href="/user/user_edit.php">Volver</a>
<? else: ?>
  No tiene permisos para acceder a esta pagina.
  <br>
  <a href="/index.php">Volver</a>
<? endif ?>
<br>




<br>
<br>

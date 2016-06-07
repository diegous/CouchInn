
<br>


<? if($user_was_premium): ?>
  Ya es un usuario premium.
  <a href="index.php">Volver</a>
<? elseif($user_has_paid): ?>
  Se ha vuelto un usuario premium.
  <a href="user_edit.php">Volver</a>
<? else: ?>
  No tiene permisos para acceder a esta pagina.
  <a href="index.php">Volver</a>
<? endif ?>
<br>




<br>
<br>

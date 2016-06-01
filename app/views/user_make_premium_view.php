
<br>


<? if($user_was_premium): ?>
	Ya es un usuario premium.
<? elseif($user_has_paid): ?>
	Se ha vuelto un usuario premium.	
<? elseif(!$user_has_paid ): ?>
	Debe pagar para volverse usuario premium.<br>
	<a href="payment_system.php">Sistema de pago</a>
<? endif ?>
<br>

<a href="index.php">Volver</a>


<br>
<br>

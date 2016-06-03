
<form action="payment_system.php" method="post">	
	<script type="text/javascript">
		writeCardHint=(function(){
			var ejemplos={
					"credito":'123 12345 12345678901234',
					"debito":'123456789 123456 123'
				};
			var regex_map=<?= json_encode($regex_map); ?>;

			return function (){
				var lista=document.getElementById("type_card");
				var elem=lista.options[lista.selectedIndex];
				var codigo=ejemplos[elem.value];
				document.getElementById("card_hint").innerHTML=codigo;
				var inputCodigo=document.getElementById("codigo_tarjeta");
				inputCodigo.placeholder=codigo;
				inputCodigo.pattern=regex_map[elem.value];
			}
		})()
	</script>
	<table>
		<tr>
			<td><label>Tipo de Tarjeta Bancaria</label></td>
			<td>
			<select name="type_card" id="type_card"  onchange="writeCardHint();"> 
			  	<option value="credito" >credito</option>
			  	<option value="debito" >debito</option>	  	
			</select>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top"><label>Codigo de Tarjeta Bancaria</label></td>
			<td>
				<input name="codigo_tarjeta" id="codigo_tarjeta" size=30 required="required" value=""	 >
				<? if($wronginput): ?>
					<span style="color:red">Ha ingresado mal el codigo</span>
				<? endif ?>
				<br>
				<label>Ejemplo: <span id="card_hint"></span></label>
			</td>
		</tr>
		<tr><td><input type="submit" value="Realizar pago" ></td></tr>
	</table>

	<script type="text/javascript"> writeCardHint(); </script>
</form>


<script type="text/javascript">
  $(document).ready(function(){
		var ejemplos={
				"credito":'123 12345 12345678901234',
			};
		var regex_map=<?= json_encode($regex_map); ?>;

		var onSelection=function (){
			var valor=$(".select-card-type").val();
			var codigo=ejemplos[valor];
			$("#card_hint").html(codigo);
			$(".input-card-code").attr("placeholder",codigo);
			// $(".input-card-code").attr("pattern",regex_map[valor]);
		}

    var validation=function(e){
      e.preventDefault();
      var errorResult;
      //serializo el formulario para enviarlo por post
      var formulario=$(".form-card-code").serialize();
      ajaxSync("payment_system_validation.php",formulario,
        function(message){errorResult=message;});
      var resultTable=parseJson(errorResult);
      var success=(resultTable["error"]===false);
      if(success){
      	$(".label-error-card-code").hide();
      	//envio los datos a payment_system_validation para volverse premium si es valido
			  window.location="/user/user_make_premium.php";
      }else{
	      $(".label-error-card-code").show()
      }
    }

    $(".form-card-code").on("submit",validation);
    $(".select-card-type").on("change ",onSelection);

    onSelection();
  })

</script>

<? if(isset($_POST["amount"])&& !empty($_POST["amount"])): ?>

<form class="form-card-code" action="">
		<h2>Tipo de Tarjeta Bancaria</h2>
		<h6>Debe pagar $<? echo $_POST["amount"] ?></h6>
		<br>
		<select name="type_card" class="select-card-type"  onchange="writeCardHint();">
		  	<option value="credito" >credito</option>
		</select>
		<br>
		<h3>Codigo de Tarjeta Bancaria</h3>

    <input type="text" name="codigo_tarjeta" class="input-card-code" size=30 value=""  >
		<input type="text" name="payment_amount" class="input-amount" hidden="true"
      value="<? echo $_POST["amount"] ?>"	 >
    <input type="text" name="user" class="input-user_id" hidden="true"
      value="<? echo $_SESSION["user"]->id ?>"  >
		<span class='label-error-card-code' style="color:red" hidden="true">
			Ha ingresado mal el codigo
		</span>
		<br>
		<label>Ejemplo: <span id="card_hint"></span></label>
		<br>
		<input type="submit" value="Realizar pago" >

</form>

<? else: ?>
	
	No se especifico una cantidad monetaria.

<? endif ?>

<div id="hidden-form-placeholder"></div>

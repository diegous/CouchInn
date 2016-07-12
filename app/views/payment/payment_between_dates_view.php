<script type="text/javascript">
    

    $(document).ready(function(){
      var validation=function(e){
        e.preventDefault();
        var errorTable;
        //serializo el formulario para enviarlo por post
        var formulario=$("#date-sum-form").serialize();
        ajaxSync("payment_between_dates_calculation.php",formulario,
          function(message){errorTable=message;});
        errorTable=parseJson(errorTable);
        var success=(errorTable["error"]===false);
        var texto=(success? "$"+errorTable["sum"] : errorTable["error"] );
        $("#date-sum").val(texto);
      }

      $("#date-sum-form").on("submit",validation);
      $("#date-sum-submit").on("click ",validation);

    })


</script>

<form class="form-inline" id="date-sum-form" role="form">
    <h2>Estimar Ganancias entre 2 Fechas</h2>
    <br>
    <div class="form-group">
      <label for="date-start">Inicio(AAAA-MM-DD):</label>
      <input type="date" class="form-control" id="date-start" name="date_start"
            value="<?= date('Y-m-d') ?>"
            pattern="([01]\d{3}|20[0-2]\d|203[0-7])-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])" required>
    </div>
    &nbsp;&nbsp;&nbsp;
    <div class="form-group">
      <label for="date-end">Fin&nbsp;&nbsp;&nbsp;(AAAA-MM-DD):</label>
      <input type="date" class="form-control" id="date-end" name="date_end"
            value="<?= date('Y-m-d') ?>"
            pattern="(19\d{2}|20[0-2]\d)-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])" required>
    </div>
    &nbsp;&nbsp;&nbsp;
    <button id="date-sum-submit" type="submit" class="btn btn-default">Aceptar</button>
    <br><br>
    <div class="form-group">
      <label for="date-sum">Ganancias entre dos fechas:</label>
      <input type="text" class="form-control" id="date-sum" disabled="disabled">
    </div>
    
    <br><br><br>
</form>

<div>
  <h2>Pedir reserva</h2>
  <form class="panel-body" action="/reservation/reservation_create.php" onsubmit="return checkValidDates(this)" method="POST">

    <input type="hidden" name="couch_id" value="<?= $couch->id ?>" >

    <div class="form-group">
      <label for="start_date">Fecha de Inicio</label><br>
      <input id="start_date" class="form-control" type="date" name="start_date" required
        pattern="\d{4}-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])" placeholder="aaaa-mm-dd">
    </div>

    <div class="form-group">
      <label for="end_date">Fecha de Finalizaci&oacute;n</label><br>
      <input id="end_date" class="form-control" type="date" name="end_date" required
        pattern="\d{4}-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])" placeholder="aaaa-mm-dd">
    </div>


    <input type="submit" class="btn btn-default" value="Pedir Reserva"/>
  </form>
</div>

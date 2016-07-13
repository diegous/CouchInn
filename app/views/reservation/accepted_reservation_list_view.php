<h2>Reservas aceptadas entre fechas</h2>

<form action="accepted_reservation_list.php" method="get" >

    <div class="form-group">
      <label for="date-start">Inicio (AAAA-MM-DD):</label>
      <input type="date" class="form-control" id="date-start" name="date_start"
            <? if(isset($date_start)) echo "value='$date_start'"; ?>
            pattern="([01]\d{3}|20[0-2]\d|203[0-7])-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])" required>
    </div>

    <div class="form-group">
      <label for="date-end">Fin (AAAA-MM-DD):</label>
      <input type="date" class="form-control" id="date-end" name="date_end"
            <? if(isset($date_end)) echo "value='$date_end'"; ?>
            pattern="(19\d{2}|20[0-2]\d)-(0[1-9]|1[012])-(0[1-9]|[1-2]\d|3[01])"
            required>
    </div>
    <button id="date-sum-submit" type="submit" class="btn btn-default">Aceptar</button>
</form>

<? if (isset($accepted_reservation_list)): ?>
  <? if (count($accepted_reservation_list) == 0): ?>
    <h4 id="header-resultados">No se encontraron reservas confirmadas entre esas fechas</h4>
  <? else: ?>
    <h4 id="header-resultados">Reservas aceptadas entre <?=$date_start?> y <?=$date_end?></h4>
    <table class="table">
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Due&ntilde;o</th>
              <th>Visitante</th>
              <th>Inicio</th>
              <th>Fin</th>
            </tr>
          </thead>
          <tbody>
            <? foreach ($accepted_reservation_list as $reservation): ?>
              <tr>
                <?
                  $couch=$couch_list[$reservation->couch_id];
                  $owner=$user_list[$couch->user_id];
                  $guest=$user_list[$reservation->user_id];
                ?>
                <td><a href="/couch/couch.php?id=<?=$couch->id?>"><?=$couch->title?></a> </td>
                <td><?=$owner->email?></td>
                <td><?=$guest->email?></td>
                <td><?= $reservation->start_date ?></td>
                <td><?= $reservation->end_date ?></td>
              </tr>
            <? endforeach ?>
          </tbody>
        </table>
  <? endif ?>
  <script>
    $(document).ready(function(){
      document.getElementById("header-resultados").scrollIntoView( true );
    })
  </script>
<? endif ?>
<br>

<? if (isset($finished_reservation_list)): ?>
  <? if (count($finished_reservation_list) == 0): ?>
    <h4 id="header-resultados">No se encontraron reservas finalizadas entre esas fechas</h4>
  <? else: ?>
    <h4 id="header-resultados">Reservas finalizadas entre <?=$date_start?> y <?=$date_end?></h4>
    <table class="table">
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Due&ntilde;o</th>
              <th>Visitante</th>
              <th>Inicio</th>
              <th>Fin</th>
            </tr>
          </thead>
          <tbody>
            <? foreach ($finished_reservation_list as $reservation): ?>
              <tr>
                <?
                  $couch=$couch_list[$reservation->couch_id];
                  $owner=$user_list[$couch->user_id];
                  $guest=$user_list[$reservation->user_id];
                ?>
                <td><a href="/couch/couch.php?id=<?=$couch->id?>"><?=$couch->title?></a> </td>
                <td><?=$owner->email?></td>
                <td><?=$guest->email?></td>
                <td><?= $reservation->start_date ?></td>
                <td><?= $reservation->end_date ?></td>
              </tr>
            <? endforeach ?>
          </tbody>
        </table>
  <? endif ?>
  <script>
    $(document).ready(function(){
      document.getElementById("header-resultados").scrollIntoView( true );
    })
  </script>
<? endif ?>
<br>

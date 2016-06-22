

<div>
  <h2>Todas Mis Reservas(las que hice).</h2>
  <? foreach ($orden_de_reservas as $tipo_reserva): ?>
  <? $reservation_list=$reservation_map[$tipo_reserva]; ?>
    <h3><?= $tipo_reserva ?>s:</h3>
      <? if (count($reservation_list) == 0): ?>
        <h4>No se encontraron reservas de este tipo</h4>
      <? else: ?>

        <table class="table">
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Due&ntilde;o</th>
              <th>Inicio</th>
              <th>Fin</th>
            </tr>
          </thead>
          <tbody>
            <? foreach ($reservation_list as $reservation): ?>
              <tr>
                <?
                  $couch=$couch_list[$reservation->couch_id];
                  $owner=$owner_list[$couch->user_id];
                  echo '<td>' . $couch->title . '</td>';
                  echo '<td>' . $owner->email . '</td>';
                ?>
                <td><?= $reservation->start_date ?></td>
                <td><?= $reservation->end_date ?></td>
              </tr>
            <? endforeach ?>
          </tbody>
        </table>
      <? endif ?>
    
    <br>
  <? endforeach ?>

</div>

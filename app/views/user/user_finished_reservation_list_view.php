<div>
  <h2>Listado de Couchs donde me hospedé</h2>
  <? if (count($reservation_list) == 0): ?>
    <h4>No se encontraron reservas finalizadas para este usuario</h4>
  <? else: ?>
    <table class="table">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Usuario</th>
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
</div>

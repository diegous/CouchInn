<div>
  <h2>Reservas</h2>
  <? if (count($reservation_list) == 0): ?>
    <h4>No se encontraron reservas para este Couch</h4>
  <? else: ?>
    <table class="table">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th>Estado</th>
          <th>Acci&oacute;n</th>
        </tr>
      </thead>
      <tbody>
        <? foreach ($reservation_list as $reservation): ?>
          <tr>
            <td><?= $user_list[$reservation->user_id]->email ?></td>
            <td><?= $reservation->start_date ?></td>
            <td><?= $reservation->end_date ?></td>
            <td><?= $state_list[$reservation->state_id]->description ?></td>
            <td>
              <? if ($reservation->state_id == $state_list["Pendiente"]) : ?>
                <a href="/reservation/reservation_update.php?action=confirm&amp;id=<?= $reservation->id ?>">
                  Aceptar
                </a> -
                <a href="/reservation/reservation_update.php?action=reject&amp;id=<?= $reservation->id ?>" onclick="return confirm('¿Seguro que desea rechazar la reserva?')">
                  Rechazar
                </a>
              <? endif ?>
            </td>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  <? endif ?>
</div>



<div>
  <h2>Todas Las Reservas Que Hice.</h2>

  <h3>Finalizadas:</h3>
  <? if (count($reservation_map['Finalizada']) == 0): ?>
    <h4>No se encontraron reservas de este tipo</h4>
  <? else: ?>

    <table class="table">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Due&ntilde;o</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th>Puntaje</th>
        </tr>
      </thead>
      <tbody>
        <? foreach ($reservation_map['Finalizada'] as $reservation): ?>
          <tr>
            <?
              $couch=$couch_list[$reservation->couch_id];
              $owner=$owner_list[$couch->user_id];
            ?>
            <td><a href="/couch/couch.php?id=<?=$couch->id?>"><?=$couch->title?></a> </td>
            <td><?=$owner->email?></td>
            <td><?= $reservation->start_date ?></td>
            <td><?= $reservation->end_date ?></td>
            <td>
            <? if ($reservation->score_for_couch == -1): ?>
              Puntuar:
              <a href="/reservation/reservation_score.php?id=<?= $reservation->id ?>&amp;for=couch&amp;score=1">1</a>
              <a href="/reservation/reservation_score.php?id=<?= $reservation->id ?>&amp;for=couch&amp;score=2">2</a>
              <a href="/reservation/reservation_score.php?id=<?= $reservation->id ?>&amp;for=couch&amp;score=3">3</a>
              <a href="/reservation/reservation_score.php?id=<?= $reservation->id ?>&amp;for=couch&amp;score=4">4</a>
              <a href="/reservation/reservation_score.php?id=<?= $reservation->id ?>&amp;for=couch&amp;score=5">5</a>
            <? else: ?>
              <?= $reservation->score_for_couch ?>
            <? endif ?>
            </td>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  <? endif ?>
  <br>

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
                ?>
                <td><a href="/couch/couch.php?id=<?=$couch->id?>"><?=$couch->title?></a> </td>
                <td><?=$owner->email?></td>
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

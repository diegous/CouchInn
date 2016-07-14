<h2>Todas Mis Puntuaciones Como Usuario.</h2>


<div>
  <table class="table">
    <thead>
      <tr>
        <th>En el Couch</th>
        <th>Due&ntilde;o</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Puntaje</th>
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
          <td><?= $reservation->score_for_user ?></td>
        </tr>
      <? endforeach ?>
    </tbody>
  </table>
  <br>
  

</div>

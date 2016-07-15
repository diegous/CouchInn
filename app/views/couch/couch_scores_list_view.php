<h2>Puntajes hechos a este Couch</h2>

<div>
  <table class="table">
    <thead>
      <tr>
        <th>Visitante</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Puntaje</th>
        <th>Comentario</th>
      </tr>
    </thead>
    <tbody>
      <? foreach ($reservation_list as $reservation): ?>
        <? if ($reservation->score_for_couch != -1): ?>
          <tr>
            <?
              $user = $user_list[$reservation->user_id];
            ?>
            <td><a href="/user/user_profile.php?id=<?=$user->id?>"><?=$user->email?></a> </td>
            <td><?= $reservation->start_date ?></td>
            <td><?= $reservation->end_date ?></td>
            <td><?= $reservation->score_for_couch ?></td>
            <td><?= $reservation->comment_for_couch ?></td>
          </tr>
        <? endif ?>
      <? endforeach ?>
    </tbody>
  </table>
  <br>


</div>

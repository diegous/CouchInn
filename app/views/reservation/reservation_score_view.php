<h1 class="page-header">Puntuar Reserva</h1>

<div class="panel panel-default">
  <div class="panel-heading">Campos a completar</div>
  <form class="panel-body" action="/reservation/reservation_score_save.php" method="post">
    <input type="hidden" name="id" value="<?= $reservation->id ?>">
    <input type="hidden" name="for" value="<?= $score_for ?>">

    <div class="form-group">
      <label for="score">Puntaje</label><br>
      <select id="score" class="" name="score" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
    </div>

    <div class="form-group">
      <label for="comment">Comentario</label><br>
      <input id="comment" class="form-control" type="text" name="comment" required>
    </div>

    <button type="submit" class="btn btn-default">Guardar</button>
    <a href="javascript:returnToPreviousPage()" class="btn btn-default">Cancelar</a>
  </form>
</div>

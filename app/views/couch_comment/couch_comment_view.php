<hr>
  <? if(isset($_SESSION['user']) && ($_SESSION['user']->id <> $couch->user_id) && !($_SESSION['user']->is_admin)) : ?>
  <form action="/couch_comment/couch_comment_create.php" method="post">
    <div class="form-group">
      <input type="hidden" name="couch_id" value="<?= $couch->id ?>">
      <input type="hidden" name="user_id" value="<?= $_SESSION['user']->id ?>">
      <div class="form-group">
        <input id="question" class="form-control" type="text" name="question" required>
      </div>
      <button type="submit" class="btn btn-default">Preguntar</button>
    </div>
  </form>
<? endif ?>

<h2>Preguntas del Couch</h2>
<? foreach ($comment_list as $couch_comment): ?>
  <hr>
  <form  action="/couch_comment/couch_comment_update.php" method="post">
    <input type="hidden" name="id" value="<?= $couch_comment->id ?>">
    <p>
      <span class="glyphicon glyphicon-comment" style="color:blue" title="Pregunta" aria-hidden="true"></span>&nbsp;&nbsp;<?= $couch_comment->comment_question; ?>
    </p>

    <? if (!$couch_comment->comment_answer): ?>
      <? if(isset($_SESSION['user']) && ($_SESSION['user']->id == $couch->user_id)) : ?>
        <input id="answer" class="form-control" type="text" name="respuesta" required>
        <br>
        <button type="submit" class="btn btn-default">Responder</button>
      <?endif?>
    <? else: ?>
      <p class="couch-answer">
        &nbsp;&nbsp;<span class="glyphicon glyphicon-comment" style="color:lightblue" title="Pregunta" aria-hidden="true"></span>&nbsp;&nbsp;<?= $couch_comment->comment_answer ?>
      </p>
    <? endif ?>
  </form>
<? endforeach ?>

<? include($DRV . "/couch_comment/couch_comment_user_view.php") ?>

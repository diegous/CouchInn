<? if(isset($_SESSION['user'])) : ?>
  <h2>Preguntas sin responder</h2>
  <? foreach ($comment_list_user as $comment_user): ?>
    <p> <?= $comment_user->user_id ?></p>
    <p> <?= $comment_user->couch_id ?></p>
    <p> <?= $comment_user->comment_question ?></p>
  <? endforeach ?>
<? endif ?>

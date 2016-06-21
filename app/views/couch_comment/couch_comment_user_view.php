<h2>Preguntas sin responder</h2>

<? if(isset($_SESSION['user'])) : ?>
  <table class="table">
    <thead>
      <tr>
        <th>Couch</th>
        <th>Pregunta</th>
      </tr>
    </thead>
    <tbody>
      <? foreach ($comment_list_user as $comment_user) : ?>
        <tr>
          <td><?= $comment_user->couch_id ?></td>
          <td>
            <a href="/couch/couch.php?id=<?= $comment_user->couch_id ?>">
            <?= $comment_user->comment_question ?>
              <!--<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> -->
            </a>
          </td>
        </tr>
      <? endforeach ?>
    </tbody>
  </table>
<? endif ?>

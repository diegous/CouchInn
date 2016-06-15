
  <? if ($_SESSION && $_SESSION['user']): ?>
    <? if(($_SESSION['user']->id == $couch->user_id) || ($_SESSION['user']->is_admin)) : ?>
      <hr>
      <? if ($couch->enabled) : ?>
        <a href="/couch/couch_habilitation.php?action=disable&amp;id=<?= $couch->id ?>">Deshabilitar Couch</a>
      <? else : ?>
        <a href="/couch/couch_habilitation.php?action=enable&amp;id=<?= $couch->id ?>">Habilitar Couch</a>
      <? endif ?>
    <?endif?>
    <? if($_SESSION['user']->id == $couch->user_id) : ?>
      -
      <a href="/couch/couch_edit.php?id=<?= $couch->id ?>">Modificar Couch</a>
    <?endif?>
    <hr>
  <?endif?>

<h2><?= $couch->title; ?></h2>

<div class="couch-info-container">
  <!--<h3>Due&ntilde;o:</h3>-->
  <!--<p class=""><?= $owner->name ?>, <?= $owner->last_name ?></p>-->
  <p><b>Due&ntilde;o: </b> <?= $owner->name ?>, <?= $owner->last_name ?></p>
  <!--<h3>Descripci&oacute;n: </h3> -->
  <!--<p class="couch-description"> <?= $couch->description; ?> </p> -->
  <p><b>Descripci&oacute;n: </b> <?= $couch->description; ?> </p>
  <!--<h3>Tipo:</h3>
  <p class="couch-description"> <?= $couch_type->description; ?> </p>-->
  <p><b>Tipo: </b> <?= $couch_type->description; ?> </p>
  <!--<h3>Capacidad:</h3>
  <p class="couch-capacity"><?= $couch->capacity; ?></p>-->
  <p><b>Capacidad: </b> <?= $couch->capacity; ?> </p>
  <!--<h3>Ubicaci&oacute;n:</h3>
  <p class="couch-location"><?= $couch->location; ?></p>-->
  <p><b>Ubicaci&oacute;n: </b> <?= $couch->location; ?> </p>
</div>

<div>
  <? foreach ($picture_list as $picture): ?>
    <img class="couch-img" src="/resources/images/<?= $picture->filename ?>">
  <? endforeach ?>
</div>
<br>
<br>

  <label for="name">Preguntas al couch</label><br>
  <form class="panel-body" action="/couch_comment/couch_comment_create.php" method="post">
      <div class="form-group">
        <div class="form-group">
          <label for="name">Preguntar</label><br>
          <input name="couch_id" value="<?= $couch->id ?>">
          <input id="preguntar" class="form-control" type="preguntar"
                 name="pregunta" required>
        </div>
        <button type="submit" class="btn btn-default">Enviar pregunta</button>
  </form>

  <? foreach ($comment_list as $couchcomment): ?>
    <form class="panel-body" action="/couch_comment/couch_comment_update.php" method="post">
      <div class="form-group">
        <!--<input type="hidden" name="id" value="<?= $couch_comment->id ?>"> -->
        <input name="id" value="<?= $couchcomment->id ?>">
        <div class="form-group">
          <label for="name">Pregunta</label><br>
          <input id="pregunta" class="form-control" type="pregunta"
                 name="pregunta" value="<?= $couchcomment->comment_question; ?>" disabled>
        </div>
        </tr>
        <tr>
          <div class="form-group">
            <label for="last_name">Respuesta</label><br>
            <input id="respuesta" class="form-control" type="respuesta"
                 name="respuesta" required value="<?= $couchcomment->comment_answer; ?>">
          </div>
        </tr>
        <? if ($_SESSION && $_SESSION['user']): ?>
          <? if(($_SESSION['user']->id == $couch->user_id)) : ?>
            <? if ($couchcomment->comment_answer) : ?>
              <button type="submit" class="btn btn-default">Responder</button>
            <?endif?>
          <?endif?>
        <?endif?>
        <br>
      </div>
    </form>
  <? endforeach ?>


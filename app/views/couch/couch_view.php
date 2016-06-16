<? if ($_SESSION && $_SESSION['user']): ?>
  <? if($_SESSION['user']->id == $couch->user_id) : ?>
    <hr>
    <? if ($couch->enabled==1) : ?>
      <a href="/couch/couch_habilitation.php?action=disable&amp;id=<?= $couch->id ?>">Deshabilitar Couch - </a>
    <? else : ?>
      <? if ($couch->enabled==0) : ?>
        <a href="/couch/couch_habilitation.php?action=enable&amp;id=<?= $couch->id ?>">Habilitar Couch - </a>
      <?endif?>
    <?endif?>
    <a href="/couch/couch_edit.php?id=<?= $couch->id ?>">Modificar Couch</a>
    <hr>
    <? if ($couch->enabled==2) : ?>
      <strong><h4 style="color:red;">¡Atención Couch Deshabilitado por el administrador! </p></strong>
    <?endif?>
  <? endif ?>
  <? if($_SESSION['user']->is_admin): ?>
    <hr>
    <? if ($couch->enabled==1) : ?>
      <a href="/couch/couch_habilitation.php?action=disable&amp;id=<?= $couch->id ?>">Deshabilitar Couch</a>
    <? else : ?>
      <? if (($couch->enabled==0) || ($couch->enabled==2)): ?>
        <a href="/couch/couch_habilitation.php?action=enable&amp;id=<?= $couch->id ?>">Habilitar Couch</a>
      <?endif?>
    <?endif?>
    <hr>
  <?endif?>
<?endif?>

<h1><?= $couch->title; ?></h1>
<div class="couch-info-container">
  <h3>Due&ntilde;o:</h3>
  <p class=""><?= $owner->name ?>, <?= $owner->last_name ?></p>

  <h3>Descripci&oacute;n:</h3>
  <p class="couch-description"> <?= $couch->description; ?> </p>

  <h3>Tipo:</h3>
  <p class="couch-description"> <?= $couch_type->description; ?> </p>

  <h3>Capacidad:</h3>
  <p class="couch-capacity"><?= $couch->capacity; ?></p>

  <h3>Ubicaci&oacute;n:</h3>
  <p class="couch-location"><?= $couch->location; ?></p>
  <div>
    <? foreach ($picture_list as $picture): ?>
      <img class="couch-img" src="<?=$COUCHPICTUREDIR."/". $picture->filename ?>"
           onError="this.src='<?=$PICTUREDIR?>/couchinn-logo-couch.png';">
    <? endforeach ?>
  </div>
</div>

<hr>
<h3>Preguntas del Couch</h3>
<? foreach ($comment_list as $couch_comment): ?>
  <form class="panel-body" action="/couch_comment/couch_comment_update.php" method="post">
    <div class="form-group">
      <input type="hidden" name="id" value="<?= $couch_comment->id ?>">
      <div class="form-group">
        <label for="name">Pregunta</label><br>
        <p><?= $couch_comment->comment_question; ?></p>
      </div>
      </tr>
      <tr>
      </tr>
      <? if (!$couch_comment->comment_answer): ?>
        <? if(isset($_SESSION['user']) && ($_SESSION['user']->id == $couch->user_id)) : ?>
          <div class="form-group">
            <label for="answer">Respuesta</label><br>
            <input id="answer" class="form-control" type="text" name="respuesta" required>
          </div>
          <button type="submit" class="btn btn-default">Responder</button>
        <?endif?>
      <? else: ?>
        <p class="couch-answer"><b><?= $couch_comment->comment_answer ?></b></p>
      <? endif ?>
      <br>
    </div>
  </form>
<? endforeach ?>

<hr>

<? if (isset($_SESSION['user']) && !($_SESSION['user']->is_admin)): ?>
  <? if ($_SESSION['user']->id == $couch->user_id): ?>
    <? include($DRV . "/couch/couch_reservation_list.html.php") ?>
  <? else: ?>
    <? include($DRV . "/couch/couch_reservation_form.html.php") ?>
  <? endif ?>
<? endif ?>

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
             onError="this.src='<?=$PICTUREDIR?>/couchinn-logo-couch.png';"
        >
    <? endforeach ?>
  </div>
</div>

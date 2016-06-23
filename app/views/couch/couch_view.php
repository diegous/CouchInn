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

<? if ($couch->enabled==2) : ?>
  <strong><h4 style="color:red;">¡Atención Couch Deshabilitado por el administrador! </p></strong>
<? else : ?>
  <? if ($couch->enabled==0) : ?>
      <strong><h4 style="color:red;">¡Atención Couch Deshabilitado! </p></strong>
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
      <img class="couch-img" src="<?=Picture::get_full_path($picture->filename) ?>"
           onError="this.src='<?=$PICTUREDIR?>/couchinn-logo-couch.png';">
    <? endforeach ?>
  </div>
</div>

<? include($DRV . "/couch_comment/couch_comment_view.php") ?>

<hr>

<? if (isset($_SESSION['user']) && !($_SESSION['user']->is_admin)): ?>
  <? if ($_SESSION['user']->id == $couch->user_id): ?>
    <? include($DRV . "/couch/couch_reservation_list.html.php") ?>
  <? else: ?>
    <? include($DRV . "/couch/couch_reservation_form.html.php") ?>
  <? endif ?>
<? endif ?>

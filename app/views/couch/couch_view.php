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
  <br>
  
  <? if ($_SESSION && $_SESSION['user']): ?>
    <? if(($_SESSION['user']->id == $couch->user_id) || ($_SESSION['user']->is_admin)) : ?>
      <? if ($couch->enabled) : ?>
        <a href="couch_habilitation.php?action=disable&amp;id=<?= $couch->id ?>">Deshabilitar</a>
      <? else : ?>
        <a href="couch_habilitation.php?action=enable&amp;id=<?= $couch->id ?>">Habilitar</a>  
      <? endif ?>
    <?endif?>
  <?endif?>

</div>

<div>
  <? foreach ($picture_list as $picture): ?>
    <img class="couch-img" src="images/<?= $picture->filename ?>">
  <? endforeach ?>
</div>
<br>

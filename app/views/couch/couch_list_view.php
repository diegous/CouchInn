<h1>Listado de couch</h1>

<? if ($_SESSION && $_SESSION['user']): ?>
  <? $user_id = $_SESSION['user']->id ?>
<? else : ?>
  <? $user_id = 0 ?>
<? endif ?>

<? foreach ($couch_list as $couch): ?>
  <? if (($couch->enabled) || ($user_id == $couch->user_id)): ?>
    <div class="couch-list-item">
      <a href="couch.php?id=<?= $couch->id ?>">
        <img class="couch-img"
             src="<? if (isset($images[$couch->id])) : ?>
                    images/<?= $images[$couch->id] ?>
                  <? else : ?>
                    images/couchinn-logo-couch.png
                  <? endif ?>
                  " title="Ver couch">
      </a>
      <div class="couch-info-container">
        <h3 class="couch-title">
          <a href="couch.php?id=<?= $couch->id ?>">
            <?= $couch->title; ?>
          </a>
        </h3>
        <label>Tipo:</label>
        <p class="couch-description"><?= $couch_types[$couch->type_id]->description ?></p>
        <label>Descripci&oacute;n:</label>
        <p class="couch-description"> <?= $couch->description; ?></p>
        <label>Capacidad:</label>
        <p class="couch-capacity"> <?= $couch->capacity; ?></p>
        <label>Ubicaci&oacute;n:</label>
        <p class="couch-location"> <?= $couch->location; ?></p>
        <? if (!$couch->enabled) : ?>
          <strong><h4 style="color:red;">¡Atención Couch Deshabilitado! </p></strong>

        <? endif ?>
        <br>
      </div>
      <hr>
    </div>
  <? endif ?>
<? endforeach ?>

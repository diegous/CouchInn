<h1>Listado de couch</h1>

<? foreach ($couch_list as $couch): ?>
  <div class="couch-list-item">
    <a href="couch.php?id=<?= $couch->id ?>">
      <img class="couch-img"
           src="<? if (isset($images[$couch->id])) : ?>
                  images/<?= $images[$couch->id] ?>
                <? else : ?>
                  images/couchinn-logo-couch.png
                <? endif ?>
                ">
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
      <br>
    </div>
    <hr>
  </div>
<? endforeach ?>

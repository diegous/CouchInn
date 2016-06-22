<h3><?=$list_header?></h3>

<? foreach ($couch_list as $couch): ?>
  <div class="couch-list-item">
    <div class="couch-img-container">
      <a href="/couch/couch.php?id=<?= $couch->id ?>">
        <img class="couch-img"
             src="<? if (isset($images[$couch->id])) : ?>
                    <?=Picture::get_full_path($images[$couch->id]) ?>
                  <? else : ?>
                    /resources/images/couchinn-logo-couch.png
                  <? endif ?>
                  "
             title="Ver couch"
             onError="this.src='<?=$PICTUREDIR?>/couchinn-logo-couch.png';"
             >
      </a>
    </div>
    <div class="couch-info-container">
      <h3 class="couch-title">
        <a href="/couch/couch.php?id=<?= $couch->id ?>">
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
      <? if (($couch->enabled==0) || ($couch->enabled==2)) : ?>
        <strong><h4 style="color:red;">¡Atención Couch Deshabilitado! </p></strong>

      <? endif ?>
      <br>
    </div>
  </div>
  <hr>
<? endforeach ?>


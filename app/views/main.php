<h1>Listado de couch</h1>
  <? foreach ($couch_list as $couch): ?>
    <div class="couch-list-item">
      <img class="couch-img" src="images/couchinn-logo-couch.png">
      <div class="couch-info-container">
        <h3 class="couch-title">
          <a href="couch_view.php?id=<?= $couch->id ?>">
            <?= $couch->title; ?>
          </a>
        </h3>
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


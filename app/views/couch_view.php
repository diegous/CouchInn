<h1>Ver couch</h1>

<div class="couch-info-container">
  <h3 class="couch-title"> <?= $couch->title; ?> </h3>
  <label>Descripci&oacute;n:</label>
  <p class="couch-description"> <?= $couch->description; ?> </p>
  <label>Capacidad:</label>
  <p class="couch-capacity"><?= $couch->capacity; ?></p>
  <label>Ubicaci&oacute;n:</label>
  <p class="couch-location"><?= $couch->location; ?></p>
  <br>
</div>

<button onclick="alert('El mail fue enviado correctamente')">Recuperar contrase&ntilde;a</button>

<div>
  <? foreach ($picture_list as $picture): ?>  
    <img class="" src="images/<?= $picture->filename ?>">
  <? endforeach ?>
</div>

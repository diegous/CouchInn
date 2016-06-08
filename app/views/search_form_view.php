<form class="panel-body" action="search.php" method="get">

  <div class="form-group">
    <label for="title">T&iacute;tulo</label><br>
    <input id="title" class="form-control" type="text" name="title" value="<?= $search_form->title ?>">
  </div>

  <div class="form-group">
    <label for="description">Descripci&oacute;n</label><br>
    <input id="description" class="form-control" type="text" name="description" value="<?= $search_form->description ?>">
  </div>

  <div class="form-group">
    <label for="description">Tipo de hospedaje</label><br>
    <input id="description" class="form-control" type="text" name="description" value="<?= $search_form->description ?>">
    <select >
      <? foreach ($couch_type_list as $couch_type) : ?>
        <option value="<?= $couch_type->id ?>">
          <?= $couch_type->description ?>
        </option>
      <? endforeach ?>
    </select>
  </div>

  <div class="form-group">
    <label for="location">Lugar</label><br>
    <input id="location" class="form-control" type="text" name="location" value="<?= $search_form->location ?>">
  </div>

  <div class="form-group">
    <label for="capacity">Descripci&oacute;n</label><br>
    <input id="capacity" class="form-control" type="number" name="capacity" value="<?= $search_form->capacity ?>">
  </div>

  <button type="submit" class="btn btn-default">Buscar</button>
</form>

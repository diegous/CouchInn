
<div class="panel panel-default">
  <div class="panel-heading">Formulario de B&uacute;squeda</div>
  <form class="panel-body" action="search_form.php" method="get">

    <div class="form-group">
      <label for="title">T&iacute;tulo</label><br>
      <input id="title" name="title" class="form-control" type="text" value="<?= $search_form['title'] ?>">
    </div>

    <div class="form-group">
      <label for="description">Descripci&oacute;n</label><br>
      <input id="description" name="description" class="form-control" type="text" value="<?= $search_form['description'] ?>">
    </div>

    <div class="form-group">
      <label for="couch_type">Tipo de hospedaje</label><br>
      <select id="couch_type" name="couch_type">
        <option value="0">Todos</option>
        <? foreach ($couch_types as $couch_type): ?>
          <? if ($couch_type->enabled): ?>
            <option
              <? if ($search_form['couch_type'] == $couch_type->id): ?>
                selected="true"
              <? endif ?>
              value="<?= $couch_type->id ?>">
              <?= $couch_type->description ?>
            </option>
          <? endif ?>
        <? endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <label for="location">Lugar</label><br>
      <input id="location" name="location" class="form-control" type="text" value="<?= $search_form['location'] ?>">
    </div>

    <div class="form-group">
      <label for="capacity">Capacidad</label><br>
      <input id="capacity" name="capacity" class="form-control" type="number" value="<?= $search_form['capacity'] ?>">
    </div>

    <button type="submit" class="btn btn-default">Buscar</button>
  </form>
</div>

<? if (isset($couch_list)): ?>
  <h3>Resultados:</h3>
  <? if (count($couch_list) == 0): ?>
    <h4>No se encontraron resultados</h4>
  <? else: ?>
    <? include($DRV . "/couch/couch_list_view.php") ?>
  <? endif ?>
<? endif ?>

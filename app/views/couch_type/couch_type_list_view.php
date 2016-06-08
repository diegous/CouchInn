<h1>Tipos de couch</h1>

<? include("alerts.php") ?>

<table class="table">
  <thead>
    <tr>
      <th>Descripci&oacute;n</th>
      <th>Editar</th>
      <th>Habilitaci&oacute;n</th>
    </tr>
  </thead>
  <tbody>
    <? foreach ($couch_type_list as $couch_type) : ?>
      <tr>
        <td><?= $couch_type->description; ?></td>
        <td>
          <a href="couch_type_edit.php?id=<?= $couch_type->id ?>">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
        </td>
        <td>
          <? if ($couch_type->enabled) : ?>
            <a href="couch_type_habilitation.php?action=disable&amp;id=<?= $couch_type->id ?>">
              Deshabilitar
            </a>
          <? else : ?>
            <a href="couch_type_habilitation.php?action=enable&amp;id=<?= $couch_type->id ?>">
              Habilitar
            </a>
          <? endif ?>
        </td>
      </tr>
    <? endforeach ?>
  </tbody>
</table>

<div class="panel panel-default">
  <div class="panel-heading">Nuevo tipo de Couch</div>
  <form class="panel-body" action="couch_type_create.php" method="post">

    <div class="form-group">
      <label for="description">Descripci&oacute;n</label><br>
      <input id="description" class="form-control" type="text" name="description">
    </div>

    <button type="submit" class="btn btn-default">Guardar</button>
  </form>
</div>

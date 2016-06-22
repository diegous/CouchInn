<h1 class="page-header">Editar tipo de Couch</h1>

<div class="panel panel-default">
  <div class="panel-heading">Campos a editar</div>
  <form class="panel-body" action="/couch_type/couch_type_update.php" method="post">
    <input type="hidden" name="id" value="<?= $couch_type->id ?>">

    <div class="form-group">
      <label for="description">Descripci&oacute;n</label><br>
      <input id="description" class="form-control" type="text" name="description" value="<?= $couch_type->description ?>">
    </div>

    <button type="submit" class="btn btn-default">Guardar</button>
    <a href="javascript:returnToPreviousPage()" class="btn btn-default">Cancelar</a>
  </form>
</div>

<h1>Modificar datos de couch</h1>
<table class="table">
  <tbody>
    <form action="/couch/couch_update.php" method="post">
      <input type="hidden" name="id" value="<?= $couch->id ?>" >

      <tr>
        <div class="form-group">
          <label for="title">Titulo</label><br>
          <input type="text" name="title" class="form-control" value="<?= $couch->title; ?>" required>
        </div>
      </tr>

      <tr>
        <div class="form-group">
          <label for="description">Descripción</label><br>
          <textarea rows="4" name="description" class="form-control" required><?= $couch->description; ?></textarea>
        </div>
      </tr>

      <tr>
        <div class="form-group">
          <label for="capacity">Capacidad</label><br>
          <input type="number" name="capacity" class="form-control" value="<?= $couch->capacity; ?>" required>
        </div>
      </tr>

      <tr>
        <div class="form-group">
          <label for="location">Ubicación</label><br>
          <input type="text" name="location" class="form-control" value="<?= $couch->location; ?>" required>
        </div>
      </tr>
      <button type="submit" class="btn btn-default">Guardar</button>
    </form>
  </tbody>
</table>

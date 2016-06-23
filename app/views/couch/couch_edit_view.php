<h1>Modificar datos de couch</h1>
<table class="table">
  <tbody>
    <form id="form-couch" action="/couch/couch_update.php" method="post" enctype="multipart/form-data" >
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
          <label for="select-type">Tipo:</label><br>
          <select id="select-type" class="form-control" name="type" required="true" multiple="true">
            <?php foreach($couch_type_list as $couch_type)
                    echo "<option value='$couch_type->id' > $couch_type->description </option> "
            ?>
          </select>
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

      <tr>
      <? include($DRV . "/couch/couch_image_manipulation_panel.php") ?>
      <script type="text/javascript">
        ImagePanelGlobals.redirectTitle="Modificacion de Couch Exitosa";
        ImagePanelGlobals.messageOnRedirect="Modificacion de Couch Exitosa";
        ImagePanelGlobals.redirectToUrl='/couch/couch.php?id='+'<?=$couch->id?>';
        $(function(){
          <? foreach ($imageSources as $key => $value): ?>
            console.log("<?="$key=>$value"?>");
            ImagePanelGlobals.addImagePanel('<?=$value?>',undefined,true);
          <? endforeach ?>
        });
      </script>

      </tr>
      <button type="submit" id="button-submit-couch" class="btn btn-default">Guardar</button>
      <a href="javascript:returnToPreviousPage()" class="btn btn-default">Cancelar</a>
    </form>
  </tbody>
</table>

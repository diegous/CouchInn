
<div class="panel panel-default">
  <div class="panel-heading">Crear couch</div>
  <div class="panel-body">
    <form id="form-couch" action="couch_create_validation.php" method="POST" enctype="multipart/form-data" >
      <div class="form-group">
        <label for="input-titulo">Titulo:</label><br>
        <input id="input-titulo" class="form-control" type="text" name="titulo" required="true">
      </div>

      <div class="form-group">
        <input id="input-titulo" type="text" name="userid"
          hidden="true" value="<? echo $_SESSION['user']->id ?>">
      </div>

      <div class="form-group">
        <label for="select-type">Tipo:</label><br>
        <select id="select-type" class="form-control" name="type" required="true">
          <?php foreach($couch_type_list as $couch_type)
                  echo "<option value='$couch_type->id' > $couch_type->description </option> "
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="input-descripcion">Descripcion:</label><br>
        <textarea id="input-descripcion" class="form-control"
          type="text" name="descripcion" required="required"></textarea>
      </div>

      <div class="form-group">
        <label for="input-lugar">Lugar:</label><br>
        <input id="input-lugar" class="form-control" type="text" name="lugar" required="true">
      </div>

      <div class="form-group">
        <label for="input-capacidad">Capacidad:</label><br>
        <input id="input-capacidad" class="form-control" type="number" name="capacidad"
          pattern="\d+" required="true">
      </div>

    <? include($DRV . "/couch/couch_image_manipulation_panel.php") ?>
    <script type="text/javascript">
      ImagePanelGlobals.redirectTitle="Alta de Couch Exitosa";
      ImagePanelGlobals.messageOnRedirect="Alta de Couch Exitosa";
    </script>
  </div>
  <div class="panel-footer">


    <input type="submit" form="form-couch" id="button-submit-couch"
           class="button-save-couch btn btn-primary btn-block" value="Guardar"/>

  </div>

  </form>

</div>

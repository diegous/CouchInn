<script src="/couch/js/couch_create_validation.js"></script>
<script>
CouchCreateGlobals.tamanioMaximoPost=<?=Picture::$size_limit?>;
</script>
<style>
  .couch-image-shown {
    display: block;
    margin-left: auto;
    margin-right: auto;
    float:none;
  }
  .couch-image-hidden {
    display: none;
    margin-left: none;
    margin-right: none;
    float:none;
  }
  .image-label{
    margin: auto;
    display: block;
    margin-top: 0;
    margin-bottom: 0;
  }
  .progress {
      position: relative;
      background: transparent;
      color: black;
      margin-top: 0;
  }

  .progress-bar span {
      position: absolute;
      display: block;
      width: 100%;
      color: black;
      font-weight: bold;
   }
</style>

<div class="panel panel-default">
  <div class="panel-heading">Crear couch</div>
  <form id="form-couch-create" class="panel-body" action="" method="POST" enctype="multipart/form-data" >
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
      <input id="input-descripcion" class="form-control" type="text" name="descripcion">
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


  <div class="panel panel-default">
    <div class="panel-heading">
      Imagenes
    </div>
    <div class='panel-body'>
      <div id="image-label-big-all"
              class="image-label image-label-big-all alert alert-danger hidden ">
        <h5>
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          Conjunto de imagenes demasiado grande(ocupan <span class="image-filesize"></span>MB)<br>
          (tamaño maximo=<?echo number_format(Picture::$size_limit/(pow(2,20)),2)."MB";?>)
        </h5>
      </div>

      <div class='row' id="couch-images">
        <? for($i = 1; $i <= $max_couch_photos; $i++): ?>
          <div class='panel-couch-image div-file<?=$i?>'>
            <input type="file" name="file<?=$i?>" id="file<?=$i?>"
                    class="file-popup" style="display: none;" />
            <input type="button" class="button-delete-image btn btn-default btn-block"
                   style="display:none"
                   value="Borre la imagen <?= $i ?> ("

                   />
            <input type="button" class="button-choose-file btn btn-default btn-block"
                   value="Seleccione la imagen <?= $i ?>(opcional)" />
            <div class="image-labels">
              <div id="image-label-non-file<?=$i?>"
                    class="image-label image-label-non label alert alert-danger hidden ">
                    <!-- class="image-label image-label-non label label-warning text-center full-width hidden "> -->
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                no es una imagen
              </div>
              <div id="image-label-big-file<?=$i?>"
                    class="image-label image-label-big alert alert-danger hidden">
                    <!-- class="image-label image-label-big label label-warning text-center full-width hidden"> -->
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                Imagen demasiado grande(ocupa <span class="image-filesize" aria-hidden="true"></span>MB)<br>
                (tamaño maximo=<?echo number_format(Picture::$size_limit/(pow(2,20)),2)."MB";?>)
              </div>
            </div>

            <img class="couch-img couch-image-hidden"/>
          </div>
        <? endfor?>
<!--         <button type="submit" form="form-image-list" id="button-submit-image"
                class="btn btn-primary btn-block">Subir imagen</button>   -->
      <!-- </form> -->
      </div>
    </div>
    </form>
  </div>
  <div class="panel-footer">

    <input type="button" class="button-cancel-upload btn btn-primary btn-block hidden"
           value="Cancelar Subida"/>
    <div class="file-transfer-progress hidden">
      <h4>Subiendo datos</h4>
      <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
              <span>60%</span>
          </div>
      </div>
    </div>
    <input type="submit" form="form-couch-create" id="button-submit-couch"
           class="button-save-couch btn btn-primary btn-block" value="Guardar"/>

  </div>


</div>

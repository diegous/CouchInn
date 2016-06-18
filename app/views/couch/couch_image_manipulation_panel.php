<script src="/couch/js/image_panels_validation.js"></script>
<script>
ImagePanelGlobals.tamanioMaximoPost = <?=Picture::$size_limit?>;
ImagePanelGlobals.maximoCntImg = <?=Couch::$maximum_amount_of_pictures?>;
</script>
<link rel="stylesheet" type="text/css" href="/couch/css/image_edit_panel.css">


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
      <!-- < for($i = 1; $i <= 1; $i++): ?>
        <div class='panel-couch-image div-file<?=$i?> form-group hidden'>
          <input type="hidden" class="input-action" name="action-<?=$i?>" 
                 id="action-<?=$i?>" value="upload"/>
          <input type="file" name="file<?=$i?>" id="file<?=$i?>"
                  class="file-popup" style="display: none;" />
          <input type="button" class="button-choose-file btn btn-default btn-block"
                 value="Seleccione la imagen <?= $i ?>(opcional)" />
          <input type="button" class="button-delete-image btn btn-default btn-block"
                 value="Borre la imagen <?= $i ?> (" />
          <div class="image-labels">
            <div id="image-label-non-file<?=$i?>"
                  class="image-label image-label-non label alert alert-danger hidden ">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              no es una imagen
            </div>
            <div id="image-label-big-file<?=$i?>"
                  class="image-label image-label-big alert alert-danger hidden">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              Imagen demasiado grande(ocupa <span class="image-filesize" aria-hidden="true"></span>MB)<br>
              (tamaño maximo=<echo number_format(Picture::$size_limit/(pow(2,20)),2)."MB";?>)
            </div>
          </div>

          <img class="couch-img couch-image-hidden"/>
        </div>
      < endfor?> -->
    </div>
    <button type="button" id="button-add-image"
            class="btn btn-primary btn-block">Agregar imagen</button> 
  </div>
</div>


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

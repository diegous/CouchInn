<script type="text/javascript" src="/couch/js/couch_create_validation.js">
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
      <input id="input-capacidad" class="form-control" type="text" name="capacidad" 
        pattern="\d+" required="true">
    </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      Imagenes
    </div>
    <div class='panel-body'>
      <div class='row' id="couch-images">
      <!-- <iframe id="image-server-response" name="image-server-response"></iframe> -->
      <!-- <form id="form-image-list" target="image-server-response" method="POST" >
          enctype="multipart/form-data" action="couch_create_validation.php" -->
        <? for($i = 1; $i <= $max_couch_photos; $i++): ?>
        <!-- <input type="text" hidden="true" name="id" value="22"> -->
          <div class='panel-couch-image div-file<?=$i?>'>
            <input type="file" name="file<?=$i?>" id="file<?=$i?>"
                    class="file-popup" style="display: none;" />
            <input type="button" class="button-delete-image btn btn-default btn-block"
                   style="display:none" value="Borre la imagen <?= $i ?>"/>
            <input type="button" class="button-choose-file btn btn-default btn-block" 
                   value="Seleccione la imagen <?= $i ?>(opcional)" />
            <h2 class="image-labels">
              <span id="image-label-non-file<?=$i?>"
                    class="image-label image-label-non label label-warning text-center hidden ">
                no es una imagen
              </span>
              <span id="image-label-big-file<?=$i?>"
                    class="image-label image-label-big label label-warning text-center hidden">
                demasiado grande
              </span>
            </h2>
         
            <img class="couch-img couch-image-hidden"/>
          </div>

        <? endfor?>
<!--         <button type="submit" form="form-image-list" id="button-submit-image"
                class="btn btn-primary btn-block">Subir imagen</button>   -->
      <!-- </form> -->
      </div>
    </div>
  </div>
  </form>

  
  <button type="submit" form="form-couch-create" id="button-submit-couch"
          class="btn btn-primary btn-block">Guardar</button>


</div>

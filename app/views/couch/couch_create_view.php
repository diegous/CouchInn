<script type="text/javascript" src="/couch/js/couch_create_validation.js">
  
</script>

<div class="panel panel-default">
  <div class="panel-heading">Crear couch</div>
  <form id="form-couch-create" class="panel-body" action="" method="post">
    <div class="form-group">
      <label for="input-titulo">Titulo:</label><br>
      <input id="input-titulo" class="form-control" type="text" name="titulo" required>
    </div>

    <div class="form-group">
      <input id="input-titulo" type="text" name="userid"
        hidden="true" value="<? echo $_SESSION['user']->id ?>">
    </div>

    <div class="form-group">
      <label for="select-type">Tipo:</label><br>
      <select id="select-type" class="form-control" name="type" required>
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
      <input id="input-lugar" class="form-control" type="text" name="lugar" required>
    </div>

    <div class="form-group">
      <label for="input-capacidad">Capacidad:</label><br>
      <input id="input-capacidad" class="form-control" type="text" name="capacidad" 
        pattern="\d+" required>
    </div>



    <button type="submit" id="button-submit-couch" class="btn btn-default">Guardar</button>
  </form>
<!-- 
  <div id="images-list" >
    <form id="button-images-add" class="panel-body" action="">
      <button type="submit" class="btn btn-default" form="button-images-add">Agregar imagen</button>
    </form>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <form id="prevent-redir">
            <input type="submit" value="Borrar">
          </form>
          <img src="images/456825.jpg" alt="Cinque Terre" class="couch-img">
        </div>
      </div>
    </div>
  </div> -->
</div>
<!-- 
<br>
<br>
<br>
<br>
<img id="offline-image" class="couch-img"/>
<input id="files" type="file" />

<script>
  $(function(){
    var nullify=function(e){
      e.preventDefault();
      alert("noooooooo");
    }
    $("#button-images-add").on("submit",nullify)

    document.getElementById("files").onchange = function () {
      var reader = new FileReader();

      reader.onload = function (e) {
          // get loaded data and render thumbnail.
          document.getElementById("offline-image").src = e.target.result;
      };

      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    };
  })


  
</script> -->




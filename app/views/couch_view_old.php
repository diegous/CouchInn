<h1>Ver couch</h1>
  <!--<? foreach ($couch_array as $couch): ?> -->
    <!--  <tr>
      <td><?= $couch_type->id; ?></td>
      <td><?= $couch_type->description; ?></td>
      <td><a href="couch_type_edit.php?id=<?= $couch_type->id ?>">Editar</a></td>
      <td><a href="couch_type_delete.php?id=<?= $couch_type->id ?>">Borrar</a></td>
    </tr>  -->
    <div class="couch-list-item">
      <img class="couch-img" src="images/couchinn-logo-couch.png">
      <div class="couch-info-container">
        <h3 class="couch-title"> <!-- <?= $couch->title; ?>  --> </h3>
        <label>Descripci&oacute;n:</label>
        <p class="couch-description"> <!--<?= $couch->description; ?>--></p>
        <label>Capacidad:</label>
        <p class="couch-capacity"> <!--<?= $couch->capacity; ?><-->/p>
        <label>Ubicaci&oacute;n:</label>
        <p class="couch-location"> <!--<?= $couch->location; ?>--></p>
        <br>
        <!--
        <form action="couch_view.php?id=<?= $couch->id ?>">
          <button type="submit">Ver couch</a>
        </form>
        -->
      </div>
          
      
          
      <br style="clear:both;"/>

      <hr>
    </div>


 <!-- <? endforeach ?> -->
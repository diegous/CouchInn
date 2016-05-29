<h1>Tipos de couch</h1>
<table class="table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Descripci&oacute;n</th>
      <th>Modificar</th>
      <th>Borrar</th>
    </tr>
  </thead>
  <tbody>
    <? foreach ($couch_type_list as $couch_type): ?>
      <tr>
        <td><?= $couch_type->id; ?></td>
        <td><?= $couch_type->description; ?></td>
        <td><a href="edit_couch_type.php?id=<?= $couch_type->id ?>">Modificar</a></td>
        <td><a href="delete_couch_type.php?id=<?= $couch_type->id ?>">Borrar</a></td>
      </tr>
    <? endforeach ?>
  </tbody>
  <tfoot>
    <form action="new_couch_type.php">
      <td></td>
      <td><input type="text" name="description"></td>
      <td></td>
      <td><input type="submit" value="Enviar"></td>
    </form>
  </tfoot>
</table>

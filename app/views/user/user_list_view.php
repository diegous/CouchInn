<div>
  <h2>Usuarios del sitio</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>F. Nacimiento</th>
        <th>Telefono</th>
        <th>Premium</th>
        <th>Habilitaci&oacute;n</th>
      </tr>
    </thead>
    <tbody>
      <? foreach ($user_list as $user): ?>
        <? if (!$user->is_admin): ?>
          <tr>
            <td>
              <a href="/user/user_profile.php?id=<?= $user->id ?>">
                <?= $user->email ?>
              </a>
            </td>
            <td><?= $user->name ?></td>
            <td><?= $user->last_name ?></td>
            <td><?= $user->birthday ?></td>
            <td><?= $user->phone ?></td>
            <td>
              <? if ($user->is_premium): ?>
                <span class="glyphicon glyphicon-star" style="color:goldenrod" title="Usuario premium" aria-hidden="true"></span>
              <? endif ?>
            </td>
            <td>
              <? if ($user->enabled): ?>
                <a href="/user/user_habilitation.php?action=disable&amp;id=<?= $user->id ?>">
                  Deshabilitar
                </a>
              <? else: ?>
                <a href="/user/user_habilitation.php?action=enable&amp;id=<?= $user->id ?>">
                  Habilitar
                </a>
              <? endif ?>
            </td>
          </tr>
        <? endif ?>
      <? endforeach ?>
    </tbody>
  </table>
</div>

<div>
  <h2>Administradores del sitio</h2>
  <a href="/user/user_new.php">
    Dar de alta usuario administrador
  </a>
  <table class="table">
    <thead>
      <tr>
        <th>Email</th>
        <th>Habilitaci&oacute;n</th>
      </tr>
    </thead>
    <tbody>
      <? foreach ($user_list as $user): ?>
        <? if ($user->is_admin): ?>
          <tr>
            <td><?= $user->email ?></td>
            <td>
              <? if ($user->enabled): ?>
                <a href="/user/user_habilitation.php?action=disable&amp;id=<?= $user->id ?>"  onclick="return confirm('¿Está seguro que desea deshabilitar su usuario? Recuerde que esta accion es permanente y no puede revertirse. En caso afirmativo, se cerrará la sesión.')">
                  Deshabilitar
                </a>
              <? else: ?>

                <a href="/user/user_habilitation.php?action=enable&amp;id=<?= $user->id ?>">
                  Habilitar
                </a>
              <? endif ?>
            </td>
          </tr>
        <? endif ?>
      <? endforeach ?>
    </tbody>
  </table>
</div>

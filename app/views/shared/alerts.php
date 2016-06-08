<? if (isset($alert_variables) && $alert_variables) : ?>

  <div class="alert alert-<?= $alert_variables['alert'] ?>" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <?= $alert_variables['message'] ?>
  </div>

<? endif ?>

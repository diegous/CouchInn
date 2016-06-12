<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Inicio</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/search/search_form.php">B&uacute;squeda</a></li>
      </ul>

      <? if(isset($_SESSION['user'])): ?>
        <ul class="nav navbar-nav">
          <? if($_SESSION['user']->is_admin): ?>
            <li><a href="/couch_type/couch_type_list.php">Ver tipos de couch</a></li>
            <li><a href="/payment/payment_between_dates.php">Ver ganancias</a></li>
          <? else: ?>
            <li><a href="#">Mis Couchs</a></li>
          <? endif ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/session/session_close.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
      <? else: ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" data-toggle="modal" data-target="#login-modal">Iniciar Sesi&oacute;n</a></li>
          <li><a href="/user/user_new.php" >Registrarse</a></li>
        </ul>
      <? endif ?>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<h1>Modificar datos de usuario</h1>
<table class="table">
  <thead>
    <tr>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <form action="user_edit.php" method="post">
      <tr>
        <div class="form-group">
          <label for="email">Email</label><br>
          <input id="email" class="form-control" type="email" 
                 name="email" value="<?= $user->email; ?>">
        </div>   
      </tr>
      <tr>
        <div class="form-group">
          <label for="password">Contrase&ntilde;a</label><br>
          <input id="password" class="form-control" type="password" 
                 name="password" value="<?= $user->password; ?>">
        </div> 
      </tr>
      <tr>
        <div class="form-group">
          <label for="name">Nombre</label><br>
          <input id="name" class="form-control" type="name" 
                 name="name" value="<?= $user->name; ?>">
        </div>
      </tr>
      <tr>  
        <div class="form-group">
          <label for="last_name">Apellido</label><br>
          <input id="last_name" class="form-control" type="last_name" 
                 name="last_name" value="<?= $user->last_name; ?>">
        </div> 
      </tr>
      <tr> 
        <div class="form-group">
          <label for="bithday">Fecha de nacimiento</label><br>
          <input id="bithday" class="form-control" type="date" 
                 name="bithday" value="<?= $user->bithday; ?>">
        </div>  
      </tr>
      <tr>
        <div class="form-group">
          <label for="phone">Tel&eacute;fono</label><br>
          <input id="phone" class="form-control" type="text" 
                 name="phone" value="<?= $user->phone; ?>">
        </div>   
      </tr>
      <button type="submit" class="btn btn-default">Guardar</button>
    </form>
  </tbody>
</table>


<!-- //couchinn/app/views --> 






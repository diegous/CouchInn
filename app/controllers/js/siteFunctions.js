function checkLogin($form) {
  $.post("session_create.php",
    {
      email: $form.email.value,
      password: $form.password.value,
    },
    function(data,status){
      if (data) {
        location.reload();
      } else {
        alert("Combinación usuario/contraseña incorrecto");
      }
    }
  );
  return false;
}

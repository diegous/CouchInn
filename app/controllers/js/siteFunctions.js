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

function checkEmail($form) {
  $.post("recuperar_pass_validar_prueba.php",
    {
      email: $form.email.value,
      //password: $form.password.value,
    },
    function(data,status){
      if (data) {
        alert("OK");
        location.reload();
      } else {
        alert("No existe el usaurio");
      }
    }
  );
  return false;
}

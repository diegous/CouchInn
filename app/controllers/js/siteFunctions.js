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


//version sincronica de $.post().Espera a que se termine la consulta al servidor antes de retornar.
function ajaxSync(direccion,datos,success,onerror){
  var datos={
    url:direccion,
    data:datos,
    async:false,
    type:"POST"
  };
  if(typeof success!=="undefined"){
    datos["success"]=success;
  }
  if(typeof onerror!=="undefined"){
    datos["onerror"]=onerror;
  }else{
    datos["onerror"]=alert;
  }
  $.ajax(datos);
}


function redirectToAlertPageView(title,message,url){
  var form = $('<form action="alert_page.php" method="post">' +
    '<input type="text" name="title" value="' + title + '" />' +
    '<input type="text" name="url" value="' + url + '" />' +
    '<input type="text" name="message" value="' + message + '" />' +
    '</form>');
  $('body').append(form);
  form.submit();
}

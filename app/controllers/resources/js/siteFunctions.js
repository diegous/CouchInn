function checkLogin($form) {
  $.post("/session/session_create.php",
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

function checkEmail($form) {
  $.post("/session/recuperar_pass_validar_prueba.php",
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

//crea un form que redirecciona a <url>
//formato de contents= [ [<name>,<value>]* ]
function hiddenInputsFormGenerator(url,contents){
  var acum='<form method="post" action="'+url+'">\n';
  for (var i = 0; i < contents.length; i++) {
    var input=contents[i];
    acum+= '<input hidden="true" type="text" name="'+input[0]+'" value="'+input[1]+'" >\n' ;
  }
  acum+=" </form>";
  return $(acum);
}

//redirecciona a <url>
//formato de contents= [ [<name>,<value>]* ]
function redirectWithPost(url,contents){
  var form= hiddenInputsFormGenerator(url,contents) ;
  $('body').append(form);
  form.submit();
}

function redirectToAlertPageView(title,message,url){
  redirectWithPost("shared/alert_page.php",[["title",title],["url",url],["message",message]]);
}



function checkLogin($form) {
  var constantes={
    noExiste:0,
    deshabilitado:1,
    habilitado:2
  };
  $.post("/session/session_create.php",
    {
      email: $form.email.value,
      password: $form.password.value,
    },
    function(data,status){
      console.log(data);
      if (data==constantes.habilitado) {
        location.reload();
      } else {
        if(data==constantes.deshabilitado){
          $("#disabled-login-label").removeClass("hidden");
        }else if(data==constantes.noExiste){
          $("#incorrect-login-label").removeClass("hidden");
        }else{
          //imposible
          alertMessage.show(data);
        }

        var dismiss=function(){
          $("#login-dialog").removeClass("bad-input");
          $(".login-label").addClass("hidden");
        }
        $(".login-input").on("focus click",dismiss);
        $('div#login-modal').on('hide.bs.modal ', dismiss);

        // alert("Combinación usuario/contraseña incorrecto");
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
        redirectWithAlert("info","Chequeo De Email:El Email Existe.",""+window.location);
      } else {
        alertMessage.show("No existe el usuario","danger");
      }
    }
  );
  return false;
}


//version sincronica de $.post().Espera a que se termine la consulta al servidor antes de retornar.
function ajaxSync(direccion,datosPost,success,onerror){
  var datosAjax={
    url:direccion,
    data:datosPost,
    async:false,
    type:"POST"
  };
  if(typeof success!=="undefined"){
    datosAjax["success"]=success;
  }
  if(typeof onerror!=="undefined"){
    datosAjax["error"]=onerror;
  }else{
    datosAjax["error"]=alert;
  }
  $.ajax(datosAjax);
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
  window.location=("/shared/alert_page.php"
      +"?title="+encodeURIComponent(title)
      +"&url="+encodeURIComponent(url)
      +"&message="+encodeURIComponent(message)
    );
}


function redirectWithAlert(alert,message,url){
  window.location=("/shared/redirect_with_alert.php"
      +"?alert="+encodeURIComponent(alert)
      +"&url="+encodeURIComponent(url)
      +"&message="+encodeURIComponent(message)
    );
}


function parseJson(js_object){
    if(js_object==""){
        alertMessage.show("not valid json(empty string)","danger");
    }
    try{
        return JSON.parse(js_object);
    }catch(e){
        alertMessage.show("not valid json:\n"+js_object,"danger");
        throw e;
    }
}

function returnToPreviousPage(){
  window.history.back();
}

function checkValidDates(form) {
  start_date = new Date(form.start_date.value);
  end_date = new Date(form.end_date.value);
  today = new Date();
  today.setUTCHours(0,0,0,0);

  if (today <= start_date) {
    if (start_date < end_date) {;
      return true;
    } else {
      alertMessage.show("La fecha de inicio debe ser anterior a la fecha de finalización","danger");
      return false;
    }
  } else {
    alertMessage.show("La fecha de inicio debe ser a partir de hoy ","danger");
    return false;
  }
}

function enable_dates(checked) {
  $("#start_date").attr("disabled", !checked);
  $("#end_date").attr("disabled", !checked);
}

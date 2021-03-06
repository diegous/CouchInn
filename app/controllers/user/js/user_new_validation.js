

$(document).ready(function(){
  var alertIdentity=function(mensaje){
    return mensaje;
  }

  var validation=function(e){
    e.preventDefault();
    var errorTable;
    var huboErrores=false;
    //serializo el formulario para enviarlo por post
    var formulario=$(".panel-body").serialize();
    ajaxSync("user_create.php",formulario,
      function(message){errorTable=message;});
    if(errorTable==="success"){
      //vuelvo a la pagina principal
      redirectWithAlert("success","Usuario creado exitosamente","/index.php");
    }else{
      //convierto la salida de php a un objecto de javascript
      errorTable=JSON.parse(errorTable);
      var err_email=errorTable["error_email"]
      if(err_email){
        alertMessage.show("Email ya existe","danger");
        huboErrores=true;
      }else{
          $("#label-error-email").hide();
      }
    }
  }

  $(".panel-body").on("submit",validation);
  $(".btn btn-default").on("click ",validation);

})



$(document).ready(function(){
  var alertIdentity=function(mensaje){
    alert(mensaje);
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
    //convierto la salida de php a un objecto de javascript
    errorTable=JSON.parse(errorTable);
    var err_email=errorTable["error_email"]
    if(err_email){
      $("#label-error-email")
        .show()
        .html(alertIdentity(
              err_email==="empty"?"email vacio"
              :err_email==="user exists"?"email ya existe"
              :"error desconocido:"+err_email
        ));
        huboErrores=true;
    }else{
        $("#label-error-email").hide();
    }
    if(!huboErrores){
      alert("usuario creado exitosamente");
      //vuelvo al indice
      window.location="/index.php";
    }
  }

  $(".panel-body").on("submit",validation);
  $(".btn btn-default").on("click ",validation);

})

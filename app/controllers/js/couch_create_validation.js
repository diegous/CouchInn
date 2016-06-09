function couch_create_validation(){

  var onSubmit=function(e){
    e.preventDefault();
    var errorResult;
    //serializo el formulario para enviarlo por post
    var formulario=$("#form-couch-create").serialize();
    var success=function(message){errorResult=message;};
    ajaxSync("couch_create_validation.php",formulario,success);
    var resultTable=parseJson(errorResult);
    if(resultTable["error"]===false){
      redirectToAlertPageView("Creacion de couch","El couch fue creado exitosamente","/");
    }else{
      alert("error:\n"+resultTable["errorMessage"]);
    }
  }

  $("#form-couch-create").on("submit",onSubmit);
  $("#button-submit-couch").on("click",onSubmit);

}

$(document).ready(couch_create_validation);

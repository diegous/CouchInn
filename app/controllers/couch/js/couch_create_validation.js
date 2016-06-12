var CouchCreateGlobals={
  tamanioMaximoPost:null, //lo seteo en couch_create_view.php
  sizeOfMB:(Math.pow(2,20)),
  conexion:null  //es el objeto de conexion con el servidor 
}

//retorna si hay un error
function updateWarningLabels(){
  var activadaAlerta=false;
  var updateRetVal=function(valor){
    activadaAlerta=activadaAlerta|| ! valor;
    return valor;
  };
  $(".file-popup").each(function(){
    var label=$(this).siblings(".image-labels").find(".image-label-big")
    var doesShowLabel;
    if(this.files.length>0){
      var fileSize=this.files[0].size
      doesShowLabel=(fileSize>=CouchCreateGlobals.tamanioMaximoPost)
      label.children(".image-filesize").html((fileSize/(CouchCreateGlobals.sizeOfMB)).toFixed(2));
    }else{
      doesShowLabel=false;
    }
    
    label.toggleClass("hidden",updateRetVal(!doesShowLabel));
  });

  //serializo el formulario para enviarlo por post
  var tamanioformulario=$("#form-couch-create").serialize().length;
  var sumaDeTamanios=0;
  $(".file-popup").each(function(){
    if(this.files.length>0)
      sumaDeTamanios+=this.files[0].size;
  })
  sumaDeTamanios+=tamanioformulario;
  var doShowTooBigLabel=(sumaDeTamanios >= CouchCreateGlobals.tamanioMaximoPost);
  $(".image-label-big-all").toggleClass("hidden",updateRetVal(!doShowTooBigLabel))
                           .children(".image-filesize")
                           .html((sumaDeTamanios/(CouchCreateGlobals.sizeOfMB)).toFixed(2));

  return activadaAlerta;
}
 

function CouchCreateValidation(){
  var onSubmit=function(e){
    e.preventDefault();
    var errorResult;

    if(CouchCreateGlobals.conexion)
        CouchCreateGlobals.conexion.abort()

    if(updateWarningLabels())
      return ;

    var cancelButton=$(".button-cancel-upload");

    var fileTransferContainer=$(".file-transfer-progress");
    var fileTransferBar=fileTransferContainer.find(".progress-bar");
    var fileTransferText=fileTransferBar.find("span");

    var updateTransferProgress=function(percentComplete){
      var percentVal = percentComplete+'%';
      fileTransferBar.width(percentVal);
      fileTransferBar.css("width",percentComplete);
      fileTransferBar.attr("aria-valuenow",percentComplete);
      fileTransferText.html(percentVal);
    }
    var before=function(){
      fileTransferContainer.removeClass("hidden");

      updateTransferProgress(0);
      cancelButton.removeClass("hidden")
    };

    var during=function(event, position, total, percentComplete) {
      updateTransferProgress(percentComplete);
    };

    var after=function(){
      updateTransferProgress(100);
      fileTransferContainer.addClass("hidden");
      cancelButton.addClass("hidden")
    };

    var onCancelUploadClick=function(){
      CouchCreateGlobals.conexion.abort();
      CouchCreateGlobals.conexion=null;
      cancelButton.off("click");
    }

    var continuation=function(message){

      var errorResult=message;
      console.log(errorResult);
      var resultTable=parseJson(errorResult);
      if(resultTable["error"]===false){
        redirectToAlertPageView("Creacion de couch","El couch fue creado exitosamente","/");
      }else if(resultTable["error"]==="non image"){
        resultTable.which.forEach(function(name){
          $(".div-"+name).find(".image-label-non").removeClass("hidden");
        });
      }else{
        alert("error:\n"+resultTable["errorMessage"]);
      }
    };
    var options = { 
      //target:        '#form-couch-create',   // target element(s) to be updated with server response 
      beforeSubmit:  before,
      uploadProgress:during,
      success:       continuation,
      complete:      after,

      // other available options: 
      url:"couch_create_validation.php",// override for form's 'action' attribute 
      type:"POST"        // 'get' or 'post', override for form's 'method' attribute 
      //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
      //clearForm: true        // clear all form fields after successful submit 
      //resetForm: true        // reset the form after successful submit 

      // $.ajax options can be used here too, for example: 
      //timeout:   3000 
    }; 
    CouchCreateGlobals.conexion=$("#form-couch-create").ajaxSubmit(options).data("jqxhr"); 
    cancelButton.on("click",onCancelUploadClick)
  }




  $("#form-couch-create").on("submit",onSubmit);

  // new CouchImagePanel();
};



function CouchImageListValidation(){
  clearInputFile= function(){
    var e=$(this);
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }

  //me aseguro de que no haya archivos seleccionados al recargar la pagina.
  $(".file-popup").each(clearInputFile);

  var imageFileSelectHandler=function() {
    console.log("inside:");
    var that=this;
    var file= this.files[0];
    //chequeo que es una imagen
    // if (file.type.match('image.*')) {
    if (true) {
      var reader = new FileReader();
      reader.onload = (function() {
        return function(e) {
          var imageData=e.target.result;
          $(that).siblings("img")
                 .toggleClass("couch-image-hidden couch-image-shown")
                 .attr("src",imageData)
          $(that).siblings(".button-delete-image")
                 .show()
          $(that).siblings(".button-choose-file")
                 .hide();
          updateWarningLabels();
        };
      })();
      // creo una url con la imagen embedida en ella
      reader.readAsDataURL(file);
    }
  };


  var onDeleteClick=function(){
    var button=$(this);
    var image=button.siblings("img");
    image.toggleClass("couch-image-hidden couch-image-shown")
         .removeAttr("src")
           ;
    button.hide();
    button.siblings(".button-choose-file")
          .show();
    button.siblings(".file-popup").each(clearInputFile);
    updateWarningLabels();
  }

  var onClickChooseFile=function(e){
    $(this).siblings(".file-popup")
           .trigger("click");
  }

  $(".button-choose-file").on("click",onClickChooseFile);
  $(".button-delete-image").on("click",onDeleteClick);
  $(".file-popup").on("change",imageFileSelectHandler );
}





$(document).ready(CouchCreateValidation);
$(document).ready(CouchImageListValidation);

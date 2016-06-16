var CouchCreateGlobals={
  tamanioMaximoPost:null, //lo seteo en couch_create_view.php
  sizeOfMB:(Math.pow(2,20)),
  conexion:null,  //es el objeto de conexion con el servidor 
  printableFileSize:function(sizeInBytes){
    return ""+(sizeInBytes/(CouchCreateGlobals.sizeOfMB)).toFixed(2)
  }
}

//comprueba y muestra alertas;retorna true si hay una alerta sino false
function updateWarningLabels(){
  var activadaAlerta=false;
  var updateRetVal=function(valor){
    activadaAlerta=activadaAlerta|| ! valor;
    return valor;
  };

  ////////////////////////////////////////////////////////////////////////
  //Compruebo que el tamaño de cada archibo no pase el tamaño admitido por POST
  $(".file-popup").each(function(){
    var label=$(this).siblings(".image-labels").find(".image-label-big")
    var doesShowLabel;
    if(this.files.length>0){
      var fileSize=this.files[0].size
      doesShowLabel=(fileSize>=CouchCreateGlobals.tamanioMaximoPost)
      label.children(".image-filesize").html(CouchCreateGlobals.printableFileSize(fileSize));
    }else{
      doesShowLabel=false;
    }
    
    label.toggleClass("hidden",updateRetVal(!doesShowLabel));
  });

  ////////////////////////////////////////////////////////////////////////
  //Compruebo que la suma del tamaño de todos los archivos no pase del tamaño admitido por POST
  var tamanioformulario=$("#form-couch-create").serialize().length;
  var sumaDeTamanios=0;
  $(".file-popup").each(function(){
    if(this.files.length>0)
      sumaDeTamanios+=this.files[0].size;
  })
  sumaDeTamanios+=tamanioformulario;
  var doShowTooBigLabel=(sumaDeTamanios >= CouchCreateGlobals.tamanioMaximoPost);
  $(".image-label-big-all").toggleClass("hidden",updateRetVal(!doShowTooBigLabel))
                           .find(".image-filesize")
                           .html(""+(sumaDeTamanios/(CouchCreateGlobals.sizeOfMB)).toFixed(2));

  ////////////////////////////////////////////////////////////////////////
  //Compruebo que cada archivo sea una imagen 
  $(".file-popup").each(function(){
    var isAnImage=(this.files.length===0 || (this.files[0]["type"].indexOf("image")===0))

    updateRetVal(isAnImage);
    $(this).siblings(".image-labels")
            .children(".image-label-non")
            .toggleClass("hidden",isAnImage);
  
  });

  return activadaAlerta;
}
 
//realiza el proceso de subida de archivos 
function CouchCreateValidation(){

  var onSubmit=function(e){
    e.preventDefault();
    var errorResult;
    
    var terminarConexion=function(){
      CouchCreateGlobals.conexion.abort();
      CouchCreateGlobals.conexion=null; //libero la conexion
    }

    //si la conexion todavia existe la termino
    if(CouchCreateGlobals.conexion){
      terminarConexion();
    }

    if(updateWarningLabels())
      return ;

    var cancelButton=$(".button-cancel-upload");

    var fileTransferContainer=$(".file-transfer-progress");
    var fileTransferBar=fileTransferContainer.find(".progress-bar");
    var fileTransferText=fileTransferBar.find("span");
    var camposDeEntrada=
      $('.button-delete-image,.button-choose-file,.button-save-couch,input[type="text"],#select-type');

    var updateTransferProgress=function(percentComplete){
      var percentVal = percentComplete+'%';
      fileTransferBar.width(percentVal);
      fileTransferBar.css("width",percentVal);
      fileTransferBar.attr("aria-valuenow",percentComplete);
      fileTransferText.html(percentVal);
    }
    var before=function(){
      fileTransferContainer.removeClass("hidden");

      updateTransferProgress(0);
      cancelButton.removeClass("hidden");
      camposDeEntrada.attr("disabled",true);
    };

    var during=function(event, position, total, percentComplete) {
      updateTransferProgress(percentComplete);
    };

    var after=function(){
      updateTransferProgress(100);
      fileTransferContainer.addClass("hidden");
      cancelButton.addClass("hidden");
      camposDeEntrada.removeAttr("disabled");
    };


    var continuation=function(message){
      after();

      var errorResult=message;
      console.log(errorResult);
      var resultTable=parseJson(errorResult);
      if(resultTable["error"]===false){
        redirectToAlertPageView("Creacion de couch","El couch fue creado exitosamente","/");
      }else{
        alert("error:\n"+resultTable["errorMessage"]);
      }
    };
    var options = { 
      beforeSubmit:  before,
      uploadProgress:during,
      success:       continuation,

      url:"couch_create_validation.php",
      type:"POST"
    }; 
    CouchCreateGlobals.conexion=$("#form-couch-create").ajaxSubmit(options).data("jqxhr"); 
    cancelButton.one("click",function(){
      terminarConexion();
      after();
    });
  }




  $("#form-couch-create").on("submit",onSubmit);
};


//configura los eventos de campos de imagen
function CouchImageListValidation(){
  //limpio el campo de archivo
  var clearInputFile= function(){
    var e=$(this);
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }

  //me aseguro de que no haya archivos seleccionados al recargar la pagina.
  $(".file-popup").each(clearInputFile);

  //que hace al seleccionar un archivo
  var imageFileSelectHandler=function() {
    var that=this;
    var file= this.files[0];
  
    if (true) {
      var reader = new FileReader();
      reader.onload = (function() {
        return function(e) {
          var imageData=e.target.result;
          $(that).siblings("img")
                 .toggleClass("couch-image-hidden couch-image-shown")
                 .attr("src",imageData)
          $(that).siblings(".button-delete-image")
                 .val(function(i,val){
                   return (val.split('(')[0])+"("+CouchCreateGlobals.printableFileSize(file.size)+"MB)"
                 })
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


  //que hace al hacer click en borrar imagen
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

  //que hace al hacer click en el boton de eleccionar imagen
  //usa un selector de archivos oculto
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

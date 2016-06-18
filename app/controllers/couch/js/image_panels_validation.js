var ImagePanelGlobals={
  tamanioMaximoPost:null, //lo seteo en couch_create_view.php
  sizeOfMB:(Math.pow(2,20)),
  maximoCntImg:1000,
  conexion:null,  //es el objeto de conexion con el servidor 
  imageOps:{
    upload:"upload",
    delete:"delete"
  },
  newImagePosition:0,
  printableFileSize:function(sizeInBytes){
    return ""+(sizeInBytes/(this.sizeOfMB)).toFixed(2)
  },
  
  redirectTitle:"",
  messageOnRedirect:"",
  redirectToUrl:"",
  
}



//comprueba y muestra alertas;retorna true si hay una alerta sino false
ImagePanelGlobals.updateWarningLabels=function(){
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
      doesShowLabel=(fileSize>=ImagePanelGlobals.tamanioMaximoPost)
      label.children(".image-filesize").html(ImagePanelGlobals.printableFileSize(fileSize));
    }else{
      doesShowLabel=false;
    }
    
    label.toggleClass("hidden",!doesShowLabel);
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
  var doShowTooBigLabel=(sumaDeTamanios >= ImagePanelGlobals.tamanioMaximoPost);
  $(".image-label-big-all").toggleClass("hidden",updateRetVal(!doShowTooBigLabel))
                           .find(".image-filesize")
                           .html(""+(sumaDeTamanios/(ImagePanelGlobals.sizeOfMB)).toFixed(2));

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
ImagePanelGlobals.CouchUploadValidation=function(){

  var onSubmit=function(e){
    e.preventDefault();
    console.log("onSubmit");
    var errorResult;
    
    var terminarConexion=function(){
      ImagePanelGlobals.conexion.abort();
      ImagePanelGlobals.conexion=null; //libero la conexion
    }

    //si la conexion todavia existe la termino
    if(ImagePanelGlobals.conexion){
      terminarConexion();
    }

    if(ImagePanelGlobals.updateWarningLabels()){
      $("#image-label-big-all")[0].scrollIntoView( true );
      return ;
    }
    var cancelButton=$(".button-cancel-upload");

    var fileTransferContainer=$(".file-transfer-progress");
    var fileTransferBar=fileTransferContainer.find(".progress-bar");
    var fileTransferText=fileTransferBar.find("span");
    var camposDeEntrada=
      $( '.button-delete-image,.button-choose-file,#button-submit-couch,input[type="text"]' );

    var updateTransferProgress=function(percentComplete){
      var percentVal = percentComplete+"%";
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
        var redirectToUrl=ImagePanelGlobals.redirectToUrl;
        if(resultTable["couchId"]){
          redirectToUrl='/couch/couch.php?id='+resultTable["couchId"];
        }
        redirectToAlertPageView(
          ImagePanelGlobals.redirectTitle,
          ImagePanelGlobals.messageOnRedirect,
          redirectToUrl
          // "Creacion de couch",
          // "El couch fue creado exitosamente",
          // "/"
        );
      }else{
        alertMessage.show(resultTable["errorMessage"],"danger");
      }
    };
    var options = { 
      beforeSubmit:  before,
      uploadProgress:during,
      success:       continuation,

      url:$("#form-couch").attr("action"),
      type:"POST"
    }; 
    ImagePanelGlobals.conexion=$("#form-couch").ajaxSubmit(options).data("jqxhr"); 
    cancelButton.one("click",function(){
      terminarConexion();
      after();
    });
  }


  ////////////////////////////////////////////////////////////////////////
  //Compruebo la cantidad de imagenes
  
  var imagePanelsAmount=
    $(".panel-couch-image").length - $(".panel-couch-image.hidden").length;
  if(imagePanelsAmount < ImagePanelGlobals.maximoCntImg){
    alertMessage.hide();

  }


  $("#form-couch").on("submit",onSubmit);
};


//configura los eventos de campos de imagen
ImagePanelGlobals.CouchImageListValidation=function (){
  //limpio el campo de archivo
  var clearInputFile= function(){
    var e=$(this);
    e.val("");
    e.wrap("<form>").closest("form").get(0).reset();
    e.unwrap();
  }

  //me aseguro de que no haya archivos seleccionados al recargar la pagina.
  $(".file-popup").each(clearInputFile);

  //que hace al seleccionar un archivo
  var imageFileSelectHandler=function() {
    var that=$(this);
    var file= this.files[0];
  
    if (true) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var imageData=e.target.result;
        that.siblings("img")
            .removeClass("couch-image-hidden")
            .addClass("couch-image-shown")
            .attr("src",imageData)
        that.siblings(".button-delete-image")
            .val(function(i,val){
              return (val.split(".")[0])+"."+ImagePanelGlobals.printableFileSize(file.size)+"MB."
            })
            .removeClass("hidden")
        that.siblings(".button-choose-file")
            .addClass("hidden");
        that.siblings(".input-action")
            .val(ImagePanelGlobals.imageOps.upload);
        that.closest(".panel-couch-image").removeClass("hidden");
        ImagePanelGlobals.updateWarningLabels();
      };
      
      // creo una url con la imagen embedida en ella
      reader.readAsDataURL(file);
    }
  };


  //que hace al hacer click en borrar imagen
  var onDeleteClick=function(){
    var button=$(this);
    var image=button.siblings("img");
    image.toggleClass("couch-image-hidden couch-image-shown")
         .removeAttr("src");
    button.siblings(".button-choose-file")
          .show();
    button.siblings(".file-popup")
          .each(clearInputFile);
    button.siblings(".input-action")
          .val(ImagePanelGlobals.imageOps.delete);
    button.closest(".panel-couch-image").addClass("hidden");
    ImagePanelGlobals.updateWarningLabels();
  };


  //que hace al hacer click en el boton de eleccionar imagen
  //usa un selector de archivos oculto
  var onClickChooseFile=function(e){
    $(this).siblings(".file-popup")
           .trigger("click");
  };

  
  var onClickAddImage=function(e){
    e.preventDefault();
    ImagePanelGlobals.addImagePanel(undefined,true);
  };

  ImagePanelGlobals.associateCallbacks=function(){
    $(".button-choose-file").on("click",onClickChooseFile);
    $(".button-delete-image").on("click",onDeleteClick);
    $(".file-popup").on("change",imageFileSelectHandler );
  }
  $("#button-add-image").on("click",onClickAddImage)
  ImagePanelGlobals.associateCallbacks();

}



$(document).ready(ImagePanelGlobals.CouchUploadValidation);
$(document).ready(ImagePanelGlobals.CouchImageListValidation);



ImagePanelGlobals.addImagePanel=(function(){
  var triggerClick=function(i,elem){ $(this).trigger("click"); };

  return function(src,openFileSelect,forceNew){
    if(typeof src==="undefined"){
      src="";
    }
    var allImagePanels=$(".panel-couch-image");
    var hiddenImagePanels=allImagePanels.filter(".hidden");
    if(allImagePanels.length >= this.maximoCntImg && hiddenImagePanels.length===0) {

      alertMessage.show("Alcanzo la maxima cantidad de imagenes","danger");

    }else{
      var created;
      if(forceNew || hiddenImagePanels.length===0){
        var num=allImagePanels.length+1;
        created=this.createImagePanelNode(num,src);
        $("#couch-images").append(created);
        this.associateCallbacks();
      }else{
        if(src){
          var tmp=hiddenImagePanels.first()
          created=tmp.replaceWith(this.createImagePanelNode(tmp.index()+1,src));
        }else{
          created=hiddenImagePanels.first();
        }
      }
      if(openFileSelect){
        created.find(".file-popup")
               .each(triggerClick);
      }
      this.associateCallbacks();
    }
  }
})();




ImagePanelGlobals.createImagePanelNode=(function(){

  var numberRegex=new RegExp("#i#",'g');
  return function(num,src,action){
    action=action||this.imageOps.upload;
    var hidden= (src?"":" hidden");
    var hiddenImage= (src?" couch-image-shown":" couch-image-hidden");
    var hiddenChoose= (src?" hidden ":"");
    var hiddenDelete= (src?"":" hidden ");
    // console.log("hiddenChoose:'"+hiddenChoose+"'");

    var nodeSource=(
      '<div class="panel-couch-image div-file#i#'+hidden+' form-group">'+
        '<input type="hidden" class="input-action" name="action-#i#"'+
              ' id="action-#i#" value="'+action+'" form="form-couch"/>'+
        '<input type="file" name="file#i#" id="file#i#" form="form-couch" '+
                'class="file-popup" style="display: none;" />'+
        '<input type="button" class="button-choose-file btn btn-default btn-block'+hiddenChoose+'"'+
               'value="Seleccione la imagen #i#(opcional)" />'+
        '<input type="button" class="button-delete-image btn btn-default btn-block'+hiddenDelete+'"'+
               'value="Borre la imagen #i# ."/>'+
        '<div class="image-labels">'+
          '<div id="image-label-non-file#i#"'+
                'class="image-label image-label-non label alert alert-danger hidden ">'+
            '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'+
            'no es una imagen'+
          '</div>'+
          '<div id="image-label-big-file#i#"'+
                'class="image-label image-label-big alert alert-danger hidden">'+
            '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'+
            'Imagen demasiado grande(ocupa <span class="image-filesize" aria-hidden="true"></span>MB)<br>'+
            '(tamaño maximo='+this.printableFileSize(this.tamanioMaximoPost)+'MB)'+
          '</div>'+
        '</div>'+
        '<img class="couch-img '+hiddenImage+'" src="'+src+'"/>'+
      '</div>'
    );
    nodeSource=nodeSource.replace(numberRegex,num);
    return $(nodeSource);

  }
})();

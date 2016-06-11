
function CouchCreateValidation(){
  var onSubmit=function(e){
    e.preventDefault();
    var errorResult;
    //serializo el formulario para enviarlo por post
    var formulario=$("#form-couch-create").serialize();
    // alert(formulario);
    $("#form-image-list").submit();

    continuation=function(message){
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
      // beforeSubmit:  showRequest,  // pre-submit callback 
      success:       continuation,  // post-submit callback 

      // other available options: 
      url:"couch_create_validation.php",// override for form's 'action' attribute 
      type:"POST"        // 'get' or 'post', override for form's 'method' attribute 
      //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
      //clearForm: true        // clear all form fields after successful submit 
      //resetForm: true        // reset the form after successful submit 

      // $.ajax options can be used here too, for example: 
      //timeout:   3000 
    }; 
    $("#form-couch-create").ajaxSubmit(options); 
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
        };
      })();
      // creo una url con la imagen embedida en ella
      reader.readAsDataURL(file);
    }
  };


  var onDeleteClick=function(){
    var button=this;
    var image=$(button).siblings("img");
    image.toggleClass("couch-image-hidden couch-image-shown")
           .removeAttr("src")
           ;
    $(button).siblings(".image-labels").children(".image-label").addClass("hidden");
           
    $(button).hide();
    $(button).siblings(".button-choose-file")
             .show();
    $(button).siblings(".file-popup").each(clearInputFile);
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

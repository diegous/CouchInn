<?
  $alert_variables=check_for_alert();
  if($alert_variables){
    $alert_class="alert-".$alert_variables['alert'];
   }else{
    $alert_class="hidden";
    $alert_variables['message']="";
   }
?>


<div id="alert-message" class="alert <?=$alert_class?>" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span id="alert-message-text"><?= $alert_variables['message'] ?><span>
</div>

<script>

//alertMessage.show()                  |muestra el ultimo mensaje con la misma clase
//alertMessage.show(message)           |muestra un nuevo mensaje con la misma clase
//alertMessage.show(message,alertClass)|muestra un nuevo mensaje con una nueva clase
//alertMessage.show(null,alertClass)   |muestra el ultimo mensaje con una nueva clase
//alertMessage.hide()                  |oculta el mensaje
//<alertClass>::=("success"|"info"|"warning"|"danger")
var alertMessage=(function(){

  var validAlerts=["success","info","warning","danger"];
  var allAlertClasses=
    validAlerts.map(function(val){return "alert-"+val;})
               .join(" ");

  var isAlert=function(clase){ return $.inArray(clase,validAlerts) > -1 };
  var alertDiv=$("#alert-message")[0];
  return{
    show:function(message,alertClass){
      if($.type(message)==="string"){
        $("#alert-message-text").html(message);
      }
      this.changeClass(alertClass);
      alertDiv.scrollIntoView( true );
      $("#alert-message").removeClass("hidden");
    },
    hide:function(message){
      $("#alert-message").addClass("hidden");
    },
    changeClass:function(alertClass){
      if(isAlert(alertClass)){
        $("#alert-message").removeClass(allAlertClasses)
                           .addClass("alert-"+alertClass);
      }
    },
  };

})();

</script>

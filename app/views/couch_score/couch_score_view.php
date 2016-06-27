<style>
  .glyphicon-star{
    color:#EEEE00;
  }

  .score-star , .label-stars{
    font-size:24px;
  }
</style>

<hr>

<?php
  $max_stars=5;
  $stars=4;
?>

<form id="form-score">
  <!-- uso un hidden input para enviar la cantidad de estrellas -->
  <input type='hidden' class='input-star-selected' name='score' value='<?=$stars?>'/>

  <label class="label-stars" for="selected-stars">Puntuacion:</label>
  <span class="selected-stars">
    <? for( $id = 1 ; $id <= $max_stars; $id+=1 ):
       $star_type    =($stars>=$id?"glyphicon-star":"glyphicon-star-empty");
       $star_selected=($stars===$id ?"star-selected":"");
       $star_classes =($star_type." ".$star_selected);
    ?>
      <span class='score-star glyphicon <?=$star_classes?>' id='star-<=?$id?>'></span>
    <? endfor ?>

  </span>

  <div class="form-group">
    <label for="score-comment">Comentario de reserva:</label><br>
    <textarea rows="4" name="score-comment" class="form-control"></textarea>
  </div>
  <button type="submit" id="button-submit-score" class="btn btn-default">Guardar</button>
</form>



<script>

//defino el comportamiento de las estrellas
$(function(){
  console.log("loaded");
  var emptyStar="glyphicon-star-empty";
  var fullStar ="glyphicon-star";
  var hoverUpdate=function(self){
    self          .addClass(fullStar ).removeClass(emptyStar);
    self.nextAll().addClass(emptyStar).removeClass(fullStar );
    self.prevAll().addClass(fullStar ).removeClass(emptyStar);
  };
  $(".score-star").on({
    mouseenter:function(){
      hoverUpdate($(this));
    },
    mousedown:function(){
      var self=$(this);
      var starNumber=self.attr("id").split("-")[1];
      self.siblings(".score-star")
          .removeClass("star-selected");
      self.addClass("star-selected");
      hoverUpdate(self);
      $(".input-star-selected").val(starNumber);
    }
  });

  $(".star-selected").trigger("mousedown");

  $(".selected-stars").on("mouseleave",function(){
    var self=$(this).find(".star-selected").first();
    hoverUpdate(self);
  });
});

</script>

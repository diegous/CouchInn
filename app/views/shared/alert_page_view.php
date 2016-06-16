<script type="text/javascript">
 function redirect(){
    window.location="<?= $url ?>";
 }
</script>

<h3><?= $message ?> </h3>
<div class="panel panel-default">
  <form class="panel-body" action="javascript:redirect();">
    <button type="submit" class="btn btn-default">Aceptar</button>
  </form>
</div>

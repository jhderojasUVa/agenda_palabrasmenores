<!-- Inicio Contenido de la página de nuevo barrio-->
<!-- modelo -->
<script src="<?=base_url()?>/resources/js/comprobaciones.js"></script>
<!-- vista -->
<script src="<?=base_url()?>/resources/js/barrios.js"></script>
<!-- vista-modelo -->
<script>
  $(document).ready(function(){
    $("form").submit(function(event) {
        event.preventDefault();
        if (error == 0) {
            this.submit();
        }
    });       
    revisa_form('add_barrio'); 
  });
</script>    
<div class="container">
  <? // Si hay algun mensaje se lo ponemos al usuario aqui arriba
    // Segun el problema mostraremos y rellenaremos lo que haga falta
    // Puedes comentarlo si molesta
  ?>
  <div class="row">
    <? if ($actualizado == 1 && $error == ""){ ?>
    <!-- todo correcto -->
    <div class="col-md-12">
      <div class="alert alert-success">
        <h3>Perfecto!</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> El barrio <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if ($actualizado == 1 && $error != "") {?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong>definimos el problema</strong>. Pero la actividad se ha grabado.</p>
      </div>
    </div>
    <? } else if ($error != ""){ ?>
    <!-- Error!!! -->
    <div class="col-md-12">
      <div class="alert alert-danger">
        <h3>Problemas</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> Ha habido algun problema: <strong><? echo $error ?></strong>.</p>
      </div>
    </div>
    <? } ?>
  </div>
  <!-- comenzamos -->
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Nuevo Barrio</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
<!--??<form action="<?=base_url()?>/admin/barrios/add_barrio" method="POST" class="horizontal" id="add_barrio" onsubmit="javascript:revisa_form('add_barrio');">-->
      <form action="<?=base_url()?>/admin/barrios/add_barrio" method="POST" class="horizontal" id="add_barrio">
          <div class="row">
          <input type="hidden" value="1" name="add">
          <!-- cada par esta en un form-group -->
          <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del barrio" id="nombre">
            </div>
          </div>
          <!-- el enviar o modificar-->
          <button type="submit" class="btn btn-default">Añadir barrio</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página de nuevo barrio-->


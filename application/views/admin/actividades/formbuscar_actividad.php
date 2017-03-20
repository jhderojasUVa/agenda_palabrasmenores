<!-- Inicio Contenido de la página  con un formulario de buscar actividades-->
<div class="container">
  <? // Si hay algun mensaje se lo ponemos al usuario aqui arriba
    // Segun el problema mostraremos y rellenaremos lo que haga falta
    // Puedes comentarlo si molesta
  ?>
  <div class="row">
    <!-- Ver esto si vamos a controlarlo en principio $actualizado viene con 0-->
    <? if ($actualizado==1){ ?>
    <!-- todo correcto -->
    <div class="col-md-12">
      <div class="alert alert-success">
        <h3>Perfecto!</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> La actividad <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if($actualizado==1 && (isset($error))){?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong>definimos el problema</strong>. Pero la actividad se ha grabado.</p>
      </div>
    </div>
    <? } else if (isset($error)){?>    
    <!-- Error!!! -->
    <div class="col-md-12">
      <div class="alert alert-danger">
        <h3>Problemas</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> Ha habido algun problema: <strong>definimos el problema</strong>.</p>
      </div>
    </div>
    <? } ?>
  </div>
  <!-- comenzamos -->
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Buscar actividad</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
      <form action="<?=base_url()?>/admin/actividades/buscar_actividad" method="POST" class="horizontal">
        <div class="row">
          <input type="hidden" name="tipo_busqueda" value="2">            
          <!-- cada par esta en un form-group -->
          <div class="form-group">
            <label for="actividad" class="col-sm-2 control-label">Actividad</label>
            <div class="col-sm-10">
              <input type="text" name="actividad" class="form-control" placeholder="Nombre de la actividad" id="actividad">
            </div>
          </div>
          <!-- y a repetir el proceso -->
          <div class="form-group">
            <!-- el label que tiene lo que ocupa (2) -->
            <label for="campanya" class="col-sm-2 control-label">Campaña</label>
            <!-- el input que se mete en una celda -->
            <div class="col-sm-10">
                <input type="text" name="campanya" class="form-control" placeholder="Campaña de la actividad" id="campanya">
            </div>
          </div>
          <div class="form-group">
            <label for="organiza" class="col-sm-2 control-label">Organizador</label>
            <div class="col-sm-10">
              <input type="text" name="organiza" class="form-control" placeholder="Organizador del evento" id="organiza">
            </div>
          </div>
          <!-- formateamos las fechas -->
          <div class="form-group">
            <label for="fecha" class="col-sm-2 control-label">Fecha</label>
            <div class="col-sm-10">
              <input type="date" id="fecha" class="form-control" name="fecha" placeholder="2016-10-09">
            </div>
          </div>
          <!-- formateamos las horas -->
          <div class="form-group">
            <label for="hora" class="col-sm-2 control-label">Hora</label>
            <div class="col-sm-10">
              <input type="time" id="hora" class="form-control" name="hora" placeholder="22:30:00">
            </div>
          </div>
          <!-- el enviar o modificar-->
          <button type="submit" class="btn btn-default">Buscar actividad</button>
        </div>  
      </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página de formulario de buscar actividad -->

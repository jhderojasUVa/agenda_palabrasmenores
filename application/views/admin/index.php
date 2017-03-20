<!-- Inicio Contenido de la página para logearse-->
<div class="container" style="margin-bottom: 20px; padding-bottom: 20px;">
  <? // Si hay algun mensaje se lo ponemos al usuario aqui arriba
    // Segun el problema mostraremos y rellenaremos lo que haga falta
    // Puedes comentarlo si molesta
  ?>
  <div class="row">
    <!-- todo correcto
    <div class="col-md-12">
      <div class="alert alert-success">
        <h3>Perfecto!</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> La actividad <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>-->
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong>definimos el problema</strong>. Pero la actividad se ha grabado.</p>
      </div>
    </div>-->

    <? if (isset($error)){?>
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
      <h3 class="text-center titulo">Acceso del Usuario</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-3 col-md-5 col-md-offset-4">
        <form action="<?=base_url()?>/login" method="POST">
            <div class="row">
                <!-- cada par esta en un form-group -->
                <div class="form-group">
                    <!-- el label que tiene lo que ocupa (2) -->
                    <label for="usuario" class="col-sm-3 control-label">Usuario</label>
                    <!-- el input que se mete en una celda -->
                    <div class="col-sm-9">
                        <input type="text" name="usuario" class="form-control" placeholder="Usuario" id="usuario">
                    </div>
                </div>
                <!-- y a repetir el proceso -->
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña del usuario" id="password">
                    </div>
                </div>
                <!-- el enviar o modificar-->
                <center><button type="submit" class="btn btn-default" style="margin-top:20px;">Acceder</button></center>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página para logearse-->

<!-- Inicio Contenido de la página de nuevo usuario-->
<div class="container">
  <? // Si hay algun mensaje se lo ponemos al usuario aqui arriba
    // Segun el problema mostraremos y rellenaremos lo que haga falta
    // Puedes comentarlo si molesta
  ?>
  <div class="row">
    <? if ($actualizado==1 && $error[0] == ""){ ?>
    <!-- todo correcto -->
    <div class="col-md-12">
      <div class="alert alert-success">
        <h3>Perfecto!</h3>
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> El usuario <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if($actualizado==1 && $error[0] != ""){?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <? foreach ($error as $fila) { ?>        
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong><? echo $fila ?></strong>. Pero la actividad se ha grabado.</p>
        <? } ?> 
      </div>
    </div>
    <? } else if ($error[0] != ""){?>
    <!-- Error!!! -->
    <!-- Mostramos todos los errores posibles -->
    <div class="col-md-12">
        <div class="alert alert-danger">
            <h3>Problemas</h3>
            <? foreach ($error as $fila) { ?>
            <p><span class="glyphicon glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> Ha habido algun problema: <strong><? echo $fila ?></strong>.</p>
            <? } ?>              
        </div>
    </div>
    <? } ?>
  </div>
  <!-- comenzamos -->
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Nuevo usuario</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
      <form action="<?=base_url()?>/admin/usuarios/add_usuario" method="POST" class="horizontal">
        <div class="row">
          <input type="hidden" value="1" name="add">
          <!-- cada par esta en un form-group -->
          <div class="form-group">
            <!-- el label que tiene lo que ocupa (2) -->
            <label for="login" class="col-sm-2 control-label">Login</label>
            <!-- el input que se mete en una celda -->
            <div class="col-sm-10">
                <input type="text" name="login" class="form-control" placeholder="Login del usuario" id="login" value='<?= $this -> input -> POST("login")?>'>
            </div>
          </div>
          <!-- y a repetir el proceso -->
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" placeholder="Contraseña" id="password" value='<?= $this -> input -> POST("password")?>'>
            </div>
          </div>          
          <div class="form-group">
            <label for="rpassword" class="col-sm-2 control-label">Repetir</label>
            <div class="col-sm-10">
              <input type="password" name="rpassword" class="form-control" placeholder="Contraseña" id="rpassword" value='<?= $this -> input -> POST("rpassword")?>'>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre del usuario" id="nombre" value='<?= $this -> input -> POST("nombre")?>'>
            </div>
          </div>
          <div class="form-group">
            <label for="idacl" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <select name="idacl" id="idacl" class="form-control">
                  <? $tipo = array ("Deshabilitado", "Super Administrador", "Redactor", "Editor");?>
                  <? if ($this -> input -> POST("idacl") != "") {?>
                  <option value="<?= $this -> input -> POST("idacl")?>"><?=$tipo[$this -> input -> POST("idacl")]?></option>
                  <? } ?>
                  <? for ($i=sizeof($tipo)-1; $i>=0; $i--) { ?>
                    <option value="<?=$i?>"><?=$tipo[$i]?></option>
                  <? } ?>             
              </select>
            </div>
          </div>
          <!-- el enviar o modificar-->
          <button type="submit" class="btn btn-default">Añadir usuario</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página de nuevo usuario-->


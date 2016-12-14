<!-- Inicio Contenido de la página modificar actividad-->
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
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> La actividad <strong>se ha modificado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if($actualizado==1 && $error[0] != ""){?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong><?= $error?></strong>. Pero la actividad se ha grabado.</p>
      </div>
    </div>
    <? } else if ($error[0] != ""){?>
    <!-- Error!!! -->
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
      <h3 class="text-center">Modificar actividad</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
      <form action="<?=base_url()?>/admin/actividades/modifica_actividad" method="POST" class="horizontal">
        <div class="row">
          <input type="hidden" value="1" name="modificar">
          <input type="hidden" value="<?=$actividades['idactividades']?>" name="idactividades">
          <!-- cada par esta en un form-group -->
          <div class="form-group">
            <label for="actividad" class="col-sm-2 control-label">Actividad</label>
            <div class="col-sm-10">
              <input type="text" name="actividad" class="form-control" placeholder="Nombre de la actividad" id="actividad" value="<?= $actividades['actividad']?>">
            </div>
          </div>
          <!-- y a repetir el proceso -->
          <div class="form-group">
            <!-- el label que tiene lo que ocupa (2) -->
            <label for="campanya" class="col-sm-2 control-label">Campaña</label>
            <!-- el input que se mete en una celda -->
            <div class="col-sm-10">
                <input type="text" name="campanya" class="form-control" placeholder="Campaña de la actividad" id="campanya" value="<?= $actividades['campanya']?>">
            </div>
          </div>
          <!-- para la descripcion usamos un text area -->
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="descripcion" id="descripcion" rows="4" value="<?= $actividades['descripcion']?>"><?= $actividades['descripcion']?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="organiza" class="col-sm-2 control-label">Organizador</label>
            <div class="col-sm-10">
              <input type="text" name="organiza" class="form-control" placeholder="Organizador del evento" id="organiza" value="<?= $actividades['organiza']?>">
            </div>
          </div>
          <div class="form-group">
            <label for="lugar" class="col-sm-2 control-label">Lugar</label>
            <div class="col-sm-10">
              <input type="text" name="lugar" class="form-control" placeholder="Lugar donde se organiza" id="lugar" value="<?= $actividades['lugar']?>">
            </div>
          </div>
          <!-- el de los barrios es un poco especial porque es un select -->
          <!-- luego lo rellenaremos de la base de datos -->
          <div class="form-group">
            <label for="barrio" class="col-sm-2 control-label">Barrio</label>
            <div class="col-sm-10">
              <select name="idbarrio" id="barrio" class="form-control">
                <? foreach ($barrios as $row) { ?>
                    <? if ($actividades['idbarrio'] == $row['idbarrios']) { ?>
                        <option value="<?= $row['idbarrios']?>" selected="selected"><?= $row['nombre']?></option>
                    <? } else {?>
                        <option value="<?= $row['idbarrios']?>"><?= $row['nombre']?></option>
                    <? } ?>
                <? } ?>
              </select>
            </div>
          </div>
          <!-- igual con la seccion -->
          <div class="form-group">
            <label for="seccion" class="col-sm-2 control-label">seccion</label>
            <div class="col-sm-10">
              <select name="idseccion" id="seccion" class="form-control">
                <? foreach ($secciones as $row) { ?>
                    <? if ($actividades['idseccion'] == $row['idsecciones']) { ?>
                        <option value="<?= $row['idsecciones']?>" selected="selected"><?= $row['nombre']?></option>
                    <? } else {?>
                        <option value="<?= $row['idsecciones']?>"><?= $row['nombre']?></option>
                    <? } ?>
                <? } ?>
              </select>
            </div>
          </div>

          <!-- formateamos las fechas -->
          <div class="form-group">
            <label for="fecha" class="col-sm-2 control-label">Fecha</label>
            <div class="col-sm-10">
              <input type="date" id="fecha" class="form-control" name="fecha" placeholder="2016-10-09" value="<?= $actividades['fecha']?>">
            </div>
          </div>
          <!-- formateamos las horas -->
          <div class="form-group">
            <label for="hora" class="col-sm-2 control-label">Hora</label>
            <div class="col-sm-10">
              <input type="time" id="hora" class="form-control" name="hora" placeholder="22:30:00" value="<?= $actividades['hora']?>">
            </div>
          </div>
          <!-- el enviar o modificar-->
          <button type="submit" class="btn btn-default">Modificar actividad</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página modificar actividad-->

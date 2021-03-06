<!-- Inicio Contenido de la página de nueva actividad-->
<!-- modelo -->
<script src="<?=base_url()?>/resources/js/comprobaciones.js"></script>
<!-- vista -->
<script src="<?=base_url()?>/resources/js/actividades.js"></script>
<!-- vista-modelo -->
<script>
  $(document).ready(function(){
    $("form").submit(function(event) {
        event.preventDefault();
        if (error == 0) {
            this.submit();
        }
    });
    revisa_form('add_actividad');
  });
</script>
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
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> La actividad <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if($actualizado==1 && $error[0] != ""){?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong>definimos el problema</strong>. Pero la actividad se ha grabado.</p>
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
      <h3 class="text-center">Nueva actividad</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
      <form action="<?=base_url()?>/admin/actividades/add_actividad" method="POST" class="horizontal" id="add_actividad" enctype="multipart/form-data">
        <div class="row">
          <input type="hidden" value="1" name="add">
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
              <input type="date" id="fecha" class="form-control" name="fecha" placeholder="dd/mm/aaaa" value="<?= $actividades['fecha']?>">
            </div>
          </div>
          <!-- formateamos las horas -->
          <div class="form-group">
            <label for="hora" class="col-sm-2 control-label">Hora</label>
            <div class="col-sm-10">
              <input type="time" data-olor="fresa" id="hora" class="form-control" name="hora" placeholder="22:30:00" value="<?= $actividades['hora']?>">
            </div>
          </div>
          <!-- si es todo el día -->
          <div class="form-group">
            <label for="todoeldia" class="col-sm-4 control-label">Todo el día</label>
            <div class="col-sm-8">
                <input type="checkbox" id="todoeldia" class="form-control" name="todoeldia" value="td">
            </div>
          </div>
          <!-- documentos -->
          <div class="form-group" id="caja_documentos">
            <!-- documento -->
            <div class="form-group">
              <label for="documento" class="col-sm-4 control-label">Documento</label>
              <div class="col-sm-8">
                  <input type="file" id="documento" class="form-control" name="documentos[]" value="">
              </div>
            </div>
            <!-- descripcion documento-->
            <div class="form-group">
              <label for="descripcion_documento" class="col-sm-2 control-label">Descripcion documento</label>
              <div class="col-sm-10">
                  <textarea class="form-control" name="descripcion_documento[]" id="descripcion_documento" rows="4"><?= $actividades['descripcion_documento']?></textarea>
              </div>
            </div>
          </div>
<!--ojo ?? mismo id -->
          <div class="form-group">
            <div class="col-sm-12">               
               <a href="javascript:add_subida('caja_documentos','documento');">A&ntilde;adir otro</a>
            </div>
          </div>
          <!-- imagenes -->
          <div class="form-group" id="caja_imagenes">
            <!-- imagen -->          
            <div class="form-group">
              <label for="imagen" class="col-sm-4 control-label">Imagen</label>
              <div class="col-sm-8">
              <!-- <input type="file" id="imagen" class="form-control" name="imagen" value=""><a href="javascript:add_subida('','imagen');">A&ntilde;adir otro</a> -->
                <input type="file" id="imagen" class="form-control" name="imagenes[]" value="">
              </div>
            </div>
            <!-- descripcion imagen-->
            <div class="form-group">
              <label for="descripcion_imagen" class="col-sm-2 control-label">Descripcion imagen</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="descripcion_imagen[]" id="descripcion_imagen" rows="4"><?= $actividades['descripcion_imagen']?></textarea>
              </div>
            </div>
          </div>
<!--ojo ?? mismo id -->
          <div class="form-group">
            <div class="col-sm-12">               
               <a href="javascript:add_subida('caja_imagenes','imagen');">A&ntilde;adir otro</a>
            </div>
          </div>
          <!-- el enviar o modificar-->
          <button type="submit" class="btn btn-default">Añadir actividad</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Final Contenido de la página de nueva actividad-->

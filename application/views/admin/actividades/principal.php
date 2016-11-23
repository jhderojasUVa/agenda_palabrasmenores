
<!-- Inicio Contenido de la página de actividades-->

<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h3>Actividades del usuario: <?echo $usuario['nombre']?></h3>
    </div>
  </div>

  <!-- en principio esto ya no hace falta al estar en el menu.php -->
  <div class="row">
    <div class="col-md-12">
        <form action="admin/Actividades/add_actividad" method="POST">
            <input type="submit" value="nueva actividad">
        </form>
    </div>
  </div>
  <!-- reordenamos todo y lo juntamos -->
  <div class="row">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Actividad</th>
          <th>Campaña</th>
          <th>Fecha</th>
          <th>Publicada</th>
          <th>Acciones</th>
        </tr>
        <? foreach ($actividades as $fila) { ?>
        <tr>
          <td>
            <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/<?=$fila["idactividades"]?>"><?=$fila["actividad"]?></a>
          </td>
          <td>
            <?=$fila["campanya"]?>
          </td>
          <td>
            <?=$fila["fecha"]?>
          </td>
          <td>
            <? if ($fila["publicada"]==1) { echo "Si"; } else { echo "No";} ?>
          </td>
          <td>
            <span class="text-center">
              <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/<?=$fila["idactividades"]?>">Modificar</a>
              <a href="#">Borrar</a>
            <span>
          </td>
        </tr>
        <? } ?>
        <tr>
        </tr>
      </table>
    </div>
  </div>
</div>

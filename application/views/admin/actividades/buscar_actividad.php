<!-- mostrara el resultado de la busqueda con un enlace para poder editar la actividad -->

<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h3>Resultado de la búsqueda de actividades del usuario: <?echo $usuario['nombre']?></h3>
    </div>
  </div>
  <!-- reordenamos todo y lo juntamos -->
  <div class="row">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Campaña</th>
          <th>Actividad</th>
          <th>Organiza</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
        <? foreach ($actividades as $fila) { ?>
        <tr>
          <td>
            <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/<?=$fila["idactividades"]?>"><?=$fila["campanya"]?></a>
          </td>
          <td>
            <?=$fila["actividad"]?>
          </td>
          <td>
            <?=$fila["organiza"]?>
          </td>
          <td>
            <?=$fila["fecha"]?>
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

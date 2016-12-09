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
          <th>Actividad</th>
          <th>Campaña</th>
          <th>Fecha</th>
          <th>Publicada</th>
          <th>Acciones</th>
        </tr>
        <? foreach ($actividades as $fila) { ?>
        <tr>
          <td>
            <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/?idactividades=<?=$fila["idactividades"]?>"><?=$fila["actividad"]?></a>
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
              <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/?idactividades=<?=$fila["idactividades"]?>">Modificar</a>
              <a href="#">Borrar</a>
              <? if ($fila["publicada"]==1) {?> 
                <a href="<?=base_url()?>/admin/Actividades/publicar/?idactividades=<?=$fila["idactividades"]?>">Despublicar</a>
              <? } else {?> 
                <a href="<?=base_url()?>/admin/Actividades/publicar/?idactividades=<?=$fila["idactividades"]?>">Publicar</a>
              <? } ?>
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

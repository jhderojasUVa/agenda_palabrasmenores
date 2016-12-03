<!-- mostrara el resultado de la busqueda con un enlace para poder editar la barrio -->

<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h3>Resultado de la búsqueda de barrios realizada por: <?echo $usuario['nombre']?></h3>
    </div>
  </div>
  <!-- reordenamos todo y lo juntamos -->
  <div class="row">
    <div class="col-md-12">
      <table class="table table-stripped">
        <tr>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
        <? foreach ($barrios as $fila) { ?>
        <tr>
          <td>
            <a href="<?=base_url()?>/admin/Barrios/modifica_barrio/?idbarrios=<?=$fila["idbarrios"]?>"><?=$fila["nombre"]?></a>
          </td>
          <td>
            <span class="text-center">
              <a href="<?=base_url()?>/admin/Barrios/modifica_barrio/?idbarrios=<?=$fila["idbarrios"]?>">Modificar</a>
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


<!-- Inicio Contenido de la página de actividades-->

<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h3>Actividades del usuario: <?echo $usuario['nombre']?></h3>
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
            <!-- Si está publicada y es editor, que no deje modificar --> 
            <? if ($fila["publicada"]==1 && $acl==3) {
                echo $fila["actividad"];
               } else { ?>
                <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/?idactividades=<?=$fila["idactividades"]?>"><?=$fila["actividad"]?></a>
            <? } ?>
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
              <!-- Si está publicada y es editor, que no deje modificar -->
              <? if ($fila["publicada"]==1 && $acl==3) {
                    echo "Modificar";
              } else { ?>              
                    <a href="<?=base_url()?>/admin/Actividades/modifica_actividad/?idactividades=<?=$fila["idactividades"]?>">Modificar</a>
              <? } ?>
              <a href="#">Borrar</a>
              <!-- solo dejar publicar o desplublicar si es superadministador o redactor -->
              <? if ($acl==1 || $acl==2) {?>
                <? if ($fila["publicada"]==1) {?> 
                  <a href="<?=base_url()?>/admin/Actividades/publicar/?idactividades=<?=$fila["idactividades"]?>">Despublicar</a>
                <? } else {?> 
                  <a href="<?=base_url()?>/admin/Actividades/publicar/?idactividades=<?=$fila["idactividades"]?>">Publicar</a>
                <? } ?>
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

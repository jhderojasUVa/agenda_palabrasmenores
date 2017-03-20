<!-- Inicio Contenido de la página  con un formulario de buscar barrios-->
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
        <p><span class="glyphicon glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> La barrio <strong>se ha creado con &eacute;xito</strong>.</p>
      </div>
    </div>
    <? } else if($actualizado==1 && (isset($error))){?>
    <!-- existe un problema no grabe, ejemplo la fecha o algo asi -->
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3>Atenci&oacute;n</h3>
        <p><span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Ha habido algun pequeño error: <strong>definimos el problema</strong>. Pero la barrio se ha grabado.</p>
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
      <h3 class="text-center">Buscar Barrio</h3>
    </div>
  </div>
  <div class="row">
    <!-- centramos -->
    <div class="col-md-offset-4 col-md-4">
      <form action="<?=base_url()?>/admin/barrios/buscar_barrio" method="POST" class="horizontal">
        <div class="row">
            <!-- aunque es vista por formulario, se comporta como busqueda por cajetin  -->            
            <!-- por eso pasamos tipo de busqueda 1 -->
            <input type="hidden" name="tipo_busqueda" value="1">           
            <!-- cada par esta en un form-group -->
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="q" placeholder="Buscador de barrios">
                </div>
                <!-- el enviar o modificar-->
                <button type="submit" class="btn btn-default" class="col-sm-4">Buscar</button>
            </div>    
        </div>  
      </form>
    </div>
  </div>
</div>
<!-- Final Contenido de la página de formulario de buscar barrio -->

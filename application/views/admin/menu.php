<!-- menu lo definimos con un NAV de naviegacion -->
<nav class="navbar navbar-default">
  <!-- metemos el contenedor -->
  <div class="container-fluid">
    <!-- creamos la navegacion , la cabecera-->
    <div class="navbar-header">
      <!-- meteremos una imagen de logo -->
      <a class="navbar-brand" href="<?=base_url()?>/admin">
        <img alt="Palabras menores" src="">
      </a>
      <!-- hacemos la navegacion en si al viejo estilo ul/li-->
      <ul class="nav navbar-nav">
        <!-- actividad nueva -->
        <li><a href="<?=base_url()?>/admin/actividades/add_actividad">Nueva Actividad</a></li>
        <!-- Ahora que ya sabemos usar los menus podemos dejarlo mas bonito -->
        <li><a href="<?=base_url()?>/admin/actividades/buscar_actividad">Buscar Actividades</a></li>
        <!-- a usuarios, barrios y secciones, solo accede el Super Administrador -->
        <? if ($acl == 1) { ?>
        <!-- creamos un desplegable para el menu de usuarios -->
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <!-- contenido del desplegable -->
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>/admin/usuarios/add_usuario">A&ntilde;adir usuario</a></li>
            <li><a href="<?=base_url()?>/admin/usuarios/buscar_usuario">Buscar usuario</a></li>
          </ul>
        </li>
        <!-- barrios -->
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Barrios <span class="caret"></span></a>
          <!-- contenido del desplegable -->
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>/admin/barrios/add_barrio">A&ntilde;adir barrio</a></li>
            <li><a href="<?=base_url()?>/admin/barrios/buscar_barrio">Buscar barrio</a></li>
          </ul>
        </li>        
        <!-- secciones -->
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Secciones <span class="caret"></span></a>
          <!-- contenido del desplegable -->
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>/admin/secciones/add_seccion">A&ntilde;adir seccion</a></li>
            <li><a href="<?=base_url()?>/admin/secciones/buscar_seccion">Buscar seccion</a></li>
          </ul>
        </li>
        <? } // fin del if ?>
        <!-- la opcion de salir -->
        <li><a href="<?=base_url()?>/admin/Login/salir">Salir</a></li>
      </ul>
      <!-- las busquedas dejamos el form al controlador -->
      <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>/admin/actividades/buscar_actividad" method="post">
        <input type="hidden" name="tipo_busqueda" value="1">
        <div class="form-group">
          <input type="text" class="form-control" name="q" placeholder="Buscador de actividades">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
    </div>
  </div>
</nav>

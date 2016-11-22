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
        <!-- creamos un desplegable para el menu de usuarios -->
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <!-- contenido del desplegable -->
          <ul class="dropdown-menu">
            <li><a href="#">A&ntilde;adir usuario</a></li>
            <li><a href="#">Buscar usuario</a></li>
          </ul>
        </li>
        <!-- la opcion de salir -->
        <li><a href="<?=base_url()?>/admin/Login/salir">Salir</a></li>
      </ul>
      <!-- las busquedas dejamos el form al controlador -->
      <form class="navbar-form navbar-left" role="search"src="<?=base_url()?>/admin/actividades/principal/buscar_actividad">
        <div class="form-group">
          <input type="text" class="form-control" name="q" placeholder="Buscador de actividades">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
    </div>
  </div>
</nav>


<!-- Inicio Contenido de la página de actividades-->

<div class="container">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <h3>Actividades del usuario: <?echo $usuario['nombre']?></h3>
    </div>
    <div class="col-md-3">
    </div>

    <div class="col-md-12">
        <form action="Actividades/add_actividad" method="POST">
            <input type="submit" value="nueva actividad">
        </form>
    </div>
    
<?  
    // Lo guardo por si acaso
    /*
    foreach ($actividades as $fila) {
        echo "<br/>Fila<br/>";
        print_r($fila);    
        echo "<br/>";
        foreach ($fila as $campo =>$valor) {    
            echo "<br/>Campo - Valor<br/>";
            echo "$campo - $valor";
            echo "<br/>";
        }
    } 
    */
?>
    <div class="col-md-12"><p></p></div>
    
    <div class="col-md-1">ID</div>
    <div class="col-md-1">Campaña</div>
    <div class="col-md-2">Actividad</div> 
    <div class="col-md-2">Descripción</div>
    <div class="col-md-1">Organiza</div>
    <div class="col-md-1">Lugar</div>
    <div class="col-md-1">Barrio</div>
    <div class="col-md-1">Sección</div> 
    <div class="col-md-1">Fecha</div>
    <div class="col-md-1">Estado</div>
<?  
    foreach ($actividades as $fila) {
?>
        <div class="col-md-1"><p><?echo $fila['idactividades']?><p></div>
        <div class="col-md-1"><?echo $fila['campanya']?></div>
        <div class="col-md-2"><?echo $fila['actividad']?></div> 
        <div class="col-md-2"><?echo $fila['descripcion']?></div>
        <div class="col-md-1"><?echo $fila['organiza']?></div>
        <div class="col-md-1"><?echo $fila['lugar']?></div>
        <div class="col-md-1"><?echo $fila['idbarrio']?></div>    
        <div class="col-md-1"><?echo $fila['idseccion']?></div> 
        <div class="col-md-1"><?echo $fila['fecha']?></div>
        <div class="col-md-1">Falta</div>

        <div class="col-md-12"><p></p></div>
<?  }?> 
<!-- Por columnas sería
        <div class="col-md-2"><p>ID</p></div>
        <div class="col-md-10"><p><?echo $fila['idactividades']?></p></div>        
        <div class="col-md-2"><p>Campaña</p></div>
        <div class="col-md-10"><p><?echo $fila['campanya']?></p></div>
        <div class="col-md-2"><p>Actividad</p></div>
        <div class="col-md-10"><p><?echo $fila['actividad']?></p></div>
        <div class="col-md-2"><p>Descripción</p></div>
        <div class="col-md-10"><p><?echo $fila['descripcion']?></p></div>
        <div class="col-md-2"><p>Organiza</p></div>
        <div class="col-md-10"><p><?echo $fila['organiza']?></p></div>
        <div class="col-md-2"><p>Lugar</p></div>
        <div class="col-md-10"><p><?echo $fila['lugar']?></p></div>
        <div class="col-md-2"><p>Barrio</p></div>
        <div class="col-md-10"><p><?echo $fila['idbarrio']?></p></div> 
        <div class="col-md-2"><p>Sección</p></div>
        <div class="col-md-10"><p><?echo $fila['idseccion']?></p></div>
        <div class="col-md-2"><p>Fecha</p></div>
        <div class="col-md-10"><p><?echo $fila['fecha']?></p></div>         
        <div class="col-md-12"><p></p></div> 
-->
</div>
<!-- Final Contenido de la página actividad-->


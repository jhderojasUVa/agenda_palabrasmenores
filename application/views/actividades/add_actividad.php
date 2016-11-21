<!DOCTYPE html>
<html lang="es">
<head>
  <title>Entrada al gestor de actividades</title>
  <!-- Estilos -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/resources/css/estilos.css" />
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="col-md-4"></div>
    <div class="col-md-6">Nueva Actividad</div>
    <div class="col-md-2"></div>
    
    <div class="col-md-12"><p></p></div>
    
    <div class="col-md-12">
        <form action="add_actividad" method="POST">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="campanya">Campaña</label>
            </div>                 
            <div class="col-md-6">            
                <input type="text" name="campanya" id="campanya"><br/>
            </div>                
            <div class="col-md-2"></div>
            
            <div class="col-md-12"><p></p></div>            
            <div class="col-md-2"></div>            
            <div class="col-md-2">
                <label for="actividad">Actividad</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="actividad" id="actividad"><br/>
            </div>
            <div class="col-md-2"></div>            

            <div class="col-md-12"><p></p></div> 
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="descripcion">Descripción</label>
            </div>
            <div class="col-md-6">
                <textarea name="descripcion" id="descripcion"></textarea><br/>
            </div>
            <div class="col-md-2"></div>

            <div class="col-md-12"><p></p></div>
            <div class="col-md-2"></div>            
            <div class="col-md-2">
                <label for="actividad">Organiza</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="organiza" id="organiza"><br/>
            </div>
            <div class="col-md-2"></div>

            <div class="col-md-12"><p></p></div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="lugar">Lugar</label>
            </div>
            <div class="col-md-6">                
                <input type="text" name="lugar" id="lugar"><br/>            
            </div>
            <div class="col-md-2"></div>

            <div class="col-md-12"><p></p></div>            
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="barrio">Barrio</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="idbarrio" id="barrio"><br/>            
            </div>                
            <div class="col-md-2"></div>

            <div class="col-md-12"><p></p></div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="seccion">Sección</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="idseccion" id="seccion"><br/>            
            </div>
            <div class="col-md-2"></div>

            <div class="col-md-12"><p></p></div>            
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="fecha">Fecha</label>
            </div>
            <div class="col-md-6">
                <input type="text" name="fecha" id="fecha"><br/>            
            </div>
            <div class="col-md-2"></div>
            
            <div class="col-md-12"><p></p></div>
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <input type="submit" value="enviar">
            </div>
            <div class="col-md-2"></div>            
        </form>
    </div>
</div>
</body>
</html>

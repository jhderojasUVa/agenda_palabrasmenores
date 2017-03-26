<!DOCTYPE html>
<html lang="es">
<head>
  <title>Palabras Menores - Agenda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- JQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!-- Extras -->
  <link href="<?php echo base_url()?>resources/css/estilos.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <!-- header -->
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12 text-center" role="banner">
        <img src="<?php base_url()?>resources/img/hero.jpg" alt="Palabras menores" aria-describeby="Logotipo de Palabras Menores"/>
      </div>
    </div>
    <!-- contenido -->
    <div class="row" style="margin-bottom:20px;">
      <div class="col-md-10">
        <!-- titulo -->
        <?php foreach ($actividad as $row) { ?>
          <h1 class="titulo"><?php echo $row['idactividades']?></h1>
          <p class="text-right"><em><?php echo str_replace('-', '/', $row['fecha'])?></em></p>
          <p class="text-right"><em><?php echo $row['organiza' ]?></em></p>
          <!-- actividad -->
          <h1 class="titulo">Qué es</h1>
          <p><?php echo $row['descripcion'] ?></p>
          <!-- extras -->
          <!-- lugar -->
          <h2 class="titulo">Lugar</h2>
          <p><?php echo $row['lugar'] ?> (<a href="http://maps.google.es/maps?f=q&source=s_q&hl=es&geocode=&q=<?php echo $row['lugar'] ?>" target="_blank">Ver en Google Maps</a>)</p>
          <!-- imagenes -->
          <!-- documentos -->
        <?php } ?>
      </div>
      <div class="col-md-2">
        <h3>Agenda Palabras Menores</h3>
        <p>Agenda Palabras Menores es, como su nombre indica, es una agenda de eventos que se anuncian en <a href="http://www.palabrasmenores.info">Palabras Menores</a>.
      </div>
    </div>
    <!-- footer -->
    <div class="col-md-12">
      <div class="footer">
        <p>palabras menores - terminos de uso<br />
          &copy; <?php echo date('Y')?> - Todos los derechos reservados</p>
      </div>
    </div>
  </div>
</body>
</html>

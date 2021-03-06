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
        <!-- calendario -->
        <h1 class="titulo">Calendario</h1>
        <div class="calendario">
          <?php echo $this -> calendar -> generate(date('Y'), date('m'), $dias_eventos);?>
        </div>
        <!-- eventos -->
        <?php if ($fecha_titulo) { ?>
          <h1 class="titulo">Actividades del día <?php echo $fecha_titulo ?> </h1>
        <? } else { ?>
          <h1 class="titulo">Actividades de dentro de 30 días</h1>
        <?php } ?>
        <div class="actividades">
          <?php if ($actividad_mes) {
            foreach ($actividad_mes as $row) {?>
            <p><em><?php echo str_replace('-', '/', $row -> fecha)?></em> - <a href="<?php echo base_url()?>principal/actividad?idactividad=<?php echo $row -> idactividades?>" role="link"><?php echo $row -> actividad?></a> (<?php echo $row -> lugar?>)</p>
          <?php }
        } else {?>
          <div class="alert alert-danger">
            <p><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>Lo sentimos</strong>: No tenemos actividades para este mes</p>
          </div>
        <?php } ?>
        </div>
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

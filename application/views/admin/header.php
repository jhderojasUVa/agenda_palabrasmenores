<!DOCTYPE html>
<html lang="es">
<head>
  <title>Entrada al gestor de actividades</title>
  <!-- Estilos -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/resources/css/estilos.css" />
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>
  // Texto del datepicker de JQUERYUI en castellano
  $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '< Ant',
     nextText: 'Sig >',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd/mm/yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
   };
   $.datepicker.setDefaults($.datepicker.regional['es']);
  $(document).ready(function(){
    // Inicializacion de las fechas de JQUERYUI
    $("#fecha").datepicker();

    // Comentamos el resto, pero lo dejo para que lo veas

    //$("#fecha").control(); //Revisar inicializador

    // Forma buena
    /*
    $("form").control({
      "backjground": "green",
      initialize: 0,
    });

    var olor = $("input[name='fecha']").attr("data-olor");
    var atributos = $("input[name='fecha']").attr();
      */
  });

  </script>
</head>
<body>
    <!-- cabecera -->
    <header>
      <!-- contenedor -->
      <div class="container-fluid" style="margin-bottom: 20px;">
        <!-- fila -->
        <div class="row">
          <!-- celda -->
          <div class="col-md-12">
            <center><img src="<?php echo base_url()?>resources/img/hero.jpg" alt="Palabras menores" /></center>
          </div>
        </div>
      </div>
    </header>

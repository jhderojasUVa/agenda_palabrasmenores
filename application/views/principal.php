<!DOCTYPE html>
<html lang="es">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
  // Con esto evitamos que el submit haga algo, le quitamos el evento
  $(document).ready(function(){
    $("form").submit(function(event) {
      // Pongo error a 1 para que no haga el submit, no es por nada
      error = 1;
      event.preventDefault();
      if (error==1) {
        $(".resultado").html("LAS CAGAO HAY ERRORES");
      }
      else {
        $this.submit();
      }
    });

    $("a").click(function(event) {
      alert("Has dado a un enlace!. Recuerda quitarme o comentarme para que funcione!");
      event.preventDefault();
    });
  });

  // Funciones chorracas tontas para ver los seleccionadores de elementos
  function cambia_id(elemento) {
    $("#"+elemento).html("¡CAMBIADO el ID #"+elemento+"!").css("background-color", "#00ff00");;
    //$("#"+elemento).html("¡CAMBIADO el ID #"+elemento"!");
  }

  function cambia_class(elemento) {
    $("."+elemento).html("¡CAMBIADO el CLASS ."+elemento+"!");
  }

  function cambia_p() {
    $("p").html("¡sorpresa!");
  }

  // Funcion para comprobar un elemento de un formulario
  function revisa_form() {
    // Cogemos el texto del form
    $metido_en_la_caja = $("#formulario input[name=texto]").val();
    alert("Has metido en la caja: "+$metido_en_la_caja);
    if ($metido_en_la_caja=="") {
      $(".resultado").html("<span style='color:red'>NO HAS METIDO NADA Y LO SABES</span>");
    } else {
      $(".resultado").html("BIEEEEEEEN, has escrito: "+$metido_en_la_caja);
    }
  }
  </script>
</head>
<body>
  <h1 style="text-align:center; margin:30px 30px;">Calendario</h1>
  <h1 style="text-align:center; margin:30px 30px;">actividades del mes (30 dias)</h1>
  <h1>Ejemplo de jquery</h1>
  <div id="elemento_id">
    <p class="cosa">Esto esta dentro de un class</p>
    <p>Esto no esta en un class</p>
    <p class="otra_cosa">Esto es otro class diferente</p>
    $("html body div#elemento_id .otra_cosa")
  </div>
  <br /><u>Menu de cambios con javascript</u><br />
  <a href="javascript:cambia_id('elemento_id');">esto cambia el id si me das</a><br />
  <a href="javascript:cambia_class('cosa');">esto cambia el class cosa</a><br />
  <a href="javascript:cambia_class('otra_cosa');">esto cambia el class otra_cosa</a><br />
  <a href="javascript:cambia_p();">esto cambia los parrafos p, todos</a>

  <br /><u>Ahora un formulario</u><br />
  <form id="formulario" onsubmit="javascript:revisa_form();">
    <input type="text" name="texto" placeholder="Escribe aqui">
    <input type="submit" value="dame!">
  </form>
  <br>
  <div class="resultado"></div>
</body>
</html>

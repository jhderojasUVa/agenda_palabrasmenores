// Javascript para comprobaciones en el cliente

function esta_vacio($cadena) {
  // Funcion que comprueba si esta vacio algo o no
  // Devuelve true si NO lo esta
  if ($cadena) {
    return true;
  } else {
    return false;
  }
}

function comprueba_input($form, $input) {
  // Funcion que comprueba un input de un formulario

  // Buscamos por el DOM el elemento
  // Con # va un id
  // Con . va un class
  if ($form) {
    // Si hay un form
    if ($input!="textarea") {
      $contenido = $("#".$form." input[type='".$input."']").value();
    } else {
      $contenido = $("#".$form." textarea").value();
    }
  } else {
    // Sino cogemos el form que haya
    if ($input!="textarea") {
      $contenido = $("form input[type='".$input."']").value();
    } else {
      $contenido = $("form textarea").value();
    }
  }
  // Revisamos si hay algo metido
  if (esta_vacio($contenido) == true) {
    return true;
  } else {
    return false;
  }

}

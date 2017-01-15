// Javascript para comprobaciones en el cliente

function esta_vacio(cadena) {
  // Funcion que comprueba si esta vacio algo o no
  // Devuelve true si NO lo esta
  if (cadena) {
    return true;
  } else {
    return false;
  }
}

function comprueba_input(form, elinput) {
  // Funcion que comprueba un input de un formulario

  // Buscamos por el DOM el elemento
  // Con # va un id
  // Con . va un class
  if (form) {
    // Si hay un form
    if (elinput!="textarea") {
      contenido = $("#"+form+" input[type='"+elinput+"']").each(function(){
          contenido = $this.val();
      });
      console.log("Buscamos en = #"+form+" input[type='"+elinput+"']");
      console.log("Encontramos = "+contenido);
    } else {
      contenido = $("#"+form+" textarea")+value();
      console.log("Buscamos en = #"+form+" textarea");
      console.log("Encontramos = "+contenido);
    }
  } else {
    // Sino cogemos el form que haya
    if (elinput!="textarea") {
      contenido = $("form input[type='"+elinput+"']").val();
      console.log("Buscamos en = form input[type='"+elinput+"']");
      console.log("Encontramos = ".contenido);
    } else {
      contenido = $("form textarea").val();
      console.log("Buscamos en = form textarea");
      console.log("Encontramos = ".contenido);
    }
  }
  // Revisamos si hay algo metido
  if (esta_vacio(contenido) == true) {
    return true;
  } else {
    return false;
  }

}

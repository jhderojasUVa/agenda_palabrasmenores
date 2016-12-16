$(document).ready(function(){
    $("form").submit(function(event) {
        event.preventDefault();
        if (error == 0) {
            this.submit();
        }
    });
    
});
// Funcion para comprobar un elemento de un formulario
function revisa_form(form) {
    error = 1;
    $("#"+form).submit(function(){
        // Comprobamos con el modelo
        if (!comprueba_input(form, "text")) {
            alert("El nombre de la seccion no puede estar vacío"); 
            error = 1; 
        } else {
            error = 0;
//?? si el error o aqui el this.submit();            
// Si quito la siguiente línea tengo que pulsar dos veces el botón
            this.submit();
        }
    });
}

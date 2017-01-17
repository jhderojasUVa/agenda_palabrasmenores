$(document).ready(function(){
    $("form").submit(function(event) {
        event.preventDefault();
        if (error == 0) {
            this.submit();
        }
    });    
});
// Funcion para comprobar el formulario
function revisa_form(form) {
    error = 1;
    $("#"+form).submit(function(){
        error = 0;       
        // Comprobamos con el modelo
        if (!esta_vacio($("#"+form+" input[name=nombre]").val())){
            alert("El nombre de la seccion no puede estar vacío"); 
            error = 1;           
        }
        if (error == 0){
            this.submit();
        } 
    });
}

// Funcion para comprobar el formulario
function revisa_form(form) {
    error = 1;
    $("#"+form).submit(function(){
        error = 0;       
        // Comprobamos con el modelo
        if (!esta_vacio($("#"+form+" input[name=nombre]").val())){
            alert("El nombre del barrio no puede estar vacío"); 
            error = 1;           
        }
    });
}

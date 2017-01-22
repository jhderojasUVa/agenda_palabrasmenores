// Funcion para comprobar un elemento de un formulario
function revisa_form(form) {
    error = 1;
    $("#"+form).submit(function(){
        error = 0;
        if (!esta_vacio($("#"+form+" input[name=actividad]").val())){
            alert("La actividad no puede estar vacía"); 
            error = 1;           
        }
        if (!esta_vacio($("#"+form+" input[name=lugar]").val())){
            alert("El lugar de la actividad no puede estar vacío");  
            error = 1;           
        }
        if (!esta_vacio($("#"+form+" select[name=idbarrio]").val())){
            alert("El barrio no puede estar vacío");   
            error = 1;
        }
        if (!esta_vacio($("#"+form+" select[name=idseccion]").val())){
            alert("La sección no puede estar vacía");   
            error = 1;
        }
        if (!esta_vacio($("#"+form+" input[name=fecha").val())){
            alert("La fecha de la actividad no puede estar vacía"); 
            error = 1;         
        }
        
        // si el this.submit() no está aquí hay que pulsar dos veces el boton
        // si el evento por defecto del boton lo quitamos en este archivo
        // si lo pasamos a la vista no hace falta
        /*
        if (error == 0){
            this.submit();
        }
        */
    });
}

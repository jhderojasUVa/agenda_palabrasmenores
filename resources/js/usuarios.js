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
        // Solo comprueba que este vacio el login si es añadir
        if (!esta_vacio($("#"+form+" input[name=login]").val()) && form == "add_usuario"){
            alert("El login no puede estar vacío"); 
            error = 1;           
        }
        // solo comprueba que este vacio el password si es añadir
        if (!esta_vacio($("#"+form+" input[name=password]").val()) && form == "add_usuario"){
            alert("La contraseña del usuario no puede estar vacío");  
            error = 1;           
        }
        // solo comprueba que este vacio el rpassword si es añadir
        if (!esta_vacio($("#"+form+" input[name=rpassword]").val()) && form == "add_usuario"){
            alert("La repetición de contraseña del usuario no puede estar vacío"); 
            error = 1;         
        }
        if ($("#"+form+" input[name=password]").val() != $("#"+form+" input[name=rpassword]").val()){
            alert("La contraseña y repetir la contraseña no coinciden");
            error = 1;
        }
        if (!esta_vacio($("#"+form+" input[name=nombre]").val())){
            alert("El nombre del usuario no puede estar vacío");   
            error = 1;
        }
        if (!esta_vacio($("#"+form+" select[name=idacl]").val())){
            alert("El tipo de usuario no puede estar vacío");   
            error = 1;
        }
//?? si el this.submit() no está aquí hay que pulsar dos veces el boton
        if (error == 0){
            this.submit();
        }

    });
}

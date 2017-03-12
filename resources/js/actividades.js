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

function add_subida(donde, tipo) {
  // Funcion que añade nodos donde le indiquemos de Subida
  // donde = en que parte del DOM
  // tipo = si es imagen o documento
  if (tipo == "imagen") {
    // Esto añade otro elemento de subida
    // $("#"+donde+" #imagen").append("<input type=\"file\" id=\"imagen\" class=\"form-control\" name=\"documento\" value=\"\">");
    $("#"+donde).append("<!-- imagen -->");
    $("#"+donde).append("<div class=\"form-group\"><label for=\"imagen\" class=\"col-sm-4 control-label\">Imagen</label><div class=\"col-sm-8\"><input type=\"file\" id=\"imagen\" class=\"form-control\" name=\"imagenes[]\" value=\"\"></div></div>");
    // Esto añade otra descripcion
    // $("#"+donde+" #descripcion_imagen").append("<textarea class=\"form-control\" name=\"descripcion_imagen\" id=\"descripcion_documento\" rows=\"4\" ></textarea>");
    $("#"+donde).append("<!-- descripcion documento -->");
    $("#"+donde).append("<div class=\"form-group\"><label for=\"descripcion_imagen\" class=\"col-sm-2 control-label\">Descripcion imagen</label><div class=\"col-sm-10\"><textarea class=\"form-control\" name=\"descripcion_imagen[]\" id=\"descripcion_imagen\" rows=\"4\" ></textarea></div></div>");
  } else if (tipo == "documento") {
    // Esto añade otro elemento de subida
    // $("#"+donde+" #documento").append("<input type=\"file\" id=\"documento\" class=\"form-control\" name=\"documento\" value=\"\">");
    $("#"+donde).append("<!-- documento -->");
    $("#"+donde).append("<div class=\"form-group\"><label for=\"documento\" class=\"col-sm-4 control-label\">Documento</label><div class=\"col-sm-8\"><input type=\"file\" id=\"documento\" class=\"form-control\" name=\"documentos[]\" value=\"\"></div></div>");
    // Esto añade otra descripcion
    // $("#"+donde+" #descripcion_documento").append("<textarea class=\"form-control\" name=\"descripcion_documento\" id=\"descripcion_documento\" rows=\"4\" ></textarea>");
    // Esto añade otro elemento de subida
    $("#"+donde).append("<!-- descripcion documento -->");
    $("#"+donde).append("<div class=\"form-group\"><label for=\"descripcion_documento\" class=\"col-sm-2 control-label\">Descripcion documento</label><div class=\"col-sm-10\"><textarea class=\"form-control\" name=\"descripcion_documento[]\" id=\"descripcion_documento\" rows=\"4\" ></textarea></div></div>");
  }
}

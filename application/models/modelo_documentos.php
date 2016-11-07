<?php
/*
	Modelo Documentos
*/
class Modelo_documentos extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

    function add_documento ($idactividad, $rutadocumento, $descripcion) {
        // Funcion para añadir un documento a la actividad
      // Aqui hay que poner las variables que se le pasan y que es cada una
      // Recuerda, en el modelo, comprobar que los datos que te meten
      // en los parametros estan correctos, por seguridad
        // $idactividad   --> ID de la actividad a la que pertenece el documento
        // $rutadocumento --> Ruta donde esta el documento
        // $descripcion   --> Descripcion del documento
//OJO ??? COMO SE GRABA EL DOCUMENTO
	    // El documento no se graba aqui, sino que lo guarda el controlador
// Para mas informacion ver https://www.codeigniter.com/userguide3/libraries/file_uploading.html
        $sql = "INSERT INTO documentos (idactividad, rutadocumento, descripcion) VALUES ('" . $idactividad . "', '" . $rutadocumento . "', '" . $descripcion . "')";
        $resultado = $this -> db -> query($sql);
    }

    function update_documento ($iddocumentos, $idactividad, $rutadocumento, $descripcion) {
        // Funcion para modificar un documento
        // $iddocumentos --> Identificador del documento que se va a actualizar
        // $idactividad  --> ID de la actividad a la que pertenece el documento
        // $rutaimagen   --> Ruta donde esta el documento
        // $descripcion  --> Descripcion del documento
//OJO ??? COMO SE ACTUALIZA EL DOCUMENTO 
	    // El documento no se actualiza aqui, sino que lo hace el controlador
	    // Para mas informacion https://www.codeigniter.com/userguide3/libraries/file_uploading.html
        $sql = "UPDATE documentos SET idactividad='" . $idactividad . "', rutadocumento='". $rutadocumento."', descripcion='". $descripcion."' WHERE iddocumentos='" . $iddocumentos."'";
        $resultado = $this -> db -> query($sql);
    }

    function del_documento ($iddocumentos) {
        // Funcion para eliminar un documento
        // $iddocumentos  --> Identificador del documento que se va a eliminar
//OJO ??? COMO SE ELIMINA EL DOCUMENTO 
	    // El documento no se elimina aqui, sino que lo hace el controlador
	    // Para mas informacion https://www.codeigniter.com/userguide3/libraries/file_uploading.html
        $sql = "DELETE FROM documentos WHERE iddocumentos='" . $iddocumentos . "'";
        $resultado = $this -> db -> query($sql);
    }
  }
?>

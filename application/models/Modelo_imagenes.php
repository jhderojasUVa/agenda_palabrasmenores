<?php
/*
	Modelo Imagenes
*/
class Modelo_imagenes extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

    public function add_imagen ($idactividad, $rutaimagen, $descripcion) {
        // Funcion para añadir una imagen a la actividad
        // Aqui hay que poner las variables que se le pasan y que es cada una
        // Recuerda, en el modelo, comprobar que los datos que te meten
        // en los parametros estan correctos, por seguridad
        // $idactividad --> ID de la actividad a la que pertenece la imagen
        // $rutaimagen  --> Ruta donde esta la imagen
        // $descripcion --> Descripcion de la imagen

      	// la imagen no se añade aqui, sino que lo hace el controlador
      	// Para mas informacion https://www.codeigniter.com/userguide3/libraries/file_uploading.html

        $sql = "INSERT INTO imagenes (idactividad, rutaimagen, descripcion) VALUES ('" . $idactividad . "', '" . $rutaimagen . "', '" . $descripcion . "')";
        $resultado = $this -> db -> query($sql);
        // Recuperamos el ID de la imagen
        $sql="SELECT idimagenes FROM imagenes WHERE idactividad='".$idactividad."' AND rutaimagen='".$rutaimagen."'";
      	$resultado = $this -> db -> query($sql);
      	foreach ($resultado->result() as $row) {
                  $idimagenes = $row -> idimagenes;
      	}
      	return $idimagenes;
    }

    public function update_imagen ($idimagenes, $idactividad, $rutaimagen, $descripcion) {
        // Funcion para modificar una imagen
        // $idimagenes  --> Identificador de la imagen que se va a actualizar
        // $idactividad --> ID de la actividad a la que pertenece la imagen
        // $rutaimagen  --> Ruta donde esta la imagen
        // $descripcion --> Descripcion de la imagen

    	// la imagen no se actualiza aqui, sino que lo hace el controlador
    	// Para mas informacion https://www.codeigniter.com/userguide3/libraries/file_uploading.html

        $sql = "UPDATE imagenes SET idactividad='" . $idactividad . "', rutaimagen='". $rutaimagen."', descripcion='". $descripcion."' WHERE idimagenes='" . $idimagenes."'";
        $resultado = $this -> db -> query($sql);
    }

    public function del_imagen ($idimagenes) {
        // Funcion para eliminar imagen de una actividad
        // $idimagenes  --> Identificador de la imagen que se va a eliminar

      	// la imagen aqui, sino que lo hace el controlador, aqui se viene con la imagen borrada ;)
      	// Para mas informacion https://www.codeigniter.com/userguide3/libraries/file_uploading.html

        $sql = "DELETE FROM imagenes WHERE idimagenes='" . $idimagenes . "'";
        $resultado = $this -> db -> query($sql);
    }
  }

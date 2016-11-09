<?php
/*
	Modelo Barrios
*/
class Modelo_barrios extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

    public function add_barrio ($nombre) {
        // Funcion para añadir un barrio
        // Aqui hay que poner las variables que se le pasan y que es cada una
        // Recuerda, en el modelo, comprobar que los datos que te meten
        // en los parametros estan correctos, por seguridad
        // $nombre --> Nombre del barrio que se va a añadir
        
        $sql = "INSERT INTO barrios (nombre) VALUES ('" . $nombre . "')";
        $resultado = $this -> db -> query($sql);
        // Recuperamos el ID del barrio
        $sql="SELECT idbarrios FROM barrios WHERE nombre='".$nombre."'";
	$resultado = $this -> db -> query($sql);
	foreach ($resultado->result() as $row) {
            $idbarrios = $row -> idbarrios;         
	}       
	return $idbarrios;
    }

    public function update_barrio ($idbarrios, $nombre) {
        // Funcion para modificar un barrio
        // $idbarrios --> Identificador del barrio que se va a actualizar
        // $nombre    --> Nombre del barrio que se va a actualizar
        $sql = "UPDATE barrios SET nombre='" . $nombre . "' WHERE idbarrios='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql);
    }

    public function del_barrio ($idbarrios) {
        // Funcion para eliminar un barrio
        // $idbarrios  --> Identificador del barrio que se va a eliminar
        // Primero borramos las actividades y por lo tanto, primero las imagenes y los documentos de las actividades

        // Borramos las imagenes
        // No la borramos del HD
        $sql = "SELECT idactividades FROM actividades WHERE idbarrio='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql);
        foreach ($resultado->result() as $row) {
            $sql_borra_imagen = "DELETE FROM imagenes WHERE idactividad ='" . $row->idactividades."'";
            $resultado_borrado = $this -> db -> query($sql_borra_imagen);
        }

        // Borramos los documentos
        // No la borramos del HDo
        $sql = "SELECT idactividades FROM actividades WHERE idbarrio='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql);
        foreach ($resultado->result() as $row) {
            $sql_borra_documento = "DELETE FROM documentos WHERE idactividad ='" . $row->idactividades."'";
            $resultado_borrado = $this -> db -> query($sql_borra_documento);
        }


        // Ahora borramos las actividades
        $sql = "DELETE FROM actividades WHERE idbarrio='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql);

        // Y por ultimo el barrio
        $sql = "DELETE FROM barrios WHERE idbarrios='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql);
    }
  }

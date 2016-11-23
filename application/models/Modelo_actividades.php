<?php
/*
	Modelo Actividades
*/
class Modelo_actividades extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

    public function add_actividad ($campanya, $actividad, $descripcion, $organiza, $lugar, $idbarrio, $idseccion, $fecha, $usuario, $publicada) {
        // Aqui hay que poner las variables que se le pasan y que es cada una
        // Recuerda, en el modelo, comprobar que los datos que te meten
        // en los parametros estan correctos, por seguridad
        // Funcion para añadir una actividad
        // $campanya    --> Nombre de la campanya de la actividad
        // $actividad   --> Nombre de la actividad
        // $descripcion --> Descripcion de la actividad
        // $organiza    --> Nombre del organizador u organizadores
        // $lugar       --> Direccion donde tiene lugar
        // $idbarrio    --> ID del barrrio donde se realiza la actividad
        // $idseccion   --> ID de la seccion a la que pertenece la actividad
        // $fecha       --> Fecha y Hora de comienzo de la actividad
        // $usuario     --> login del usuario
        // $publicada   --> Si está o no publicada la actividad, al crearla vendrá con valor 0 

        $sql = "INSERT INTO actividades (campanya, actividad, descripcion, organiza, lugar, idbarrio, idseccion, fecha, usuario, publicada) VALUES ('" . $campanya . "', '" . $actividad . "', '" . $descripcion . "', '" . $organiza . "', '" . $lugar . "', '" . $idbarrio . "', '" . $idseccion . "', '" . $fecha . "', '" . $usuario . "', '" . $publicada . "')";
        $resultado = $this->db->query($sql);
        // Recuperamos el ID
        $sql="SELECT idactividades FROM actividades WHERE campanya='".$campanya."' AND actividad='".$actividad."' AND descripcion='".$descripcion."' AND organiza='".$organiza."' AND lugar='".$lugar."' AND idbarrio='".$idbarrio."' AND idseccion='".$idseccion."' AND fecha='".$fecha."' AND usuario='".$usuario."' AND publicada='".$publicada."'";
      	$resultado = $this -> db -> query($sql);
      	foreach ($resultado->result() as $row) {
                  $idactividades = $row -> idactividades;
      	}
	      return $idactividades;
    }

    public function update_actividad ($idactividades, $campanya, $actividad, $descripcion, $organiza, $lugar, $idbarrio, $idseccion, $fecha, $usuario, $publicada) {
        // Funcion para modificar una actividad
        // $idactividades --> Identificador de la actividad que se va a actualizar
        // $campanya      --> Nombre de la campanya de la actividad
        // $actividad     --> Nombre de la actividad
        // $descripcion   --> Descripcion de la actividad
        // $organiza      --> Nombre del organizador u organizadores
        // $lugar         --> Direccion donde tiene lugar
        // $idbarrio      --> ID del barrrio donde se realiza la actividad
        // $idseccion     --> ID de la seccion a la que pertenece la actividad
        // $fecha         --> Fecha y Hora de comienzo de la actividad
        // $usuario       --> login del usuario
        // $publicada     --> Si está o no publicada la actividad
        $sql = "UPDATE actividades SET campanya='".$campanya."', actividad='". $actividad."', descripcion='".$descripcion."', organiza='".$organiza."', lugar='".$lugar."', idbarrio='".$idbarrio."', idseccion='".$idseccion."', fecha='".$fecha."', usuario='".$usuario."', publicada='".$publicada."' WHERE idactividades='".$idactividades."'";
	      $resultado = $this -> db -> query($sql);
    }

    public function del_actividad ($idactividades) {
        // Funcion para eliminar una actividad
        // $idactividades --> Identificador de la actividad que se va a eliminar
        // Primero borramos las imagenes
        // No las borramos del HD
	      // Se borra desde el controlador, aqui se viene "borrado"

        $sql="DELETE FROM imagenes WHERE idactividad='".$idactividades."'";
        $resultado = $this -> db -> query($sql);

        // Luego borramos los documentos
        // No los borramos del HD
	      // Se borra desde el controlador

        $sql="DELETE FROM documentos WHERE idactividad='".$idactividades."'";
        $resultado = $this -> db -> query($sql);

        // Borramos la actividad
        $sql = "DELETE FROM actividades WHERE idactividades='".$idactividades."'";
	      $resultado = $this -> db -> query($sql);
    }
    
    public function actividad_usuario_fecha($idusuario){       
        // Funcion que devuelve las actividades de un usuario por orden descendente de fecha
        // $idusuario --> Identificador del usuario      
       
        $sql = "SELECT * FROM actividades WHERE usuario ='" . $idusuario."' ORDER BY fecha DESC";
        $resultado = $this -> db -> query($sql); 
        return $resultado -> result_array(); // Obtener el array
    } 
    
    public function actividad_id($idactividades){       
        // Funcion que devuelve una actividad a partir del id de actividades
        // $idactividades --> Identificador de la actividad      
       
        $sql = "SELECT * FROM actividades WHERE idactividades ='" . $idactividades."'";
        $resultado = $this -> db -> query($sql); 
        return $resultado -> result_array(); // Obtener el array
    }   
    
  }
?>

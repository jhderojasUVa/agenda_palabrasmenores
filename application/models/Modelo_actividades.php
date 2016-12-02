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
        // En de si exite fecha o no la consulta es distinta, porque sale error.
        // Porque si no tiene fecha al hacer el select no devuelve ninguno,
        // Aunque con fecha en blanco pueden aparecer varios
        // OJO si no tiene fecha, pongo la fecha a la que graba por defecto, porque sino la consulta no devuelve ningun registro
        if ($fecha =="") {$fecha="0000-00-00";}
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
        return true;
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
        return true;
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

    public function buscar_cajetin($texto){
        // Funcion que devuelve las actividades, resultado de la busqueda de un texto en cualquier campos de actividades sobre el que se va a buscar
        // $texto --> texto que se va a buscar
        // Campos sobre los que se va a buscar : campanya, actividad, descripcion, organiza, lugar
        $array_campos = array ('campanya', 'actividad', 'descripcion', 'organiza', 'lugar');
        $sql = "SELECT * FROM actividades WHERE ";
        for ($i = 0; $i < sizeof($array_campos); $i++){
            $sql.= "$array_campos[$i] LIKE '%$texto%'";
            if ((sizeof($array_campos)-1) != $i){$sql.=" OR ";}
        }
        $sql.= " ORDER BY fecha DESC";
        $resultado = $this -> db -> query($sql);
        return $resultado -> result_array(); // Obtener el array
    }

    public function buscar_actividad($array_datos){
        // Funcion que devuelve las actividades, resultado de la busqueda en campos con un determinado texto
        // $array_datos --> array con el texto de los campos de actividades por los que se va a buscar
        // Estos textos corresponden a los campos: campanya, actividad, organiza y fecha
        $array_campos = array ('campanya', 'actividad','organiza', 'fecha');
        $sql="";
        $contador=0;

        for ($i = 0; $i < sizeof($array_campos); $i++){
            if (!empty($array_datos[$i])) {
                $contador ++;
                if ($contador == 1) {
                    $sql = "SELECT * FROM actividades WHERE ";
                } else {$sql.=" AND ";}
                $sql.= "$array_campos[$i] LIKE '%$array_datos[$i]%'";
            }
        }
        if ($contador>0) {$sql.=" ORDER BY fecha DESC";}

        if (($sql)) {
            $resultado = $this -> db -> query($sql);
            return $resultado -> result_array(); // Obtener el array
        } else return array();
    }

    public function mostrar_actividad_dia($fecha, $que_mostramos) {
      // Devuelve la actividad y los datos de la actividad
      // Si $que_mostramos = 0 (lo basico)
      // Si $que_mostramos = 1 (todos los datos)
    }

    public function mostrar_desde_hasta($fecha_inicio, $fecha_fin) {
      // Devuelve las actividades desde la fecha de inicio hasta la fecha de fin
    }

  }
?>

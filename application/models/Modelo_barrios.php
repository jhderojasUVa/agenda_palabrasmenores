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

    public function barrio_id($idbarrios){       
        // Funcion que devuelve un barrio a partir del id
        // $idbarrios --> id del barrio      
       
        $sql = "SELECT * FROM barrios WHERE idbarrios ='" . $idbarrios."'";
        $resultado = $this -> db -> query($sql); 
        return $resultado -> result_array(); // Obtener el array
    }
    // buscar_barrio no lo estamos utilizando
    // lo cambiamos para hacerlo como buscar_cajetin
    // lo dejo por si acaso
    public function buscar_barrio($array_datos){
        // Funcion que devuelve los barrios, resultado de la busqueda en campos con un determinado texto
        // $array_datos --> array con el texto de los campos de barrios por los que se va a buscar
        // Estos textos corresponden a los campos: nombre
        $array_campos = array ('nombre');
        $sql="";
        $contador=0;
    
        for ($i = 0; $i < sizeof($array_campos); $i++){
            if (!empty($array_datos[$i])) {
                $contador ++;
                if ($contador == 1) {
                    $sql = "SELECT * FROM barrios WHERE ";
                } else {$sql.=" AND ";}
                $sql.= "$array_campos[$i] LIKE '%$array_datos[$i]%'";    
            }
        }
        if ($contador>0) {$sql.=" ORDER BY nombre";}

        if (($sql)) {
            $resultado = $this -> db -> query($sql);
            return $resultado -> result_array(); // Obtener el array 
        } else return array();
    }
    
    public function devuelve_barrios(){       
        // Funcion que devuelve todos los barrios     
       
        $sql = "SELECT * FROM barrios ORDER BY nombre";
        $resultado = $this -> db -> query($sql); 
        return $resultado -> result_array(); // Obtener el array
    }   
    
    public function buscar_cajetin($texto){
        // Funcion que devuelve los barrios, resultado de la busqueda de un texto en cualquier campos de barrios sobre el que se va a buscar
        // $texto --> texto que se va a buscar
        // Campos sobre los que se va a buscar : nombre
        $array_campos = array ('nombre');
        $sql = "SELECT * FROM barrios WHERE ";
        for ($i = 0; $i < sizeof($array_campos); $i++){
            $sql.= "$array_campos[$i] LIKE '%$texto%'";
            if ((sizeof($array_campos)-1) != $i){$sql.=" OR ";}
        }
        $sql.= " ORDER BY nombre";
        $resultado = $this -> db -> query($sql);
        return $resultado -> result_array(); // Obtener el array
    }
    
    public function ultimos_barrios($numero){       
        // Funcion que devuelve los últimos barrios     
        // $numero --> Numero de barrios a devolver
        $sql = "SELECT * FROM barrios ORDER BY idbarrios DESC LIMIT ".$numero;
        $resultado = $this -> db -> query($sql); 
        return $resultado -> result_array(); // Obtener el array
    }  
    
}

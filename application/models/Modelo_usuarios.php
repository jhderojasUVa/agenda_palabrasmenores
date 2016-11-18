<?php
/*
	Modelo Usuarios
*/
class Modelo_usuarios extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
                // Cargamos la libreria-sesiones
                //$this -> load -> library("libreria_sesiones");                
    }

    public function add_usuario ($login, $password, $nombre, $idacl) {
        // Funcion para añadir un usuario
        // Aqui hay que poner las variables que se le pasan y que es cada una
        // Recuerda, en el modelo, comprobar que los datos que te meten
        // en los parametros estan correctos, por seguridad
        // $login    --> Login de entrada del usuario
        // $password --> Password, md5
        // $nombre   --> Nombre del usuario
        // $idacl    --> Identificador de la ACL. 1-Administrador, 2-Usuario, 3-Desactivado

        $sql = "INSERT INTO usuarios (login, password, nombre, idacl) VALUES ('" . $login . "', '" . $password . "', '" . $nombre . "', '" . $idacl . "')";
        $resultado = $this -> db -> query($sql);
        // Recuperamos el ID del usuario
        $sql="SELECT login FROM usuarios WHERE password='".$password."' AND nombre='".$nombre."'  AND idacl='".$idacl."'";
      	$resultado = $this -> db -> query($sql);
      	foreach ($resultado->result() as $row) {
                 $login = $row -> login;
      	}
      	return $login;
    }

    public function update_usuario ($login, $password, $nombre, $idacl) {
        // Funcion para modificar un usuario
        // $login    --> Login de entrada del usuario que se quiere modificar
        // $password --> Password, md5
        // $nombre   --> Nombre del usuario
        // $idacl    --> Identificador de la ACL. 1-Administrador, 2-Usuario, 3-Desactivado

        $sql = "UPDATE usuarios SET password='" . $password . "', nombre='" . $nombre . "', idacl='". $idacl."' WHERE login='" . $login."'";
        $resultado = $this -> db -> query($sql);
    }

    public function del_usuario ($login) {
        // Funcion para eliminar un usuario
        // $login    --> Login de entrada del usuario que se va a eliminar
        // Primero borramos las actividades y por lo tanto, primero las imagenes y los documentos de las actividades

        // Borramos las imagenes
        // No la borramos del HD por si acaso

        $sql = "SELECT idactividades FROM actividades WHERE usuario='" . $login."'";
        $resultado = $this -> db -> query($sql);
        foreach ($resultado->result() as $row) {
            $sql_borra_imagen = "DELETE FROM imagenes WHERE idactividad ='" . $row->idactividades."'";
            $resultado_borrado = $this -> db -> query($sql_borra_imagen);
        }

        // Borramos los documentos
        // No la borramos del HD por si acaso
        $sql = "SELECT idactividades FROM actividades WHERE usuario='" . $login."'";
        $resultado = $this -> db -> query($sql);
        foreach ($resultado->result() as $row) {
            $sql_borra_documento = "DELETE FROM documentos WHERE idactividad ='" . $row->idactividades."'";
            $resultado_borrado = $this -> db -> query($sql_borra_documento);
        }


        // Ahora borramos las actividades
        $sql = "DELETE FROM actividades WHERE usuario='" . $login."'";
        $resultado = $this -> db -> query($sql);

        // Y por ultimo el usuario
        $sql = "DELETE FROM usuarios WHERE login='" . $login."'";
        $resultado = $this -> db -> query($sql);
    }
    
    public function checkusuario($login, $password){       
        // Revisa dentro de la base de datos si existe el usuario y si esta habilitado
        // $login --> login del usuario que se va a chequear
        // $password --> password del usuario que se va a chequear
        // Devuelve:
        // 0 - no existe usuario y password
        // 1 - existe y es correcto
        // 2 - existe y deshabilitado
         
        $chek=0;
        $sql = "SELECT login, password, nombre, idacl FROM usuarios WHERE login='" . $login."' AND password='".$password."'";
        $resultado = $this -> db -> query($sql);
        
        foreach ($resultado->result() as $row) {
                $chek=1;
                $login = $row -> login;
                $nombre = $row -> nombre;
                $idacl = $row -> idacl;
                $pass = $row -> password;

                if ($idacl==2){
                   // Si idacl=2 El usuario está deshabilitado
                   $chek=2;
                }            
      	}
        if ($chek==1) {            
            // Registamos al usuario 
            // Con la libreria-sesiones             
            $this -> libreria_sesiones -> registrar(TRUE, $login);
            $this -> libreria_sesiones -> mete_datos_sesion($login, TRUE, $login, $nombre, $idacl);             
        }
        return $chek; // 0, 1, 2
    }
    
  } 
  
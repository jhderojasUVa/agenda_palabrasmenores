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
        // $this -> load -> library("libreria_sesiones");        
        // revisa dentro de la base de datos si existe el usuario
         
        $chek=0;
        $sql = "SELECT login, password, nombre, idacl FROM usuarios WHERE login='" . $login."' AND password='".$password."'";
        $resultado = $this -> db -> query($sql);
        
        foreach ($resultado->result() as $row) {
                $chek=1;
                 $login = $row -> login;
                 $nombre = $row -> nombre;
                 $idacl = $row -> idacl;                  
                 
                 // Si idacl=2 El usuario está deshabilitado
                 if ($idacl==2){
                    $chek=2;
                 }
      	}
        if ($chek==1) {
            /*
            if ($this ->session -> registrado == TRUE) {
                
            $this -> session -> unset_userdata("registrado");
            $this -> session -> unset_userdata("idusuario");
            }
             * */
          
            // Registamos al usuario
            // Sin llamara la libreria-sesiones
          
            //$this -> load -> library("session");
             //esto es lo que haria registrar
            /*
            $this -> session -> registrado = TRUE;
            $this -> session -> idusuario = $login;
            // Esto es lo que haria mete_datos_sesion
            $this -> session -> idlogin = $login;
            $this -> session -> registrado = TRUE;
            $this -> session -> login = $login;
            $this -> session -> nombre = $nombre;
            $this -> session -> acl = $idacl;
             * */
             print ("valor sesion en modelo_usuario<p></p>");   
             print_r ($this -> session);
             
// Con la libreria-sesiones             
            $this -> libreria_sesiones -> registrar(TRUE, $login,$this -> session);
            //$this -> libreria_sesiones -> mete_datos_sesion($login, TRUE, $login, $nombre, $idacl);
              
         
        
             
        }
        return $chek;
    }
    
  } 

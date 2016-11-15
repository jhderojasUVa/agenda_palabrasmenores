<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Controlador principal para la trastienda
  *   el login y datos de usuario

  *  tambien vale para modificar los datos del usuario
	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();

		 // Cargamos los modelos
		 /* No hace falta puesto que lo hemos puesto en el autoload
		 $this -> load -> model("modelo_actividades");
		 $this -> load -> model("modelo_barrios");
		 $this -> load -> model("modelo_imagenes");
		 $this -> load -> model("modelo_documentos");
		 */
	 }

   public function index() {
       $desconectar = $this -> input -> post("desconectar");
       $this -> load -> library ("libreria_sesiones");
       
      if ($desconectar){          
          //destruyendo la sesion sigue quedando las $this->session
           $this -> session -> unset_userdata("registrado");
           $this -> session -> unset_userdata("idusuario");
           $this -> session -> sess_destroy();
           print $this -> session -> idusuario;
       }
        
     // Controlador de entrada       
//?? Se podría solo con registrado, sin $fallo o está para poner todos los mensajes de error en la misma zona
	$registrado = 0;
	$fallo = 0;
	$pa_la_vista = array();
     // Comprobamos si ha recibido algo por POST o si tiene algo en la session de usuario
	if ($desconectar){
            $usuario="";
            $password="";
        }else{
            $usuario = $this -> input -> post("usuario");
            $password = $this -> input -> post("password");
        }

            // Para saber mas sobre como se usan las sessiones
            // http://www.codeigniter.com/user_guide/libraries/sessions.html
        //print "usuario= ".$usuario;
        //print"<p></p> ";
        //print "sesion de usuario login".($this -> session -> nombre);
	 
        if ($this -> session -> idusuario) {
            // Comprobarlo con la sesion
            $registrado = 1;
            $nombre = $this -> session -> nombre;
	} elseif ($usuario !="" && $password !="") {
            // Comprobamos los datos del post contra el modelo de usuarios
            // Este modelo ha de llamar a la libreria de las sesiones y almacenar el nombre del usuario
            // y de paso devolver 1 si esta ok y 0 si no y 2 si está inhabilitado
            $registrado = $this -> modelo_usuarios -> checkusuario($usuario, $password);
           
            if ($registrado==0){
                $fallo = 1;
                $pa_la_vista=array(
                    "error" => "Usuario o contraseña mal"
                );
            } elseif ($registrado==2) {
                //Si registrado es  el usuario está deshabilitado
//?? Si el mensaje de error se pone aquí $fallo podría Ser $fallo=1              
                $fallo=2;
                $pa_la_vista=array(
                    "error" => "Usuario inhabilitado"
		);
            }              
	}
 //?? Si pongo tdos los mensajes de error en la misma zona      
        /*
	if ($fallo !=0) {
            if ($fallo==2){
                // está inhabilitado
		$pa_la_vista=array(
                    "error" => "Usuario inhabilitado"
		);
            }else {               
	   	// el tio ha puesto mal algo
		$pa_la_vista=array(
                    "error" => "Usuario o contraseña mal"
		);
            }   
	}
        * */
          

     // Si es correcto
	// fallo = 0 & registrado = 1
	if ($registrado==1 && $fallo ==0) {
            // En principio no deberiamos hacer nada, salvo redirigirle al sitio correcto
            // $this -> load -> view("admin/principal");
            
            $pa_la_vista=array(
                    "nombre" => $this -> session -> nombre
		);
            $this -> load -> view("admin/desconectar",$pa_la_vista);
	} else {
        // Si no es correcto
	// fallo = 1
        // Recordar recoger los errores y se los enviamos a la vista tambien
            $this -> load -> view ("admin/index", $pa_la_vista);
        }
   }

   public function ver_mis_datos() {
     // Controlador de ver los datos del usuario

     // Comprobamos las ACLs en la sesion

     // Revisamos la session para sacar el usuario
     // Enviamos a la vista los datos
     // Recordar recoger los errores y se los enviamos a la vista tambien
     $this -> load -> vire ("admin/ver_mis_datos");
   }

   public function modificar_mis_datos() {
     // Controlador para modificar los datos que el usuario puede modificar, obviamente

     // Comprobamos las ACLs en la sesion

     // Sacamos los datos del pollo del modelo

     // Vemos si ha modificado o o no, para elllo controlamos el post

     // Si ha modificado llamamos al modelo y cambiamos las connection_status

     // Si no ha modificado, llamamos a la vista

      // Recordar recoger los errores y se los enviamos a la vista tambien
     $this -> load -> view ("admin/modificar_mis_datos");
   }

   public function add_usuario() {
     // Controlador para los super admin de creacion de usuarios

     // Comprobamos los ACLs en la sesion

     // Vemos si ha mandado datos por POST o no

     // Si se ha enviado llamamos al modelo y añadimos al usuario

     // Sino mostramos la vista

     // Envie o no datos, sacamos la lista de usuarios para enviarsela al modelo

      // Recordar recoger los errores y se los enviamos a la vista tambien
     $this -> load -> view ("admin/add_usuario");
   }

   public function del_usuario() {
     // Controlador para borrar usuarios

     // Comprobamos los ACLs en la sesion

     // Vemos si envia datos en el POST

     // Si ha enviado, borramos

     // Si no ha enviado, sacamos la lista

     // Envie o no sacamos la lista de usuarios por el modelo

      // Recordar recoger los errores y se los enviamos a la vista tambien
     $this -> load -> view ("admin/del_usuario");
   }
 }

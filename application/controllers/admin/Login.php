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
		 $this -> load -> model("modelo_actividades");
		 $this -> load -> model("modelo_barrios");
		 $this -> load -> model("modelo_imagenes");
		 $this -> load -> model("modelo_documentos");
	 }

   public function index() {
     // Controlador de entrada

     // Comprobamos si ha recibido algo por POST o si tiene algo en la session de usuario

     // Comprobamos los datos del post contra el modelo de usuarios

     // Si es correcto

     // Si no es correcto

      // Recordar recoger los errores y se los enviamos a la vista tambien
     $this -> load -> view ("admin/index");
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

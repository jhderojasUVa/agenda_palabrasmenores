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
	 }

    public function index() {
        // Controlador de entrada
	$registrado = 0;
	$fallo = 0;
	$pa_la_vista = array();

        // Comprobamos si ha recibido algo por POST o si tiene algo en la session de usuario
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // El usuario esta registrado hay que mandarle a la vista definitiva
            // indicamos que esta registrado y llenamos un array con los datos de el
            $registrado = 1;
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
        } else {
            $usuario = $this -> input -> POST("usuario");
            $password = $this -> input -> POST("password");
	}
	// Para saber mas sobre como se usan las sessiones
	// http://www.codeigniter.com/user_guide/libraries/sessions.html

        // Comprueba si ha enviado el formulario
        if (isset($usuario) && isset($password) && $registrado == 0){
            if ($usuario == "" || $password == "") {
		// Si el pollopera no ha enviado nada, le abroncamo
		$fallo = 1;
		$pa_la_vista = array(
                    "error" => "Usuario o contraseña mal"
		);
            } else {
                // Si ha enviado algo lo comprobamos
                // recordamos que fallo viene valiendo 0 de antes
                $registrado = $this -> modelo_usuarios -> checkusuario($usuario, $password);

		if ($registrado!=1) {
                    // Comprobamos si esta registrado y sino, a la mierda con el
                    $fallo = 1;
                    $pa_la_vista = array(
			"error" => "Usuario o contraseña mal"
                    );
                }
            }
        }
        // Si es correcto
	// fallo = 0 & registrado = 1
	if ($registrado == 1 && $fallo == 0) {
            // Carga las actividades del usuario.
            $pa_la_vista = array();
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            // Actividades de usuario por fecha descencente
            $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
            $pa_la_vista['usuario'] = $datos_usuario;
            $pa_la_vista['actividades'] = $actividades;

            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu",$datos_usuario);     
            $this -> load -> view ("admin/actividades/principal", $pa_la_vista);
            $this -> load -> view ("admin/footer");
	} else {
            // Si no es correcto
            // fallo = 1
            // Recordar recoger los errores y se los enviamos a la vista tambien
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index", $pa_la_vista);
            $this -> load -> view ("admin/footer");
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

// ??? CREO QUE QUITAR, PORQUE ESTA EN Usuarios
// El usuario no va a poder cambiar nada   
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
   
    public function salir() {
        // Controlador para salir de la sesion
        $pa_la_vista = array();
//OJO ?? Si hay que poner algún mensaje cuando se desconecta         
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // El usuario esta registrado y lo desregistramos
            $this -> libreria_sesiones -> des_registrar();
        }
        
        // Lo enviamos a la vista index
        $this -> load -> view ("admin/header");
        $this -> load -> view ("admin/index", $pa_la_vista);
        $this -> load -> view ("admin/footer");
    }

 }

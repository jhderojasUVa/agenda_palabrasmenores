<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	/**
	 * Controlador para los usuarios
     Y sus acciones

	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();
	 }
    
    public function add_usuario() {
        // Controlador para los super admin de creacion de usuarios

        // Recordar recoger los errores y se los enviamos a la vista tambien
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $num_error=0;
            $pa_la_vista['error'] = array ();
            $pa_la_vista['error'][$num_error] = "";
            $pa_la_vista['actualizado'] = 0;
            // numero de usuarios que va a mostrar
            $num_usuarios = 5;
            $pa_la_vista_usuarios['cabecera'] = false;
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            // Comprobamos los ACLs en la sesion
            // Vemos si ha mandado datos por POST o no
            if ($this -> input -> POST("add")==1) {
                $login = $this -> input -> POST("login");
                $password = $this -> input -> POST("password");
                $rpassword = $this -> input -> POST("rpassword");
                $nombre = $this -> input -> POST("nombre");
                $idacl = $this -> input -> POST("idacl");
                // Comprueba si existe el usuario
                if ($this -> modelo_usuarios -> usuario_id($login)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El usuario ya existe";
                    $num_error ++;
                } else {
                    // Si el usuario no existe
                    // Comprobar los campos                
                    if (!$this -> esta_vacio($login)) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "El login no puede estar vacío";    
                        $num_error ++;
                    }
                    if (!$this -> esta_vacio($password)) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "La contraseña no puede estar vacía";    
                        $num_error ++;
                    }
                    if (!$this -> esta_vacio($rpassword)) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "Repetir contraseña no puede estar vacío";    
                        $num_error ++;
                    }
                    if (!$this -> esta_vacio($nombre)) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "El nombre no puede estar vacío";    
                        $num_error ++;
                    }
                    if (!$this -> esta_vacio($idacl)) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "El tipo no puede estar vacío";    
                        $num_error ++;
                    }
                    // Comprobar que contraseña y repetir contraseña sean iguales
                    if ($password != $rpassword) {
                        $fallo = 1;
                        $pa_la_vista['error'][$num_error] = "No coincide contraseña y repetir contraseña";    
                        $num_error ++;
                    }
                }
                if ( $fallo == 0) {
                    // Si se ha enviado llamamos al modelo y añadimos al usuario
                    $this -> modelo_usuarios -> add_usuario($login, $password, $nombre, $idacl);
                    // Mostramos los ultimos 5 usuarios por login
                    $numero = 5;
                    $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($num_usuarios); 
                    $pa_la_vista['cabecera'] = true;
                    $pa_la_vista['actualizado'] = 1;
                    $pa_la_vista['usuario'] = $datos_usuario;                
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu",$datos_usuario);
                    $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista);
                    $this -> load -> view ("admin/footer");
                }
            }   
            if ($this -> input -> POST("add")!=1 || $fallo == 1) {
                if ($fallo == 1) {
                    $pa_la_vista['usuarios'] =array(
                        'login' => $login,    
                        'password' => $password, // ver si no paso
                        'rpassword' => $rpassword, // ver si no paso
                        'nombre' => $nombre,
                        'idacl' => $idacl
                    );                    
                } else {
                   $pa_la_vista['usuarios'] =array(
                        'login' => "",    
                        'password' => "",
                        'rpassword' => "",
                        'nombre' => "",
                        'idacl' => ""
                    );                     
                }
                // Mostramos los ultimos 5 usuarios por login
                $pa_la_vista_usuarios['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($num_usuarios); 
                
                // Enviamos a la vista para meter los datos del usuario
                // Y enviamos a la vista para mostrar los 5 ultimos usuarios
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/usuarios/add_usuario",$pa_la_vista);
                $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista_usuarios);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function modifica_usuario() {
        // Controlador para los super admin de modificacion de usuarios

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Inicializamos
            $fallo = 0;
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario que hace la modificacion
            $pa_la_vista['usuario'] = array();
            // Datos del usuario que se va a modificar
            $pa_la_vista['usuarios'] = array();
            // Numero de usuarios que va a mostrar
            $num_usuarios = 5;
            $pa_la_vista_usuarios['cabecera'] = false;
            // errores
            $num_error=0;
            $pa_la_vista['error'] = array ();
            $pa_la_vista['error'][$num_error] = "";
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            $pa_la_vista['usuario'] = $datos_usuario;           
            // Revisamos si tenemos el id de usuario (por get o por post o por hidden, da igual)
            $login = $this -> input -> post_get('login');            
            if (!$login){
                $fallo = 2;
                $pa_la_vista['error'][$num_error] = "No hay usuario";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos del usuario del POST
                $password = $this -> input -> POST("password");
                $rpassword = $this -> input -> POST("rpassword");
                $nombre = $this -> input -> POST("nombre");
                $idacl = $this -> input -> POST("idacl");
                // Comprobar los campos                
                if (!$this -> esta_vacio($nombre)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El nombre no puede estar vacío";    
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idacl)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El tipo no puede estar vacío";    
                    $num_error ++;
                }
                // Comprobar que contraseña y repetir contraseña sean iguales
                if ($password!="" && $password != $rpassword) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "No coincide contraseña y repetir contraseña";    
                    $num_error ++;
                }
                if ($fallo == 0){
                    // update
                    $this -> modelo_usuarios -> update_usuario($login, $password, $nombre, $idacl);
                    $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                    // Conseguimos los datos por el modelo para enviarlos a la vista principal
                    // Buscamos al usuario
                    $datos_busqueda =  array(
                        $this -> input -> POST("login"),
                        $this -> input -> POST("nombre")
                    );
                    $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> buscar_usuario($datos_busqueda);
                    $pa_la_vista ['cabecera'] = true;
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu",$datos_usuario);
                    $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista);
                    $this -> load -> view ("admin/footer");
                }
            } 
            if ($this -> input -> POST("modificar")!=1 || $fallo == 1){
                // Conseguimos los datos por el modelo
 //OJO ??       // Si es la primera vez los datos del modelo
                if ($fallo == 0) {
                    $usuarios = $this -> modelo_usuarios -> usuario_id($login);
                    foreach ($usuarios as $fila) {
                        $pa_la_vista['usuarios'] = $fila;  
                    }
                } else {
                // Si es por un fallo recupera los valores que ha metido antes
                    $pa_la_vista['usuarios'] = array(
                        'login' => $login,
                        // No paso passsword y rpassword, que las vuelva a escribir    
                        'password' => "",
                        'rpassword' => "",
                        'nombre' => $nombre,
                        'idacl' => $idacl
                    ); 
                }
                // Mostramos los ultimos 5 usuarios por login
                $pa_la_vista_usuarios['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($num_usuarios); 
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_usuario modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/usuarios/modificar_usuario",$pa_la_vista);
                $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista_usuarios);
                $this -> load -> view ("admin/footer");            
            } else if ($fallo == 2 ){
                // Es porque no existe el usuario
                // Mostramos los ultimos 5 usuarios por login
                $pa_la_vista_usuarios['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($num_usuarios); 
                // Se lo enviamos a las vistas
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista_usuarios);
                $this -> load -> view ("admin/footer"); 
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }
    
    public function buscar_usuario() {
        // Buscaremos los usuarios a traves un formulario

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Inicializamos
            $pa_la_vista = array();
            // La siguiente linea de momento dejo, por si errores de respuesta
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            $pa_la_vista['usuario'] = $datos_usuario;

            // Tipo de busqueda formulario
            if ($this -> input -> POST("tipo_busqueda") == 2){
                // Comprueba si no ha metido nada en login y nombre
                // Hace una busqueda por OR con texto vacio
                // Para que devuelva todos los usuarios
                if ($this -> input -> POST("login") == "" AND $this -> input -> POST("nombre") ==""){
                    $texto="";
                    // Llamamos al modelo que busca por los campos OR 
                    $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> buscar_cajetin($texto);                    
                } else {
                    $datos_busqueda =  array(
                        $this -> input -> POST("login"),
                        $this -> input -> POST("nombre")
                    );
                    // Llamamos al modelo que busca por los campos AND
                    $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> buscar_usuario($datos_busqueda);
                }
                $pa_la_vista ['cabecera'] = true;
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/usuarios/buscar_usuario", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/usuarios/formbuscar_usuario",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }    
    
    private function esta_vacio($cadena) {
        // Funcion que comprueba si esta vacio
        // $cadena --> Campo que va a comprobar
        
        if ($cadena!="") {
            return true; // NO esta vacio
        } else {
            return false; // SI esta vacio
        }    
    }
    
}

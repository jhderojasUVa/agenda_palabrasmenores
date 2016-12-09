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
            $pa_la_vista = array();
            $pa_la_vista['actualizado'] = 0;
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
// OJO COMPROBAR QUE LAS CONTRASEÑA Y REPETIR CONTRASEÑA COINCIDAN                
                // Si se ha enviado llamamos al modelo y añadimos al usuario
                $this -> modelo_usuarios -> add_usuario($login, $password, $nombre, $idacl);
                // Mostramos los ultimos 5 usuarios por login
                $numero = 5;
                $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($numero); 
                $pa_la_vista['cabecera'] = true;
                $pa_la_vista['actualizado'] = 1;
                $pa_la_vista['usuario'] = $datos_usuario;                
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Mostramos los ultimos 5 usuarios por login
                $numero = 5;
                $pa_la_vista_usuarios['usuarios'] = $this -> modelo_usuarios -> ultimos_usuarios($numero); 
                $pa_la_vista_usuarios['cabecera'] = false;                
                // Enviamos a la vista para meter los datos del usuario
                // Y enviamos a la vista para mostrar los 5 ultimos usuarios
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
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
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario que hace la modificacion
            $pa_la_vista['usuario'] = array();
            // Datos del usuario que se va a modificar
            $pa_la_vista['usuarios'] = array();
            // Revisamos si tenemos el id de usuario (por get o por post o por hidden, da igual)
            $login = $this -> input -> post_get('login');            
            if ($login){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay usuario";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos del usuario del POST
                $password = $this -> input -> POST("password");
                $rpassword = $this -> input -> POST("rpassword");
                $nombre = $this -> input -> POST("nombre");
                $idacl = $this -> input -> POST("idacl");
// OJO COMPROBAR QUE LAS CONTRASEÑA Y REPETIR CONTRASEÑA COINCIDAN si las cambia
// OJO EL LOGIN EN PRINCIPIO NO DEBERIA DEJAR,
// OJO PORQUE SERIA BORRAR Y CREAR UNO NUEVO
// COMPROBAR SI TIENE ALGO EN LA CONTRASEÑA, ENTONCES SE HA MODIFICADO
// SI NO TIENE NADA SE DEJA LA CONTRASEÑA DE ANTES
// AHORA SI NO VIENE NADA LO DEJA EN BLANCO
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
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/usuarios/buscar_usuario",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else if ($fallo==0) {
                // Conseguimos los datos por el modelo
                $pa_la_vista['usuarios'] = $this -> modelo_usuarios -> usuario_id($login);
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_usuario modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/usuarios/modificar_usuario",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Si hay algún error
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/usuarios/modificar_usuario",$pa_la_vista);
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
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/usuarios/buscar_usuario", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
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

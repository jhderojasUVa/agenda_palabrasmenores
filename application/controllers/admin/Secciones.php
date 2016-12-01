<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secciones extends CI_Controller {

	/**
	 * Controlador para las secciones
     Y sus acciones

	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();
	 }
    
    public function add_seccion() {
        // Controlador para los super admin de creacion de secciones
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
                $nombre = $this -> input -> POST("nombre");              
                // Si se ha enviado llamamos al modelo y añadimos la seccion
                $this -> modelo_secciones -> add_seccion($nombre);
                $pa_la_vista['actualizado'] = 1; 
            }
            // Sino mostramos la vista

            // Envie o no datos, sacamos la lista de secciones para enviarsela al modelo
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu");
            $this -> load -> view ("admin/secciones/add_seccion",$pa_la_vista);
            $this -> load -> view ("admin/footer");
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function modifica_seccion($idsecciones) {
        // Controlador para los super admin de modificacion de secciones
        // $idsecciones --> Id de la seccion que se va a modificar

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario que hace la modificacion
            $pa_la_vista['usuario'] = array();
            // Datos de la seccion que se va a modificar
            $pa_la_vista['secciones'] = array();
            // Revisamos si tenemos el id de la seccion (por get o por post o por hidden, da igual)
            if ($idsecciones){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay seccion";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos del seccion del POST
                $idsecciones = $this -> input -> POST("idsecciones");
                $nombre = $this -> input -> POST("nombre");
                // update
                $this -> modelo_secciones -> update_seccion($idsecciones, $nombre);
                $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                // Conseguimos los datos por el modelo para enviarlos a la vista principal
                // Buscamos la seccion
                $datos_busqueda =  array(
                    $this -> input -> POST("nombre")
                );
                $pa_la_vista['secciones'] = $this -> modelo_secciones -> buscar_seccion($datos_busqueda);

                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/secciones/buscar_seccion",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else if ($fallo==0) {
                // Conseguimos los datos por el modelo
                $pa_la_vista['secciones'] = $this -> modelo_secciones -> seccion_id($idsecciones);
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_seccion modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/secciones/modificar_seccion",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Si hay algún error
// ?? ver si tiene que ir a modificar_seccion
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/secciones/modificar_seccion",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }
    
    public function buscar_seccion() {
        // Buscaremos las secciones a traves un formulario

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
                $datos_busqueda =  array(    
                    $this -> input -> POST("nombre")
                );
                // Llamamos al modelo que busca por los campos AND
                $pa_la_vista['secciones'] = $this -> modelo_secciones -> buscar_seccion($datos_busqueda);
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/secciones/buscar_seccion", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/secciones/formbuscar_seccion",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }    
 }

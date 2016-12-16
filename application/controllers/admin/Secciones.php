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
            $fallo = 0;
            $pa_la_vista['error'] = "";
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista_secciones['cabecera'] = false;
            // Numero de los ultimas secciones que va a mostrar
            $num_secciones = 5;            
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            // Comprobamos los ACLs en la sesion
            // Vemos si ha mandado datos por POST o no
            if ($this -> input -> POST("add")==1) {
                $nombre = $this -> input -> POST("nombre");
                // Comprueba si el nombre no está vacio
                if (!$this -> esta_vacio($nombre)) {
                    $fallo = 1;
                    $pa_la_vista['error'] = "El nombre no puede estar vacío";
		}
                if ($fallo == 0) {
                    // Si se ha enviado llamamos al modelo y añadimos la seccion
                    $this -> modelo_secciones -> add_seccion($nombre);
                    $pa_la_vista['actualizado'] = 1; // Lo dejo de momento, no se está utilizando
                    // Mostramos las últimas secciones
                    $pa_la_vista_secciones['secciones'] = $this -> modelo_secciones -> ultimas_secciones($num_secciones); 
                    $pa_la_vista_secciones['cabecera'] = true; 
                    $pa_la_vista_secciones['usuario'] = $datos_usuario;                     
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu",$datos_usuario);
                    $this -> load -> view ("admin/secciones/buscar_seccion",$pa_la_vista_secciones);
                    $this -> load -> view ("admin/footer"); 
                } 
            }
           // Si no viene de añadir o ha habido error al añadir
            if ($this -> input -> POST("add")!=1 || $fallo == 1) {            
                // Obtenemos las últimas secciones
                $pa_la_vista_secciones['secciones'] = $this -> modelo_secciones -> ultimas_secciones($num_secciones);
                // Enviamos a la vista para meter los datos de la seccion
                // Y enviamos a la vista para mostrar las 5 ultimas secciones
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/secciones/add_seccion",$pa_la_vista);
                $this -> load -> view ("admin/secciones/buscar_seccion",$pa_la_vista_secciones);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function modifica_seccion() {
        // Controlador para los super admin de modificacion de secciones

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            $pa_la_vista['error'] = "";
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario que hace la modificacion
            $pa_la_vista['usuario'] = array();
            // Datos de la seccion que se va a modificar
            $pa_la_vista['secciones'] = array();
            $pa_la_vista_secciones['cabecera'] = false;
            // Numero de los ultimas secciones que va a mostrar
            $num_secciones = 5;  
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            $pa_la_vista['usuario'] = $datos_usuario;
            // Revisamos si tenemos el id de la seccion (por get o por post o por hidden, da igual)
            $idsecciones = $this -> input -> post_get('idsecciones');
            if (!$idsecciones){
                $fallo = 1;
                $pa_la_vista['error'] = "No hay seccion";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos del seccion del POST
                $nombre = $this -> input -> POST("nombre");
                // Comprueba si el nombre no está vacio
                if (!$this -> esta_vacio($nombre)) {
                    $fallo = 1;
                    $pa_la_vista['error'] = "El nombre no puede estar vacío";
		}
                if ($fallo == 0){ 
                    // update
                    $this -> modelo_secciones -> update_seccion($idsecciones, $nombre);
                    $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                    // Conseguimos los datos por el modelo para enviarlos a la vista de buscar
                    // Buscamos la seccion    
                    $pa_la_vista['secciones'] = $this -> modelo_secciones -> buscar_cajetin($nombre);
                    $pa_la_vista ['cabecera'] = true;
                    // Enviamos a la vista
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu",$datos_usuario);
                    $this -> load -> view ("admin/secciones/buscar_seccion",$pa_la_vista);
                    $this -> load -> view ("admin/footer");
                }
            }   
            if ($this -> input -> POST("modificar")!=1 || $fallo == 1){
                // Conseguimos los datos por el modelo
                $pa_la_vista['secciones'] = $this -> modelo_secciones -> seccion_id($idsecciones);
                // Obenemos las ultimas secciones
                $pa_la_vista_secciones['secciones'] = $this -> modelo_secciones -> ultimas_secciones($num_secciones); 
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_seccion modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/secciones/modificar_seccion",$pa_la_vista);
                $this -> load -> view ("admin/secciones/buscar_seccion",$pa_la_vista_secciones);
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
        // En el formulario está metido un cajetin
        // Es como busqueda por OR, si no tiene nada en el nombre devuelve todas las secciones
        
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

            // Tipo de busqueda por cajetin
            if ($this -> input -> POST("tipo_busqueda") == 1){
                $texto = $this -> input -> POST("q");
                // Llamamos al modelo que busca por los campos OR
                $pa_la_vista['secciones'] = $this -> modelo_secciones -> buscar_cajetin($texto);;
                $pa_la_vista ['cabecera'] = true;
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/secciones/buscar_seccion", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
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

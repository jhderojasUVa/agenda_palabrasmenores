<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barrios extends CI_Controller {

	/**
	 * Controlador para los barrios
     Y sus acciones

	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();
	 }
    
    public function add_barrio() {
        // Controlador para los super admin de creacion de barrios

        // Recordar recoger los errores y se los enviamos a la vista tambien
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista['error'] = "";
            $pa_la_vista['actualizado'] = 0;
            // Numero de los ultimos barrios que va a mostrar
            $num_barrios = 5;
            $pa_la_vista_barrios['cabecera'] = false;
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
                    // Si se ha enviado llamamos al modelo y añadimos al barrio
                    $this -> modelo_barrios -> add_barrio($nombre);
                    $pa_la_vista['actualizado'] = 1; // Lo dejo de momento, no se está utilizando
                    // Mostramos los últimos barrios
                    $pa_la_vista_barrios['barrios'] = $this -> modelo_barrios -> ultimos_barrios($num_barrios); 
                    $pa_la_vista_barrios['cabecera'] = true;
                    $pa_la_vista_barrios['usuario'] = $datos_usuario;               
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu");
                    $this -> load -> view ("admin/barrios/buscar_barrio",$pa_la_vista_barrios);
                    $this -> load -> view ("admin/footer");                    
                } else {
                    // Obtenemos los últimos barrios
                    $pa_la_vista_barrios['barrios'] = $this -> modelo_barrios -> ultimos_barrios($num_barrios); 
                    // Enviamos a la vista para meter los datos del barrio
                    // Y enviamos a la vista para mostrar los ultimos barrios
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu");
                    $this -> load -> view ("admin/barrios/add_barrio",$pa_la_vista);
                    $this -> load -> view ("admin/barrios/buscar_barrio",$pa_la_vista_barrios);
                    $this -> load -> view ("admin/footer");                    
                }
            } else {
                // Obtenemos los últimos barrios
                $pa_la_vista_barrios['barrios'] = $this -> modelo_barrios -> ultimos_barrios($num_barrios); 
                // Enviamos a la vista para meter los datos del barrio
                // Y enviamos a la vista para mostrar los ultimos barrios
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/add_barrio",$pa_la_vista);
                $this -> load -> view ("admin/barrios/buscar_barrio",$pa_la_vista_barrios);
                $this -> load -> view ("admin/footer");
            }
        } else {
            // Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function modifica_barrio() {
        // Controlador para los super admin de modificacion de barrios

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario que hace la modificacion
            $pa_la_vista['usuario'] = array();
            // Datos del barrio que se va a modificar
            $pa_la_vista['barrios'] = array();
            // Revisamos si tenemos el id de barrio (por get o por post o por hidden, da igual)
            $idbarrios = $this -> input -> post_get('idbarrios');
            if ($idbarrios){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay barrio";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos del barrio del POST
                $nombre = $this -> input -> POST("nombre");
                // update
                $this -> modelo_barrios -> update_barrio($idbarrios, $nombre);
                $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                // Conseguimos los datos por el modelo para enviarlos a la vista de buscar
                // Buscamos al barrio
                $pa_la_vista['barrios'] = $this -> modelo_barrios -> buscar_cajetin($nombre);
                $pa_la_vista ['cabecera'] = true;
                // Enviamos a la vista    
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/buscar_barrio",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else if ($fallo==0) {
                // Conseguimos los datos por el modelo
                $pa_la_vista['barrios'] = $this -> modelo_barrios -> barrio_id($idbarrios);
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_barrio modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/modificar_barrio",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Si hay algún error
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/modificar_barrio",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }
    
    public function buscar_barrio() {
        // Buscaremos los barrios a traves un formulario
        // En el formulario está metido un cajetin
        // Es como busqueda por OR, si no tiene nada en el nombre devuelve todos los barrios

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
                $pa_la_vista['barrios'] = $this -> modelo_barrios -> buscar_cajetin($texto);
                $pa_la_vista['cabecera'] = true;
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/buscar_barrio", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/barrios/formbuscar_barrio",$pa_la_vista);
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

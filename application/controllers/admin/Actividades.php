<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

	/**
	 * Controlador para las cosas de las actividades

  *  tambien vale para modificar los datos del usuario
	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();
	 }

    public function add_actividad() {
        // Controlador para todos los usuarios de creacion de una actividad

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Retornar la ACL del usuario
            $acl = $this -> session -> acl;
            // Inicializamos
            $pa_la_vista = array();
            // Inicializamos los fallos
            $fallo = 0;
            $num_error=0;
            $pa_la_vista['error'][$num_error] = "";
            $pa_la_vista['actualizado'] = 0;
            // Obtiene todos los barrios
            $pa_la_vista['barrios'] = $this -> modelo_barrios -> devuelve_barrios();
            // Obtiene todos las secciones
            $pa_la_vista['secciones'] = $this -> modelo_secciones -> devuelve_secciones();
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            // Vemos si ha mandado datos por POST o no
            if ($this -> input -> POST("add")==1) {
                $campanya = $this -> input -> POST("campanya");
                $actividad = $this -> input -> POST("actividad");
                $descripcion = $this -> input -> POST("descripcion");
                $organiza = $this -> input -> POST("organiza");
                $lugar = $this -> input -> POST("lugar");
                $idbarrio = $this -> input -> POST("idbarrio");
                $idseccion = $this -> input -> POST("idseccion");
                $fecha = $this -> input -> POST("fecha");
                $hora = $this -> input -> POST("hora");
		// A recordar:
		// Sumo Pontifice = 1
		// Redactor = 2
		// Editor = 3
		// Disabled = 0
		if ($acl != 1 && $acl != 2) {
                    $publicada = 0;
		} else {
                    $publicada = 1;
		} 
                // Comprobar los campos                
                if (!$this -> esta_vacio($actividad)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La actividad no puede estar vacía";    
                    $num_error ++;
                }
                if (!$this -> esta_vacio($lugar)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El lugar no puede estar vacío";    
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idbarrio)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El barrio no puede estar vacío";    
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idseccion)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La sección no puede estar vacía";    
                    $num_error ++;
                }
                if (!$this -> esta_vacio($fecha)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La fecha no puede estar vacía";    
                    $num_error ++;
                }
                if ($fallo == 0) {
                    // Si se ha enviado llamamos al modelo y añadimos la actividad
                    $idactividades = $this -> modelo_actividades -> add_actividad($campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fecha,$idusuario,$publicada);
                    $pa_la_vista['actualizado'] = 1;
                }
            } 
            if ($fallo == 1) {
                $pa_la_vista['actividades'] = array (
                    'campanya' => $campanya,
                    'actividad' => $actividad,
                    'descripcion' => $descripcion, 
                    'organiza' => $organiza,
                    'lugar' => $lugar,
                    'idbarrio' => $idbarrio,
                    'idseccion' => $idseccion,
                    'fecha' => $fecha,
                    'hora' => $hora,                     
                );
            }  else {
                $pa_la_vista['actividades'] = array (
                        'campanya' => "",
                        'actividad' => "",
                        'descripcion' => "", 
                        'organiza' => "",
                        'lugar' => "",
                        'idbarrio' => "",
                        'idseccion' => "",
                        'fecha' => "",
                        'hora' => "",                     
                );                
            }

            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu", $acl);
            $this -> load -> view ("admin/actividades/add_actividad",$pa_la_vista);
            $this -> load -> view ("admin/footer");
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }

    public function modifica_actividad() {
        // Controlador para todos los usuarios para modificar una actividad

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista['usuario'] = array();
            $pa_la_vista['actividades'] = array();
            // Obtiene todos los barrios
            $pa_la_vista['barrios'] = $this -> modelo_barrios -> devuelve_barrios();
            // Obtiene todos las secciones
            $pa_la_vista['secciones'] = $this -> modelo_secciones -> devuelve_secciones();
            // Revisamos si tenemos el id de actividad (por get o por post o por hidden, da igual)
            $idactividades = $this -> input -> post_get("idactividades");            
            if ($idactividades){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay actividad";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos de la actividad del POST
                $campanya = $this -> input -> POST("campanya");

                if (!$this -> esta_vacio($campanya)) {
                    $error = 1;
		}		
                $actividad = $this -> input -> POST("actividad");
                $descripcion = $this -> input -> POST("descripcion");
                $organiza = $this -> input -> POST("organiza");
                $lugar = $this -> input -> POST("lugar");
                $idbarrio = $this -> input -> POST("idbarrio");
                $idseccion = $this -> input -> POST("idseccion");
                $fecha = $this -> input -> POST("fecha");
                $hora = $this -> input -> POST("hora");
                $publicada = $this -> input -> POST("publicada");
                // update
                $this -> modelo_actividades -> update_actividad($idactividades,$campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fecha,$idusuario,$publicada);
                $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                // Conseguimos los datos por el modelo para enviarlos a la vista principal
                // Actividades de usuario por fecha descencente
                $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
                $pa_la_vista['actividades'] = $actividades;
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/principal",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else if ($fallo==0) {
                // Conseguimos los datos por el modelo
                $pa_la_vista['actividades'] = $this -> modelo_actividades -> actividad_id($idactividades);
                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_actividad modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/modificar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Si hay algún error
                // ?? ver si tiene que ir a modificar_actividad o principal
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/modificar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }

    public function buscar_actividad() {
        // Buscaremos las actividades a traves de un texto en el menu o por un formulario
        // tipo_busqueda --> 1 si busca por un texto en el cajetin del menu
        // tipo_busqueda --> 2 si busca desde un formulario

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
            // Recogemos la query del formulario (del menu), del q
            if ($this -> input -> POST("tipo_busqueda") == 1){
                $texto = $this -> input -> POST("q");
                // Llamamos al modelo que busca por la query (q) en ambos campos con un OR
                $pa_la_vista['actividades'] = $this -> modelo_actividades -> buscar_cajetin($texto);

                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/buscar_actividad", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            // Tipo de busqueda formulario
            } else if ($this -> input -> POST("tipo_busqueda") == 2){
                $datos_busqueda =  array(
                    $this -> input -> POST("campanya"),
                    $this -> input -> POST("actividad"),
                    $this -> input -> POST("organiza"),
                    $this -> input -> POST("fecha")." ".$this -> input -> POST("hora")
                );
                // Llamamos al modelo que busca por los campos AND
                $pa_la_vista['actividades'] = $this -> modelo_actividades -> buscar_actividad($datos_busqueda);
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/buscar_actividad", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu");
                $this -> load -> view ("admin/actividades/formbuscar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function publicar() {
        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista['usuario'] = array();
            $pa_la_vista['actividades'] = array();
            // Revisamos si tenemos el id de actividad
            $idactividades = $this -> input -> post_get("idactividades");
            if ($idactividades){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
                // Conseguimos los datos de la actividad por el modelo
                $actividad = $this -> modelo_actividades -> actividad_id($idactividades);
                $publicada = 0; // inicializar a despublicada
                foreach ($actividad as $fila) {
                    // Si está despublicada publica
                    if ($fila['publicada']==0) $publicada = 1;
                }
                // PUBLIQUE la actividad
                $this -> modelo_actividades -> publicar_actividad($idactividades, $publicada);
                $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay actividad";
            }
            // Conseguimos los datos por el modelo para enviarlos a la vista principal
            // Actividades de usuario por fecha descencente
// ?? En principio lo paso a la vista principal de actividades
// ?? Pero puede venir de buscar_actividad            
            $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
            $pa_la_vista['actividades'] = $actividades;
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu");
            $this -> load -> view ("admin/actividades/principal",$pa_la_vista);
            $this -> load -> view ("admin/footer");
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

    private function fecha_completa($diamesano, $hora) {
	// Funcion que devuelve la fecha completa

	return $diamesano." ".$hora;
    }

 }

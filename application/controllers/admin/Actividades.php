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
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
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
                $publicada = 0;
                // Si se ha enviado llamamos al modelo y añadimos la actividad
                $idactividades = $this -> modelo_actividades -> add_actividad($campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fecha,$idusuario,$publicada);
                $pa_la_vista['actualizado'] = 1;
            }

            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu");
            $this -> load -> view ("admin/actividades/add_actividad",$pa_la_vista);
            $this -> load -> view ("admin/footer");
        }
    }

    public function modifica_actividad($idactividades) {
        // Controlador para todos los usuarios para modificar una actividad
        // $idactividades --> id de la actividad que se va a modificar

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista['usuario'] = array();
            $pa_la_vista['actividades'] = array();
            // Revisamos si tenemos el id de actividad (por get o por post o por hidden, da igual)
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
                $actividad = $this -> input -> POST("actividad");
                $descripcion = $this -> input -> POST("descripcion");
                $organiza = $this -> input -> POST("organiza");
                $lugar = $this -> input -> POST("lugar");
                $idbarrio = $this -> input -> POST("idbarrio");
                $idseccion = $this -> input -> POST("idseccion");
                $fecha = $this -> input -> POST("fecha");
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
                    $this -> input -> POST("fecha")
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
        }
    }

		private function esta_vacio($cadena) {
			// Funcion que comprueba si esta vacio

			// Retorna true si NO lo esta
			// Retorna false SI lo esta
		}

		private function fecha_completa($diamesano, $hora) {
			// Funcion que devuelve la fecha completa

			return $diamesano." ".$hora;
		}

 }

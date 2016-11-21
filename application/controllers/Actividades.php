<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

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
        // Carga las actividades del usuario.
        
        $pa_la_vista = array();
        // Datos del usuario de la sesion de usuario
        $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
        $idusuario = $datos_usuario['idsesion'];
        // Actividades de usuario por fecha descencente
        $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
        $pa_la_vista['usuario'] = $datos_usuario;
        $pa_la_vista['actividades'] = $actividades;

        $this -> load -> view ("actividades/principal", $pa_la_vista);	 	
    }
   
    public function add_actividad() {
        // Controlador para todos los usuarios de creacion de una actividad
        //
        // Datos del usuario de la sesion de usuario
        $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
        $idusuario = $datos_usuario['idsesion'];    
        // Vemos si ha mandado datos por POST o no

       $campanya = $this -> input -> POST("campanya");
       $actividad = $this -> input -> POST("actividad");
       $descripcion = $this -> input -> POST("descripcion");
       $organiza = $this -> input -> POST("organiza");
       $lugar = $this -> input -> POST("lugar");
       $idbarrio = $this -> input -> POST("idbarrio");
       $idseccion = $this -> input -> POST("idseccion");    
       $fecha = $this -> input -> POST("fecha");    
        // Si se ha enviado llamamos al modelo y añadimos la actividad
// ??? Si CodeIgniter tiene algo para comprobar si ha enviado algo
// ??? En principio lo pongo con el barrio que en la tabla tiene campo obligatorio       
       if (!empty($idbarrio)){
            $idactividades = $this -> modelo_actividades -> add_actividad($campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fecha,$idusuario);
//?? que tiene que hacer despues en pricipio está para añadir otra actividad
       }

       $this -> load -> view ("actividades/add_actividad");
    }
   
 }

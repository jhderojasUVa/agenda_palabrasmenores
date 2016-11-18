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
   
 }

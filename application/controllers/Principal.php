<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	/**
	 * Controlador principal de Arranque
	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
		 parent::__construct();
	 }

	public function index() {
		// Controlador principal de entrada a la web

		// Sacamos los eventos del mes en marcha
		$mes_actual = date('m');
		$ano_actual = date('Y');
		$ano_siguiente = date('Y')+1;
		$mes_siguiente = date('m')+1;

		if ($mes_actual == 12) {
			$ano_siguiente = $ano_actual+1;
			$mes_siguiente = 1;
		} else {
			$ano_siguiente = $ano_actual;
			$mes_siguiente = $mes_siguiente;
		}

		$datos['actividad_mes'] = $this -> modelo_actividades -> mostrar_desde_hasta($ano_actual.'-'.$mes_actual.'-01', $ano_siguiente.'-'.$mes_siguiente.-'01');

		/* Llamamos a una vista llamada principal */
		$this -> load -> view('principal', $datos);
	}

	public function actividad() {
		// Controlador cuando se da a una actividad en concreto y se sacan sus datos

		// Primero sacamos por GET de que actividad viene (el ID) que se habra mandado en el A HREF
		$idactividad = $this -> input -> GET("idactividad");

		// Buscamos en la base de datos la actividad en si
		$datos["actividad"] = $this -> modelo_actividades -> actividad_id ($idactividad);

		// Llaamos a la vista
		$this -> load -> view("actividad", $datos);
	}
}


// Por seguridad, muchas veces no se cierra el php
// Te pongo ejemplos (como este controlador) donde no
// y ejemplos, donde si, los modelos

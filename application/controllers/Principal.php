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

		// Cargamos los datos de la base de datos
		// ?Cuantos dias tiene este mes?
		$dias_del_mes = $this -> libreria_fechas -> dias_del_mes(date("m"));
		// Metemos en actividades las actividades del mes
		// Esto nos vale para pintar el calendario de este mes entero en bonito
		// Hay que preguntar si estamos a dia 15, en el calendario van a aparecer los dias pasados o no
		// Depende de como, esto hay que tocarlo
		foreach ($dia as $dias_del_mes) {
			$datos["actividades"] = array_push($this -> modelo_actividades -> mostrar_actividad_dia($dias));
		}

		// Sacamos las actividades de 30 dias en adelante
		$datos["actividades_30_dias"] = $this -> modelo_actividades -> mostrar_desde_hasta(date("YYYY-m-dd"), mktime(0, 0, 0, date("m"), date("d")+30, date("Y")))

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

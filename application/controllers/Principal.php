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
                $dia_actual = date('d');
		$ano_siguiente = date('Y')+1;
		$mes_siguiente = date('m')+1;

		if ($mes_actual == 12) {
			$ano_siguiente = $ano_actual+1;
			$mes_siguiente = 1;
		} else {
			$ano_siguiente = $ano_actual;
			$mes_siguiente = $mes_siguiente;
		}
                // Actividades del mes actual
                $actividad_mes_actual = $this -> modelo_actividades -> mostrar_desde_hasta($ano_actual.'-'.$mes_actual.'-01', $ano_siguiente.'-'.$mes_siguiente.-'01');
                // Array con los dias del mes actual que tiene eventos
                $donde = 'principal';
                $datos['dias_eventos']=array();
                if ($actividad_mes_actual) {
                    foreach ($actividad_mes_actual as $row) {
                        $dia = $this ->devuelve_dia($row -> fecha);
                        $datos['dias_eventos'][$dia] = $donde;
                    }
                }
                // Sacamos las actividades de dentro de 30 días
                $fecha_hoy = date('Y-m-d');
                $fecha_suma = strtotime('+30 day',  strtotime($fecha_hoy));
                $ano_suma = date('Y',$fecha_suma);
                $mes_suma = date('m',$fecha_suma);
                $dia_suma = date('d',$fecha_suma);
                // Actividades de dentro de 30 días               
                $datos['actividad_mes'] = $this -> modelo_actividades -> mostrar_desde_hasta($ano_actual.'-'.$mes_actual.'-'.$dia_actual, $ano_suma.'-'.$mes_suma.'-'.$dia_suma);

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
        
        private function devuelve_dia($fecha_hora) {
            $fec = explode (" ",$fecha_hora);
            $fecha_datos = explode ("-",$fec[0]);
            // lo paso a entero para que de 01 a 09 pase de 1 a 9
            // si paso 01, no funciona el array que se pasa al calendario
            return (int)$fecha_datos[2];
        }
}


// Por seguridad, muchas veces no se cierra el php
// Te pongo ejemplos (como este controlador) donde no
// y ejemplos, donde si, los modelos

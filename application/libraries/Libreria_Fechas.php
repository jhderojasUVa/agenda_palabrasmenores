<?php

class Libreria_fechas {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        public function comprueba_fecha($fecha, $para_que) {
          // Funcion que comprueba si la fecha es correcta o no
          // devuelve true si esta bien y false si no
          // $fecha = la fecha
          // $para_que = para que lo vamos a usar "web", "bd"

          // Comprobamos si la fecha esta en formato correcto
          // Usamos preg_match
          // Seguro que la he cagado en las expresiones regulares habria que repasarlo
          /*
          if (!preg_match("/^(d){1,4}-(d){1,2}-(d){1,4}+$/i"), $fecha) {
            // La fecha es vete a saber
            return false;
          } elseif (preg_match("/^(d){1,4}-(d){1,2}-(d){1,2}+$/i",$fecha) {
            // Es para bd
          } elseif (preg_match("/^(d){1,4}\/(d){1,2}\/(d){1,2}+$/i",$fecha) {
            // Es para web
          }
           *
           */

            if (preg_match("/^\d{1,4}-\d{1,2}-\d{1,2}+$/i",$fecha)) {
                // Es para bd
            } elseif (preg_match("/^\d{1,4}\/\d{1,2}\/\d{1,2}+$/i",$fecha)) {
                // Es para web
            } else {
                // La fecha es vete a saber
                return false;
            }


          // Si lo es continuamos y la desgranamos
          $nueva_fecha = divide_fecha($fecha);

          // Si no lo es llamamos al formateador de fechas
          $nueva_fecha = formatea_fecha_bd($fecha);
          // Tras el formateado, hay que sacar lo de antes, dia mes y año
          $nueva_fecha = divide_fecha($nueva_fecha);

          // Esto hay que revisarlo, no se porque me da a mi
          $ano = $nueva_fecha[0];
          $mes = $nueva_fecha[1];
          $dia = $nueva_fecha[2];

          // Comprobamos si la fecha existe, vamos, el tema de los bisiestos
          $es_correcto = checkdate($mes, $dia, $anyo); // 0 si no es correcto, 1 si lo es

          // Devolvemos lo que sea
        }

        public function divide_fecha($fecha, $para_que) {
          // Funcion que le metes una fecha y la divide devolviendo
          // un array con dia, mes, año y hora
          // $fecha = la fecha
          // $para_que = para que lo vamos a usar "web", "bd"

          if ($para_que == "web") {
            $array_fechas = explode("/", $fecha);
            return $array_fechas;
          } elseif ($para_que == "bd") {
            $array_fechas = explode("-", $fecha);
            return $array_fechas;
          } else {
            return false;
          }
        }

        public function formatea_fecha_bd($fecha) {
          // Funcion que coje la entrada y la intenta formatear
          // devuelve el resultado

          $nueva_fecha = date_format ($fecha, "Y-m-d H:i:s");
          return $nueva_fecha;
        }

        public function formatea_fecha_web($fecha) {
          // Funcion que coje la entrada y la saca al estilo de ver bien
          // devuelve el resultado

          $nueva_fecha = date_format($fecha,"d/m/Y a las H:i");
          return $nueva_fecha;
        }

        public function fecha_actual(){
          // Funcion que devuelve la fecha actual
          return date("d/m/Y H:i");
        }

        public function dias_del_mes($mes) {
          // Devuelve el numero total de dias de del mes
        }

        public function de_la_fecha_30_dias($fecha) {
          // Devuelve, por orden, a partir de la $fecha
          // Los numeros de los siguientes 30 días
        }
}

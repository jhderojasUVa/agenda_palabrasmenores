<?
class Libreria_sesiones {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        public function foo()
        {
                $this->CI->load->helper('url');
                redirect();
        }

        public function bar()
        {
                echo $this->CI->config->item('base_url');
        }

        public function comprobar_session() {
          // Funcion que comprueba si esta registrado o no
          // devuevle 0 si no y 1 si esta, vamos true o false
          if ($this -> session -> registrado) {
            return true;
          } else {
            return false;
          }
        }

        public function registrar($estado) {
          // Funcion que mete si esta registrado o no en las sesiones
          // si le meten true o false y devuelve true si todo ok o false si no

          if ($estado == TRUE) {
            // Le registramos
            $this -> session -> registrado = TRUE;
            return true;
          } elseif ($estado == FALSE) {
            // No esta registrado
            $this -> session -> registrado = FALSE;
            return true;
          } else {
            // Woops ha habido algun problema
            return false;
          }
        }

        public function des_registrar() {
          // Funcion que des-logea o des-registra al usuario
          // devuelve true si ha ido todo bien o false sino

          if ($this ->session -> registrado == TRUE) {
            $this -> session -> registrado = FALSE;
            return true;
          } else {
            // Woops algo ha ido mal
            return false;
          }
        }

        public function devuelve_datos_session() {
          // Funcion que devuelve un array de los datos de la sesion
          $cositas = array(
            "registrado" => $this -> session -> registrado,
            "login" => $this -> session -> login,
            "nombre" => $this -> session -> nombre
            // nunca metemos el password
          )

          return $cositas;
        }

        public funcion mete_datos_sesion($registrado, $login, $nombre) {
          // Funcion que mete los datos en la session
          $this -> session -> registrado = $registrado;
          $this -> session -> login = $login;
          $this -> session -> nombre = $nombre;

          return true;
        }
}

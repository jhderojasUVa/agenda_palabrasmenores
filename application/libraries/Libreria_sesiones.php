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

        public function comprobar_session() {
          // Funcion que comprueba si esta registrado o no
          // devuevle 0 si no y 1 si esta, vamos true o false
          if ($this -> session -> registrado) {
            return true;
          } else {
            return false;
          }
        }

        public function registrar($estado, $idusuario) {
          // Funcion que mete si esta registrado o no en las sesiones
          // si le meten true o false y devuelve true si todo ok o false si no

          // $estado = true o false segun le registremos o se registre
          // $idusuario = si lo registramos hay que meter el login, obviamente

          if ($estado == TRUE) {
            // Le registramos
            $this -> session -> registrado = TRUE;
            $this -> session -> idusuario = $idusuario;
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
            $this -> session -> unset_userdata("registrado");
            $this -> session -> unset_userdata("idusuario");
            return true;
          } else {
            // Woops algo ha ido mal
            return false;
          }
        }

        public function devuelve_datos_session() {
          // Funcion que devuelve un array de los datos de la sesion
          $cositas = array(
            "idsesion" => $this -> session -> login,
            "registrado" => $this -> session -> registrado,
            "login" => $this -> session -> login,
            "nombre" => $this -> session -> nombre,
            "acl" => $this -> session -> acl;
            // nunca metemos el password luego ¿para que devolverlo?
          )

          return $cositas;
        }

        public funcion mete_datos_sesion($idsesion, $registrado, $login, $nombre, $acl) {
          // Funcion que mete los datos en la session
          // $idsesion = el identificador que es el login
          // $registrado = TRUE o FALSE, autoexplicativo
          // $login = Pues el login del usuario
          // $nombre = el nombre real del pollopera

          // La idea de esta funcion es que tras comprobar y registrarlo
          // la llamamos y metemos los datos del usuario completos
          $this -> session -> idlogin = $login;
          $this -> session -> registrado = $registrado;
          $this -> session -> login = $login;
          $this -> session -> nombre = $nombre;
          $this -> session -> acl = $acl;

          return true;
        }
}

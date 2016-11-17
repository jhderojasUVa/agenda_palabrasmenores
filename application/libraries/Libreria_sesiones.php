<?php
class Libreria_sesiones {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct(){
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

        // ATENCION
        // Para llamar a una libreria dentro de una libreria hay que usar el objeto
        // $this -> CI -> libreria -> funcion
        // Y no el e
        // $this -> libreria -> funcion
        // Porque, como indica la documentacion, al ser una clase no
        // podemos llamar directamente y solo a una copia de la misma (obviamente)

        public function comprobar_session() {
          // Funcion que comprueba si esta registrado o no
          // devuevle 0 si no y 1 si esta, vamos true o false
          if ($this -> CI -> session -> registrado) {
            return true;
          } else {
            return false;
          }
        }

        public function registrar($estado, $idusuario) {
          // Funcion que mete si esta registrado o no en las sesiones
          // si le meten true o false y devuelve true si todo ok o false si no

          // $estado = true
          // $idusuario = si lo registramos hay que meter el login, obviamente

          if ($estado == TRUE) {
            // Le registramos            
            $this -> CI -> session -> registrado = TRUE;
            $this -> CI -> session -> idusuario = $idusuario;
            return true;
          } elseif ($estado == FALSE) {
            // No esta registrado
            $this -> CI -> session -> registrado = FALSE;
            return true;
          } else {
            // Woops ha habido algun problema
            return false;
          }
        }

        public function des_registrar() {
          // Funcion que des-logea o des-registra al usuario
          // devuelve true si ha ido todo bien o false sino

          if ($this -> CI -> session -> registrado == TRUE) {
              $array_desregistrar=array(
                  'registrado',
                  'idusuario',
                  'idsesion',
                  'login',
                  'nombre',
                  'acl'                  
                  );

            $this -> CI -> session -> unset_userdata( $array_desregistrar);

//??? hay que destruir la sesion 
//$this -> CI -> session -> sess_destroy(); 
            return true;
          } else {
            // Woops algo ha ido mal
            return false;
          }
        }

        public function devuelve_datos_session() {
          // Funcion que devuelve un array de los datos de la sesion
          $cositas = array(
            "idsesion" => $this -> CI -> session -> login,
            "registrado" => $this -> CI -> session -> registrado,
            "login" => $this -> CI -> session -> login,
            "nombre" => $this -> CI -> session -> nombre,
            "acl" => $this -> CI -> session -> acl
            // nunca metemos el password luego ¿para que devolverlo?
          );
          return $cositas;
        }

        public function mete_datos_sesion($idsesion, $registrado, $login, $nombre, $acl) {
          // Funcion que mete los datos en la session
          // $idsesion = el identificador que es el login
          // $registrado = TRUE o FALSE, autoexplicativo
          // $login = Pues el login del usuario
          // $nombre = el nombre real del pollopera
          // $acl = el identificador de acl              

          // La idea de esta funcion es que tras comprobar y registrarlo
          // la llamamos y metemos los datos del usuario completos
          $this -> CI -> session -> idsesion = $login;
          $this -> CI -> session -> registrado = $registrado;
          $this -> CI -> session -> login = $login;
          $this -> CI -> session -> nombre = $nombre;
          $this -> CI -> session -> acl = $acl;

          return true;
        }
}

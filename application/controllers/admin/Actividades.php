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
        $publicada = 0;
        // Si se ha enviado llamamos al modelo y añadimos la actividad
// ??? Si CodeIgniter tiene algo para comprobar si ha enviado algo
// ??? En principio lo pongo con el barrio que en la tabla tiene campo obligatorio
        if (!empty($idbarrio)){
            $idactividades = $this -> modelo_actividades -> add_actividad($campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fecha,$idusuario,$publicada);
//?? que tiene que hacer despues en pricipio está para añadir otra actividad
        }
        $this -> load -> view ("admin/header");
				$this -> load -> view ("admin/menu");
        $this -> load -> view ("admin/actividades/add_actividad");
        $this -> load -> view ("admin/footer");
    }

		public function modifica_actividad() {
			// Revisamos si tenemos el id de actividad (por get o por post o por hidden, da igual)

			// Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

			// Si modificar = 1 hacemos el update

			// Conseguimos los datos por el modelo
			// Se lo enviamos a las vistas correspondientes

			// Recuerda que aqui puedes elegir el usar la vista de add_actividad modificandola o hacer una vista nueva
			// Te lo dejo a tu eleccion
			// Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
			// por ejemplo
			// <input type="hidden" value="1" name="modificar">
		}

		public function buscar_actividad() {
			// Buscaremos las actividades a traves de un texto en el titulo o en la descripcion

			// Recogemos la query del formulario (del menu), del q

			// Llamamos al modelo que busca por la query (q) en ambos campos con un OR

			// Llamamos a las vistas con el resultado
		}

 }

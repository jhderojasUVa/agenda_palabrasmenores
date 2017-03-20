<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividades extends CI_Controller {

	/**
	 * Controlador para las cosas de las actividades

  *  tambien vale para modificar los datos del usuario
	 */
	 public function __contruct() {
		 /* Funcion de construccion del objeto */
// OJO ?? AQUI NO FUNCIONA
		 // Configuraciones del upload
		 // Documentos
		 $config_documento["allowed_types"] = "pdf|txt";
		 $config_documento["upload_path"] = "./uploads/";
		 // Imagenes
		 $config_imagen["allowed_types"] = "gif|jpg|png";
		 $config_imagen["upload_path"] = "./uploads/";
		 parent::__construct();
	 }

    public function add_actividad() {
        // Controlador para todos los usuarios de creacion de una actividad

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Inicializamos
            $pa_la_vista = array();
            // Inicializamos los fallos
            $fallo = 0;
            $num_error=0;
            $pa_la_vista['error'][$num_error] = "";
            $pa_la_vista['actualizado'] = 0;
            // Obtiene todos los barrios
            $pa_la_vista['barrios'] = $this -> modelo_barrios -> devuelve_barrios();
            // Obtiene todos las secciones
            $pa_la_vista['secciones'] = $this -> modelo_secciones -> devuelve_secciones();
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $acl = $datos_usuario['acl'];
            $idusuario = $datos_usuario['idsesion'];
            // Vemos si ha mandado datos por POST o no
            if ($this -> input -> POST("add")==1) {
                $campanya = $this -> input -> POST("campanya");
                $actividad = $this -> input -> POST("actividad");
                $descripcion = $this -> input -> POST("descripcion");
                $organiza = $this -> input -> POST("organiza");
                $lugar = $this -> input -> POST("lugar");
                $idbarrio = $this -> input -> POST("idbarrio");
                $idseccion = $this -> input -> POST("idseccion");
                $fecha = $this -> input -> POST("fecha");
                $hora = $this -> input -> POST("hora");
                $descripcion_documento = $this -> input -> POST("descripcion_documento");
                $descripcion_imagen = $this -> input -> POST("descripcion_imagen");
                // A recordar:
								// Sumo Pontifice = 1
								// Redactor = 2
								// Editor = 3
								// Disabled = 0

								// Subida de ficheros
								// Se hace al final
								// Componemos la ruta

		if ($acl != 1 && $acl != 2) {
                    $publicada = 0;
		} else {
                    $publicada = 1;
		}
                // Comprobar los campos
                if (!$this -> esta_vacio($actividad)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La actividad no puede estar vacía";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($lugar)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El lugar no puede estar vacío";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idbarrio)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El barrio no puede estar vacío";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idseccion)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La sección no puede estar vacía";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($fecha)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La fecha no puede estar vacía";
                    $num_error ++;
                }
                if ($fallo == 0) {
										// ?? ESTO
                   $fecha_grabar = $this -> fecha_formateada ($fecha);
                    // Obtenemos la fecha para grabar
                    $fechahora = $this ->fecha_grabar($fecha_grabar, $hora);
                    // Si se ha enviado llamamos al modelo y añadimos la actividad
                    $idactividades = $this -> modelo_actividades -> add_actividad($campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fechahora,$idusuario,$publicada);
                    $pa_la_vista['actualizado'] = 1;
                    // Año y mes
                    $ano = $this -> devuelve_anio ($fecha_grabar);
                    $mes = $this -> devuelve_mes ($fecha_grabar);
                    // Hacemos el upload de los documentos
                    $num_ficheros = count($_FILES['documentos']['name']);
                    if ($num_ficheros > 0) {
												// ? poner en otro sitio
                        $config_documento["allowed_types"] = "pdf|txt";
                        $config_documento["upload_path"] = "./uploads/documentos/";
                        $config_documento["upload_path"] .= $ano."/".$mes;
                        // Comprobamos la ruta
                        $ruta = $this -> existe_ruta ($config_documento["upload_path"]);
                        if ($ruta == true){
                            // Se ha creado la ruta
                        } else {
                            // Error o la ruta existe
                        }
                        // Ciclo para cada documento
                        for ($i=0; $i<$num_ficheros; $i++){
                            $_FILES['documento']['name'] = $_FILES['documentos']['name'][$i];
                            $_FILES['documento']['type'] = $_FILES['documentos']['type'][$i];
                            $_FILES['documento']['tmp_name'] = $_FILES['documentos']['tmp_name'][$i];
                            $_FILES['documento']['error'] = $_FILES['documentos']['error'][$i];
                            $_FILES['documento']['size'] = $_FILES['documentos']['size'][$i];
                            // Cargar la configuracion de, en este caso documento
                            $this -> upload -> initialize ($config_documento);
                            // Hacemos el upload llamando a como se llama el control
                            if ($this -> upload -> do_upload ('documento')){
                                // Si sube el fichero o hay algo que subir
                                // Cuando acabe el upload devolvemos todos los datos que ha guardado
                                $fichero_real = $this -> upload -> data();
                                $nombre_documento = $fichero_real["file_name"];
                                // Añade el documento
                                $this -> modelo_documentos -> add_documento ($idactividades, $nombre_documento, $descripcion_documento[$i]);
                            } else {
                                $nombre_documento="";
                                // Si no hay que subir fichero
                            }
                        }
                    }
                    // Hacemos el upload de las imagenes
                    $num_ficheros = count($_FILES['imagenes']['name']);
                    if ($num_ficheros > 0) {
                        $config_imagen["allowed_types"] = "gif|jpg|png";
                        $config_imagen["upload_path"] = "./uploads/imagenes/";
                        $config_imagen["upload_path"] .= $ano."/".$mes;
                        // Comprobamos la ruta
                        $ruta = $this -> existe_ruta ($config_imagen["upload_path"]);
                        if ($ruta == true){
                            // Se ha creado la ruta
                            // Es por si acaso, que nunca se sabe
                        } else {
                            // Error o la ruta existe
                            // Es por si acaso, que nunca se sabe
                        }
                        // Ciclo para cada imagen
                        for ($i=0; $i<$num_ficheros; $i++){
                            $_FILES['imagen']['name'] = $_FILES['imagenes']['name'][$i];
                            $_FILES['imagen']['type'] = $_FILES['imagenes']['type'][$i];
                            $_FILES['imagen']['tmp_name'] = $_FILES['imagenes']['tmp_name'][$i];
                            $_FILES['imagen']['error'] = $_FILES['imagenes']['error'][$i];
                            $_FILES['imagen']['size'] = $_FILES['imagenes']['size'][$i];
                            // Cargar la configuracion de, en este caso imagen
                            $this -> upload -> initialize ($config_imagen);
                            // Hacemos el upload llamando a como se llama el control
                            if ($this -> upload -> do_upload ("imagen")){
                                // Si sube el fichero o hay algo que subir
                                // Cuando acabe el upload devolvemos todos los datos que ha guardado
                                $fichero_real = $this -> upload -> data();
                                $nombre_imagen=$fichero_real["file_name"];
                                // Añade la imagen
                                $this -> modelo_imagenes -> add_imagen ($idactividades, $nombre_imagen, $descripcion_imagen[$i]);
                            } else {
                                $nombre_imagen="";
                                // Si no hay que subir fichero
                            }
                        }
                    }
                }
            }
            if ($fallo == 1) {
                $pa_la_vista['actividades'] = array (
                    'campanya' => $campanya,
                    'actividad' => $actividad,
                    'descripcion' => $descripcion,
                    'organiza' => $organiza,
                    'lugar' => $lugar,
                    'idbarrio' => $idbarrio,
                    'idseccion' => $idseccion,
                    'fecha' => $fecha,
                    'hora' => $hora,
                    'descripcion_documento' => $descripcion_documento,
                    'descripcion_imagen' => $descripcion_imagen,
                );
            }  else {
                $pa_la_vista['actividades'] = array (
                        'campanya' => "",
                        'actividad' => "",
                        'descripcion' => "",
                        'organiza' => "",
                        'lugar' => "",
                        'idbarrio' => "",
                        'idseccion' => "",
                        'fecha' => "",
                        'hora' => "",
                        'descripcion_documento' => "",
                        'descripcion_imagen' => "",
                );
            }

            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu", $datos_usuario);
            $this -> load -> view ("admin/actividades/add_actividad",$pa_la_vista);
            $this -> load -> view ("admin/footer");
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }

    public function modifica_actividad() {
        // Controlador para todos los usuarios para modificar una actividad

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Retornar la ACL del usuario
            $acl = $this -> session -> acl;
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista['usuario'] = array();
            $pa_la_vista['actividades'] = array();
            // errores
            $num_error=0;
            $pa_la_vista['error'] = array ();
            $pa_la_vista['error'][$num_error] = "";
            // Obtiene todos los barrios
            $pa_la_vista['barrios'] = $this -> modelo_barrios -> devuelve_barrios();
            // Obtiene todos las secciones
            $pa_la_vista['secciones'] = $this -> modelo_secciones -> devuelve_secciones();
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            $acl = $datos_usuario['acl'];
            $pa_la_vista['usuario'] = $datos_usuario;
            // Revisamos si tenemos el id de actividad (por get o por post o por hidden, da igual)
            $idactividades = $this -> input -> post_get("idactividades");
            if (!$idactividades){
                $fallo = 2;
                $pa_la_vista['error'] = "No hay actividad";
            }

            // Revisamos si ha modificado, es decir, como te digo abajo si modificar=1

            // Si modificar = 1 hacemos el update
            if ($this -> input -> POST("modificar")==1 && $fallo==0){
                // Datos de la actividad del POST
                $campanya = $this -> input -> POST("campanya");
                $actividad = $this -> input -> POST("actividad");
                $descripcion = $this -> input -> POST("descripcion");
                $organiza = $this -> input -> POST("organiza");
                $lugar = $this -> input -> POST("lugar");
                $idbarrio = $this -> input -> POST("idbarrio");
                $idseccion = $this -> input -> POST("idseccion");
                $fecha = $this -> input -> POST("fecha");
                $hora = $this -> input -> POST("hora");

        	$documento;
		$fichero;
		// A recordar:
		// Sumo Pontifice = 1
		// Redactor = 2
		// Editor = 3
		// Disabled = 0
		if ($acl != 1 && $acl != 2) {
                    $publicada = 0;
		} else {
                    $publicada = 1;
		}
                // Comprobar los campos
                if (!$this -> esta_vacio($actividad)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La actividad no puede estar vacía";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($lugar)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El lugar no puede estar vacío";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idbarrio)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "El barrio no puede estar vacío";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($idseccion)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La sección no puede estar vacía";
                    $num_error ++;
                }
                if (!$this -> esta_vacio($fecha)) {
                    $fallo = 1;
                    $pa_la_vista['error'][$num_error] = "La fecha no puede estar vacía";
                    $num_error ++;
                }
                if ($fallo == 0) {
                    // Obtenemos la fecha para grabar
                    $fechahora = $this -> fecha_grabar($fecha, $hora);
                    // update
                    $this -> modelo_actividades -> update_actividad($idactividades,$campanya,$actividad,$descripcion,$organiza,$lugar,$idbarrio,$idseccion,$fechahora,$idusuario,$publicada);
                    $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
                    // Conseguimos los datos por el modelo para enviarlos a la vista principal
                    // Actividades de usuario por fecha descencente
                    $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
                    $pa_la_vista['actividades'] = $actividades;
                    $this -> load -> view ("admin/header");
                    $this -> load -> view ("admin/menu",$datos_usuario);
                    $this -> load -> view ("admin/actividades/principal",$pa_la_vista);
                    $this -> load -> view ("admin/footer");
                }
            }
            if ($this -> input -> POST("modificar")!=1 || $fallo == 1){
                // Conseguimos los datos por el modelo
 //OJO ??       // Si es la primera vez los datos del modelo
                if ($fallo == 0) {
                    $actividades = $this -> modelo_actividades -> actividad_id($idactividades);
                    foreach ($actividades as $fila) {
                        // separa la fecha y la hora
                        $fecha_hora = $fila['fecha'];
                        $fecha = $this -> devuelve_fecha($fecha_hora);
                        $hora = $this -> devuelve_hora($fecha_hora);

                        $fila['fecha'] = $fecha;
                        $fila['hora'] = $hora;
                    }
                    $pa_la_vista['actividades'] = $fila;
                }else {
                    // Si es por un fallo recupera los valores que ha metido antes
                    $fila = array(
                        "idactividades" => $idactividades,
                        "campanya" => $campanya,
                        "actividad" => $actividad,
                        "descripcion" => $descripcion,
                        "organiza" => $organiza,
                        "lugar" => $lugar,
                        "idbarrio" => $idbarrio,
                        "idseccion" => $idseccion,
                        "fecha" => $fecha,
                        "hora" => $hora
                    );
                    $pa_la_vista['actividades'] = $fila;
                }

                // Se lo enviamos a las vistas correspondientes

                // Recuerda que aqui puedes elegir el usar la vista de add_actividad modificandola o hacer una vista nueva
                // Te lo dejo a tu eleccion
                // Lo unico es que la vista, cuando modifica ha de llamar a este controlador enviando por hidden un parametro
                // por ejemplo
                // <input type="hidden" value="1" name="modificar">
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/actividades/modificar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else if ($fallo == 2){
                // Si hay algún error
                // ?? ver si tiene que ir a modificar_actividad o principal
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/actividades/modificar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }
    }

    public function buscar_actividad() {
        // Buscaremos las actividades a traves de un texto en el menu o por un formulario
        // tipo_busqueda --> 1 si busca por un texto en el cajetin del menu
        // tipo_busqueda --> 2 si busca desde un formulario

        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            // Inicializamos
            $pa_la_vista = array();
            // La siguiente linea de momento dejo, por si errores de respuesta
            $pa_la_vista['actualizado'] = 0;
            // Datos del usuario de la sesion de usuario
            $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
            $idusuario = $datos_usuario['idsesion'];
            $pa_la_vista['usuario'] = $datos_usuario;
            // Recogemos la query del formulario (del menu), del q
            if ($this -> input -> POST("tipo_busqueda") == 1){
                $texto = $this -> input -> POST("q");
                // Llamamos al modelo que busca por la query (q) en ambos campos con un OR
                $pa_la_vista['actividades'] = $this -> modelo_actividades -> buscar_cajetin($texto);

                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/actividades/buscar_actividad", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            // Tipo de busqueda formulario
            } else if ($this -> input -> POST("tipo_busqueda") == 2){
                $datos_busqueda =  array(
                    $this -> input -> POST("campanya"),
                    $this -> input -> POST("actividad"),
                    $this -> input -> POST("organiza"),
                    $this -> input -> POST("fecha")." ".$this -> input -> POST("hora")
                );
                // Llamamos al modelo que busca por los campos AND
                $pa_la_vista['actividades'] = $this -> modelo_actividades -> buscar_actividad($datos_busqueda);
                // Llamamos a las vistas con el resultado
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/actividades/buscar_actividad", $pa_la_vista);
                $this -> load -> view ("admin/footer");
            } else {
                // Llamamos al formulario para meter los datos de busqueda
                $this -> load -> view ("admin/header");
                $this -> load -> view ("admin/menu",$datos_usuario);
                $this -> load -> view ("admin/actividades/formbuscar_actividad",$pa_la_vista);
                $this -> load -> view ("admin/footer");
            }
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    public function publicar() {
        // Comprueba que tenga iniciada sesion.
        if ($this -> libreria_sesiones -> comprobar_session() == true){
            $fallo = 0;
            $pa_la_vista = array();
            // Inicializamos
            $pa_la_vista['actualizado'] = 0;
            $pa_la_vista['usuario'] = array();
            $pa_la_vista['actividades'] = array();
            // Revisamos si tenemos el id de actividad
            $idactividades = $this -> input -> post_get("idactividades");
            if ($idactividades){
                // Datos del usuario de la sesion de usuario
                $datos_usuario = $this -> libreria_sesiones -> devuelve_datos_session();
                $idusuario = $datos_usuario['idsesion'];
                $pa_la_vista['usuario'] = $datos_usuario;
                // Conseguimos los datos de la actividad por el modelo
                $actividad = $this -> modelo_actividades -> actividad_id($idactividades);
                $publicada = 0; // inicializar a despublicada
                foreach ($actividad as $fila) {
                    // Si está despublicada publica
                    if ($fila['publicada']==0) $publicada = 1;
                }
                // PUBLIQUE la actividad
                $this -> modelo_actividades -> publicar_actividad($idactividades, $publicada);
                $pa_la_vista['actualizado'] = 1; // OJO de momento lo dejo lo tenía par los errores
            } else {
                $fallo = 1;
                $pa_la_vista['error'] = "No hay actividad";
            }
            // Conseguimos los datos por el modelo para enviarlos a la vista principal
            // Actividades de usuario por fecha descencente
						// ?? En principio lo paso a la vista principal de actividades
						// ?? Pero puede venir de buscar_actividad
            $actividades = $this -> modelo_actividades -> actividad_usuario_fecha($idusuario);
            $pa_la_vista['actividades'] = $actividades;
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/menu",$datos_usuario);
            $this -> load -> view ("admin/actividades/principal",$pa_la_vista);
            $this -> load -> view ("admin/footer");
        } else {
            //Enviamos al inicio
            $this -> load -> view ("admin/header");
            $this -> load -> view ("admin/index");
            $this -> load -> view ("admin/footer");
        }

    }

    private function esta_vacio($cadena) {
        // Funcion que comprueba si esta vacio
        // $cadena --> Campo que va a comprobar

        if ($cadena!="") {
            return true; // NO esta vacio
        } else {
            return false; // SI esta vacio
        }
    }

    private function fecha_grabar($anomesdia, $hora) {
			// Funcion que devuelve la fecha completa
			return $anomesdia." ".$hora;
    }

    private function devuelve_fecha($fecha_hora) {
			// Funcion que devuelve la fecha

			$fecha = explode(" ", $fecha_hora);
			return $fecha[0];
    }

		private function devuelve_hora($fecha_hora) {
		// Funcion que devuelve la hora

		    $fecha = explode(" ", $fecha_hora);
				return $fecha[1];
		}

    private function fecha_formateada($fecha) {
        $fecha_datos = explode ("/",$fecha);
        return $fecha_datos[2]."-".$fecha_datos[1]."-".$fecha_datos[0];
    }

    private function devuelve_anio($fecha) {
        $fecha_datos = explode ("-",$fecha);
        return $fecha_datos[0];
    }

    private function devuelve_mes($fecha) {
        $fecha_datos = explode ("-",$fecha);
        return $fecha_datos[1];
    }

    private function devuelve_dia($fecha) {
        $fecha_datos = explode ("-",$fecha);
        return $fecha_datos[2];
    }



  private function existe_ruta($ruta) {
	// Funcion que revisa si existe el Directorio
	// $ruta = ruta completa
	if (!is_dir($ruta)) {
            //mkdir ($BASE_DIR."/upload/".$quees."/".$ano."/".$mes);
            mkdir ($ruta, 0755, true);
            return true;
	}
	return false;
    }

 }

# Agenda de Palabras menores
Proyecto de la agenda de Palabras Menores

1. Introduccion
===============
El proyecto trata sobre el desarrollo de una agenda para el producto Palabras menores.

1.1. Objeto del proyecto
========================
Desde la vista de uso. (A desarrollar).

Desde la vista técnica. Se desea crear una agenda con diferentes frameworks portable e independiende del producto principal. Se creara un sistema cliente/servidor donde la mayoria del peso estara en el servidor tanto para consultas como para insercion de datos.

A su vez el producto es completo puesto que se ha de pensar no solo en en como se va a crear, sino la estructura (base de datos), gestion de la misma (modelos), como explotarla (controladores) y como visualizar la misma (vistas) de forma que sea obvia para el usuaio (UX) y que, a traves de esa obviedad sea sencilla (UI).

Es decir una aplicación web estandar desde principio a fin.

1.2. Alcance del proyecto
=========================
Se pretende desarrollar un sistema basado en cliente/servidor tipico delegando, en un futuro, responsabilidad al cliente a traves de un sistema REST por JSON o XML (con XQuery) y la creación de webservices para la consulta de los datos de la agenda.

Es decir se pretende realizar una gradeful upgrade comenzando desde una gestion total desde el servidor a, gradualmente ir pasando peso a los clientes eliminando el máximo posible de carga y llegando a un sistema cliente/servidor.

2. Plan de Gestion
==================

2.1 Hitos
=========

Hito 1: Defininir el sistema tanto XXXXX como informaticamente - en proceso<br/>
Hito 2: Creacion de la base de datos - hecho<br/>
Hito 3: Creacion de los modelos - hecho<br/>
Hito 4: Creacion de los controladores de gestion de usuario - en proceso<br/>
Hito 5: Creacion de las vistas de gestion de usuairo - en proceso<br/>
Hito 6: Creacion de los controladores de introduccion de datos<br/>
Hito 7: Creacion de las vistas de introduccionde datos<br/>
Hito 8: Creacion de los controladores de explotacion de datos<br/>
Hito 9: Creacion de las vistas de explotacion de datos<br/>
Hito 10: Baterias de pruebas con usuarios reales<br/>
Hito 11: Paso de modelos a REST<br/>
Hito 12: En las vistas paso a comprobaciones JS<br/>
Hito 13: Paso a framework JS<br/>
Hito 14: Test finales<br/>

La creacion de los hitos 4 y 5, 6 y 7, 8 y 9 van juntas.

2.3 Fases
=========
Las fases coinciden practicamente con los hitos.

3. Especificaciones
===================
A continuación se relatan las especificaciones técnicas del producto.

3.1. Requisitos
===============
Aplicacion realizada en PHP usando el framework de Codeigniter.

Necesario un servidor LAMP tipico (Apache + PHP + MySQL).

3.2. Diseño
===========

3.2.1. Controladores
====================
/Admin<br/>

        Login.php --> Controlador de usuario<br/>
                      index: Valida los datos del usuario para iniciar sesion<br/>
                      salir: Salir de la sesion<br/>
        Actividades.php --> Controlador de actividades:<br/>
                            add_actividad: Añadir<br/>
                            modifica_actividad: Modificar<br/>
                            buscar_actividad: Buscar<br/>
        Usuarios.php --> Controlador de usuarios:<br/>
                            add_usuario: Añadir<br/>
                            modifica_usuario: Modificar<br/>
                            buscar_usuario: Buscar<br/>
 
Principal.php --> Controlador de entrada<br/>


3.2.2. Modelos
==============
Modelo_actividades. Métodos:

        Añadir una actividad
        public function add_actividad ($campanya, $actividad, $descripcion, $organiza, $lugar, $idbarrio, $idseccion, $fecha, $usuario, $publicada)
            Parámetros entrada:
            $campanya    --> Nombre de la campanya de la actividad
            $actividad   --> Nombre de la actividad
            $descripcion --> Descripcion de la actividad
            $organiza    --> Nombre del organizador u organizadores
            $lugar       --> Direccion donde tiene lugar
            $idbarrio    --> ID del barrrio donde se realiza la actividad
            $idseccion   --> ID de la seccion a la que pertenece la actividad
            $fecha       --> Fecha y Hora de comienzo de la actividad
            $usuario     --> login del usuario                
            $publicada   --> Si está o no publicada la actividad, al crearla vendrá con valor 0 

        Actualizar una actividad            
        public function update_actividad ($idactividades, $campanya, $actividad, $descripcion, $organiza, $lugar, $idbarrio, $idseccion, $fecha, $usuario, $publicada)
            Parámetros entrada:
            $idactividades --> Identificador de la actividad que se va a actualizar
            $campanya      --> Nombre de la campanya de la actividad
            $actividad     --> Nombre de la actividad
            $descripcion   --> Descripcion de la actividad
            $organiza      --> Nombre del organizador u organizadores
            $lugar         --> Direccion donde tiene lugar
            $idbarrio      --> ID del barrrio donde se realiza la actividad
            $idseccion     --> ID de la seccion a la que pertenece la actividad
            $fecha         --> Fecha y Hora de comienzo de la actividad
            $usuario       --> login del usuario
            $publicada     --> Si está o no publicada la actividad 1- Publicada 0 - No publicada
                
        Borrar una actividad                 
        public function del_actividad ($idactividades)
            Parámetros entrada:
            $idactividades --> Identificador de la actividad que se va a eliminar
            Antes de borrar la actividad:
                Borra del fichero imagenes, las imagenes de esa actividad.
                Borra del fichero documentos, los documentos de esa actividad.
                Borra la actividad.

        Actividades de un usuario por orden descendente de fecha
        public function actividad_usuario_fecha($idusuario)
            Parámetros entrada:
            $idusuario --> Identificador del usuario del que se van a obtener las actividades
            Salida:
            Array con las actividades

        Datos de una actividad a partir del id de la actividad
        public function actividad_id($idactividades)
            Parámetros entrada:
            $idactividades --> Identificador de la actividad
            Salida:
            Array con los datos de la actividad

        Devuelve las actividades, resultado de la busqueda de un texto en cualquier campos de actividades sobre el que se va a buscar, ordenadas por fecha descendente
        public function buscar_cajetin($texto)
        Parámetros entrada:
            $texto --> texto que se va a buscar
            Campos sobre los que se va a buscar: campanya, actividad, descripcion, organiza, lugar 
            Salida:
            Array con los datos de las actividades ordenadas por fecha descendente.

        Devuelve las actividades, resultado de la busqueda en campos con un determinado texto, ordenadas por fecha descendente
        public function buscar_actividad($array_datos)
            Parámetros entrada:
            $array_datos --> array con el texto de los campos de actividades por los que se va a buscar
            Estos textos corresponden a los campos: campanya, actividad, organiza y fecha
            Salida:
            Array con los datos de las actividades ordenadas por fecha descendente.

Modelo_barrios. Métodos:

        Añadir un barrio
        public function add_barrio ($nombre)
            Parámetros entrada:      
            $nombre --> Nombre del barrio que se va a añadir

        Actualizar un barrio
        public function update_barrio ($idbarrios, $nombre)
            Parámetros entrada:
            $idbarrios --> Identificador del barrio que se va a actualizar
            $nombre    --> Nombre del barrio que se va a actualizar

        Borrar un barrio
        public function del_barrio ($idbarrios)
            Parámetros entrada:
            $idbarrios  --> Identificador del barrio que se va a eliminar
            Antes de borrar el barrio:
                Borra del fichero imagenes, las imagenes de las actividades del barrio.
                Borra del fichero documentos, los documentos de las actividades del barrio.
                Borra del ficheros actividades, las actividades del barrio.
                Borra el barrio.

Modelo_documentos. Métodos:

        Añadir un documento a la actividad
        public function add_documento ($idactividad, $rutadocumento, $descripcion)
            Parámetros entrada: 
            $idactividad   --> ID de la actividad a la que pertenece el documento
            $rutadocumento --> Ruta donde esta el documento
            $descripcion   --> Descripcion del documento

        Actualizar un documento de una actividad
        public function update_documento ($iddocumentos, $idactividad, $rutadocumento, $descripcion)
            Parámetros entrada:
            $iddocumentos --> Identificador del documento que se va a actualizar
            $idactividad  --> ID de la actividad a la que pertenece el documento
            $rutaimagen   --> Ruta donde esta el documento
            $descripcion  --> Descripcion del documento

        Borrar un documento de una actividad
        public function del_documento ($iddocumentos) {
            Parámetros entrada:
            iddocumentos  --> Identificador del documento que se va a eliminar

Modelo_imagenes. Métodos:

        Añadir una imagen a una actividad      
        public function add_imagen ($idactividad, $rutaimagen, $descripcion)
            Parámetros entrada:
            $idactividad --> ID de la actividad a la que pertenece la imagen
            $rutaimagen  --> Ruta donde esta la imagen
            $descripcion --> Descripcion de la imagen

        Actualizar una imagen de una actividad
        public function update_imagen ($idimagenes, $idactividad, $rutaimagen, $descripcion)
            Parámetros entrada:
            $idimagenes  --> Identificador de la imagen que se va a actualizar
            $idactividad --> ID de la actividad a la que pertenece la imagen
            $rutaimagen  --> Ruta donde esta la imagen
            $descripcion --> Descripcion de la imagen

        Borrar una imagen de una actividad
        public function del_imagen ($idimagenes)
            Parámetros entrada:
            $idimagenes  --> Identificador de la imagen que se va a eliminar

Modelo_secciones. Métodos:

        Añadir una seccion
        public function add_seccion ($nombre)
            Parámetros entrada:
            $nombre --> Nombre de la seccion que se va a añadir

        Actualizar una seccion
        public function update_seccion ($idsecciones, $nombre)
            Parámetros entrada:
            $idsecciones --> Identificador de la seccion que se va a actualizar
            $nombre      --> Nombre de la seccion que se va a actualizar

        Borrar una seccion
        public function del_seccion ($idsecciones)
            Parámetros entrada:
            $idsecciones  --> Identificador de la seccion que se va a eliminar
            Antes de borrar la seccion:
                Borra del fichero imagenes, las imagenes de las actividades de la seccion.
                Borra del fichero documentos, los documentos de las actividades de la seccion.
                Borra del ficheros actividades, las actividades de la seccion.
                Borra la seccion.

Modelo_usuarios. Métodos:

        Añadir un usuario
        public function add_usuario ($login, $password, $nombre, $idacl)
            Parámetros entrada: 
            $login    --> Login de entrada del usuario
            $password --> Password, md5
            $nombre   --> Nombre del usuario
            $idacl    --> Identificador de la ACL. 1-Administrador, 2-Usuario, 3-Desactivado

        Actualizar un usuario
        public function add_usuario ($login, $password, $nombre, $idacl)
            Parámetros entrada: 
            $login    --> Login de entrada del usuario
            $password --> Password, md5
            $nombre   --> Nombre del usuario
            $idacl    --> Identificador de la ACL. 1-Administrador, 2-Usuario, 3-Desactivado

        Borrar un usuario
        public function del_usuario ($login)
            Parámetros entrada:
            $login    --> Login de entrada del usuario que se va a eliminar
            Antes de borrar el usuario:
                Borra del fichero imagenes, las imagenes de las actividades del usuario.
                Borra del fichero documentos, los documentos de las actividades del usuario.
                Borra del ficheros actividades, las actividades del usuario.
                Borra el usuario.

        Comprobar en la base de datos si existe un usuario con un password
        public function checkusuario($login, $password)           
            Parámetros entrada:
            $login --> login del usuario que se va a chequear
            $password --> password del usuario que se va a chequear
            Salida:
            0 --> no existe usuario y password
            1 --> existe y es correcto
            2 --> existe y deshabilitado

        Datos de un usuario a partir del login del usuario
        public function usuario_id($login){       
            Parámetros entrada:
            $login --> login del usuario
            Salida:
            Array con los datos del usuario

        Devuelve los usuarios, resultado de la busqueda en campos con un determinado texto, ordenados por nombre
        public function buscar_usuario($array_datos)
            Parámetros entrada:
            $array_datos --> array con el texto de los campos de usuarios por los que se va a buscar
            Estos textos corresponden a los campos: login, nombre
            Salida:
            Array con los datos de los usuarios ordenados por nombre.

3.2.3. Vistas
=============
admin/<br/>

    actividades/<br/>
        add_actividades.php --> Añadir actividades<br/>
        buscar_actividad.php --> Muestra el resultado de las búsquedas</br>
        formbuscar_actividad.php --> Formulario para buscar actividades<br/>
        modificar_actividad.php --> Modificar actividades<br/>
        principal.php --> Principal tras un login correcto<br/>
                          Muestra actividades de un usuario<br/>

    usuarios/<br/>
        add_usuario.php --> Añadir usuarios<br/>
        buscar_usuario.php --> Muestra el resultado de las búsquedas</br>
        desconectar.php --> Desconexion o salida del usuario<br/>
        formbuscar_usuario.php --> Formulario para buscar usuarios<br/>
        modificar_usuarios.php --> Modificar usuario<br/>

    footer.php --> Pie de las páginas<br/>
    header.php --> Cabecera de las páginas<br/>
    index.php --> Entrada de usuario<br/>
    menu.php --> Menu<br/>
    principal.php --><br/> 

3.2.4 Librerias
===============
Librería_sesiones. Métodos:

        Comprobar si hay sesion
        public function comprobar_session()
            Salida:
            TRUE --> Si hay sesion iniciada.
            FALSE --> Si no hay sesion iniciada.

        Registrar una sesión de usuario
        public function registrar($estado, $idusuario)
            Parámetros entrada:
            $estado = true
            $idusuario = login del usuario que se va a registrar en la sesion.
            Salida:
            TRUE --> Si el registro de sesion es correcto.
            FALSE --> Si no es correcto.

        Des-registrar o des-logear al usuario
        public function des_registrar()
            Salida:
            TRUE --> Si el des-registro es correcto.
            FALSE --> Si no es correcto. 

        Devolver datos de una sesion
        public function devuelve_datos_session()
            Salida: Array con los datos de la sesion

        Meter datos en la sesion
        public function mete_datos_sesion($idsesion, $registrado, $login, $nombre, $acl)
            Parámetros entrada:
            $idsesion = el identificador que es el login
            $registrado = TRUE o FALSE, autoexplicativo
            $login = El login del usuario
            $nombre = el nombre real del usuario
            $acl = el identificador de acl 
            Salida:
            TRUE

3.3. Base de Datos
==================

Nombre de la Base de Datos: agenda
3.3.1 Características
=====================
    Default collation: utf8_spanish-ci
    Default characterset: utf8
    Número de Tablas: 6

3.3.2 Tablas
============

actividades
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos:
    idactividades: int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la actividad, UNICO',
    campanya: varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre de la campanya',
    actividad: varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la actividad',
    descripcion: text COLLATE utf8_spanish_ci COMMENT 'Descripcion de la actividad',
    organiza: varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombre del organizador u organizadores (separados por - )',
    lugar: varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Direccion donde tiene lugar la actividad',
    idbarrio: int(11) NOT NULL COMMENT 'ID del barrio donde se realiza la actividad',
    idseccion: int(11) NOT NULL COMMENT 'ID de la seccion a la que pertenece',
    fecha: datetime NOT NULL COMMENT 'Fecha y hora de comienzo de la actividad',
    usuario: varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'login del usuario',
    publicada: tinyint(1) DEFAULT '0' COMMENT 'Si esta publicada o no la actividad (1- Publicada,  0 - No publicada)',
    PRIMARY KEY (`idactividades`)

barrios
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos:
    idbarrios: int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del barrio, UNICO',
    nombre: varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del barrio',
    PRIMARY KEY (`idbarrios`)

documentos
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos:
    iddocumentos: int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del documento, UNICO',
    idactividad; int(11) NOT NULL COMMENT 'ID de la actividad a la que pertenece el documento',
    rutadocumento: varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta donde esta el documento ',
    descripcion: varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripcion del documento',
    PRIMARY KEY (`iddocumentos`)

imagenes
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos:    
    idimagenes: int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la imagen, UNICO',
    idactividad: int(11) NOT NULL COMMENT 'ID de la actividad a la que pertenece',
    rutaimagen: varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta donde esta la imagen',
    descripcion: varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripcion de la imagen',
    PRIMARY KEY (`idimagenes`)

secciones
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos: 
    idsecciones: int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la seccion, UNICO',
    nombre: varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la seccion',
    PRIMARY KEY (`idsecciones`)

usuarios
    Engine=MyISAM
    Default Charset=utf8
    Collate=utf8_spanish_ci

    campos: 
    login varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Login de entrada del usuario, UNICO',
    password varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Password. md5',
    nombre varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del usuario',
    idacl int(11) NOT NULL COMMENT 'Identificador de la ACL: 0-Disabled, 1-Super Administrador, 2-Redactor, 3-Editor',
    PRIMARY KEY (`login`)

4. Test/Pruebas
===============

4.1. Estrategias de las pruebas
===============================

4.2. Resultados
===============

5. Funcionacionamiento - Manual de Uso
======================================

5.1 Errores y limitaciones
==========================

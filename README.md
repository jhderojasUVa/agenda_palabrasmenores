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

Hito 1: Defininir el sistema tanto XXXXX como informaticamente
Hito 2: Creacion de la base de datos
Hito 3: Creacion de los modelos
Hito 4: Creacion de los controladores de gestion de usuario
Hito 5: Creacion de las vistas de gestion de usuairo
Hito 6: Creacion de los controladores de introduccion de datos
Hito 7: Creacion de las vistas de introduccionde datos
Hito 8: Creacion de los controladores de explotacion de datos
Hito 9: Creacion de las vistas de explotacion de datos
Hito 10: Baterias de pruebas con usuarios reales
Hito 11: Paso de modelos a REST
Hito 12: En las vistas paso a comprobaciones JS
Hito 13: Paso a framework JS
Hito 14: Test finales

La creacion de los hitos 4 y 5, 6 y 7, 8 y 9 van juntas.

2.3 Fases
=========
Las fases coinciden practicamente con los hitos.

3. Especificaciones
===================

3.1. Requisitos
===============
Aplicacion realizada en PHP usando el framework de Codeigniter.

Necesario un servidor LAMP tipico (Apache + PHP + MySQL).

3.2. Diseño
===========

3.2.1. Controladores
====================

3.2.2. Modelos
==============

3.2.3. Vistas
=============

3.3. Base de Datos
==================

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

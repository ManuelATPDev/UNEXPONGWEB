<?php

//informacion de la base de datos
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'unexpoweb');

//rutas de la pagina
define("SERVIDOR", "http://localhost/blog");
define("RUTA_ERROR", SERVIDOR . "/error");
define("RUTA_AVISO_LEGAL", SERVIDOR . "/aviso-legal");
define("RUTA_REGISTRO", SERVIDOR . "/registro");
define("RUTA_REGISTRO_CORRECTO", SERVIDOR . "/registro-correcto");
define("RUTA_LOGIN", SERVIDOR . "/login");
define("RUTA_LOGOUT", SERVIDOR . "/logout");
define("RUTA_INFORMACION_INDUSTRIAL", SERVIDOR . "/informacion-industrial");
define("RUTA_TRAMITES_DACE", SERVIDOR . "/tramites-DACE");
define("RUTA_SERVICIO_COMUNITARIO", SERVIDOR . "/servicio-comunitario");
define("RUTA_CULTURA", SERVIDOR . "/cultura");
define("RUTA_ENTRADA", SERVIDOR . "/entrada");
define("RUTA_GESTOR", SERVIDOR . "/gestiones");
define("RUTA_NUEVA_ENTRADA", SERVIDOR . "/nueva-entrada");
define("RUTA_NUEVO_TRAMITE", SERVIDOR . "/nuevo-tramite");
define("RUTA_BORRAR_ENTRADA", SERVIDOR . "/borrar-entrada");
define("RUTA_BORRAR_COMENTARIO", SERVIDOR . "/borrar-comentario");
define("RUTA_BORRAR_TRAMITE", SERVIDOR . "/borrar-tramite");
define("RUTA_EDITAR_ENTRADA", SERVIDOR . "/editar-entrada");
define("RUTA_GESTOR_GENERAL", RUTA_GESTOR . "/gestor-general");
define("RUTA_GESTOR_ENTRADAS", RUTA_GESTOR . "/tus-entradas");
define("RUTA_GESTOR_COMENTARIOS", RUTA_GESTOR . "/tus-comentarios");
define("RUTA_GESTOR_TRAMITES", RUTA_GESTOR . "/tus-tramites");
define("RUTA_RECUPERAR_CLAVE", SERVIDOR . "/recuperar-clave");
define("RUTA_GENERAR_URL_SECRETA", SERVIDOR . "/generar-url-secreta");
define("RUTA_CORREO_NO_RECIBIDO", SERVIDOR . "/correo-no-recibido");
define("RUTA_COMENTARIO_EXITOSO", SERVIDOR . "/comentario-publicado");
define("RUTA_RECUPERACION_CLAVE", SERVIDOR . "/reemplazar-clave");
define("RUTA_CAMBIO_CLAVE_EXITOSO", SERVIDOR . "/cambio-clave-exitoso");
define("RUTA_PETICION_FALLIDA", SERVIDOR . "/peticion-clave-fallido");
define("RUTA_PETICION_VALIDA", SERVIDOR . "/peticion-clave-satisfactorio");
define("RUTA_BUSCAR", SERVIDOR . "/buscar");
define("RUTA_PERFIL", SERVIDOR . "/perfil");

//recursos
define("RUTA_ICO", SERVIDOR . "/img/unex.ico");
define("RUTA_CSS", SERVIDOR . "/css/");
define("RUTA_JS", SERVIDOR . "/js/");
define("RUTA_FONT", SERVIDOR . "/fontawesome/css/");
define("DIRECTORIO_RAIZ", realpath(dirname(__FILE__) . "/.."));


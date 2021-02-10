<?php

session_start();

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';
include_once 'app/Tramite.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';
include_once 'app/RepositorioTramite.inc.php';

/* Funciones para poder determinar los distinvos valores que tendra la URL de la pagina en el buscador */

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'vistas/404.php';

if ($partes_ruta[0] == 'blog') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'vistas/home.php';
    } elseif (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'informacion-industrial':
                $ruta_elegida = 'vistas/informacion-industrial.php';
                break;
            case 'tramites-DACE':
                $ruta_elegida = 'vistas/tramites-DACE.php';
                break;
            case 'servicio-comunitario':
                $ruta_elegida = 'vistas/servicio-comunitario.php';
                break;
            case 'cultura':
                $ruta_elegida = 'vistas/cultura.php';
                break;
            case 'login':
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'aviso-legal':
                $ruta_elegida = 'vistas/aviso-legal.php';
                break;
            case 'logout':
                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'registro':
                $ruta_elegida = 'vistas/registro.php';
                break;
            case 'gestiones':
                $ruta_elegida = 'vistas/gestor.php';
                break;
            case 'relleno':
                $ruta_elegida = 'scripts/script-relleno.php';
                break;
            case 'nueva-entrada':
                $ruta_elegida = 'vistas/nueva-entrada.php';
                break;
            case 'nuevo-tramite':
                $ruta_elegida = 'vistas/nuevo-tramite.php';
                break;
            case 'borrar-entrada':
                $ruta_elegida = 'scripts/borrar-entrada.php';
                break;
            case 'borrar-comentario':
                $ruta_elegida = 'scripts/borrar-comentario.php';
                break;
            case 'borrar-tramite':
                $ruta_elegida = 'scripts/borrar-tramite.php';
                break;
            case 'editar-entrada':
                $ruta_elegida = 'vistas/editar-entrada.php';
                break;
            case 'recuperar-clave':
                $ruta_elegida = 'vistas/recuperar-clave.php';
                break;
            case 'generar-url-secreta':
                $ruta_elegida = 'scripts/generar-url-secreta.php';
                break;
            case 'correo-enviado-url-secreta':
                $ruta_elegida = 'vistas/generar-mail-url-secreta.php';
                break;
            case 'correo-enviado-tramite':
                $ruta_elegida = 'vistas/generar-mail-tramite.php';
                break;
            case 'comentario-publicado':
                $ruta_elegida = 'vistas/comentario-exitoso.php';
                break;
            case 'cambio-clave-exitoso':
                $ruta_elegida = 'vistas/cambio-clave-exitoso.php';
                break;
            case 'cambio-clave-exitoso':
                $ruta_elegida = 'vistas/cambio-clave-exitoso.php';
                break;
            case 'correo-no-recibido':
                $ruta_elegida = 'vistas/correo-no-recibido.php';
                break;
            case 'peticion-clave-satisfactorio':
                $ruta_elegida = 'vistas/peticion-clave-exitoso.php';
                break;
            case 'peticion-clave-fallido':
                $ruta_elegida = 'vistas/peticion-clave-fallido.php';
                break;
            case 'error':
                $ruta_elegida = 'vistas/404.php';
                break;
            case 'buscar':
                $ruta_elegida = 'vistas/buscar.php';
                break;
            case 'perfil':
                $ruta_elegida = 'vistas/perfil.php';
        }
    } elseif (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'registro-correcto') {
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registro-correcto.php';
        }
        if ($partes_ruta[1] == 'entrada') {
            $url = $partes_ruta[2];

            Conexion::abrir_conexion();
            $entrada = RepositorioEntrada::obtener_entrada_por_url(Conexion::obtener_conexion(), $url);

            if ($entrada != null) {
                $autor = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $entrada->obtener_autor_id());
                $comentarios = RepositorioComentario::obtener_comentarios(Conexion::obtener_conexion(), $entrada->obtener_id());
                $entradas_al_azar = RepositorioEntrada::obtener_entradas_al_azar(Conexion::obtener_conexion(), 3);

                $ruta_elegida = 'vistas/entrada.php';
            }
        }
        if ($partes_ruta[1] == 'gestiones') {
            switch ($partes_ruta[2]) {
                case 'gestor-general':
                    $gestor_actual = 'general';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'tus-entradas':
                    $gestor_actual = 'entradas';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'tus-comentarios':
                    $gestor_actual = 'comentarios';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'tus-tramites':
                    $gestor_actual = 'tramites';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
            }
        }

        if ($partes_ruta[1] == 'reemplazar-clave') {
            $url_personal = $partes_ruta[2];
            $ruta_elegida = 'vistas/recuperacion-clave.php';
        }
    }
}

include_once $ruta_elegida;


/*
if($partes_ruta[2] == 'registro'){
    include_once 'plantillas/documento-apertura.inc.php';
    include_once 'vistas/registro.php';
    include_once 'plantillas/documento-cierre.inc.php';
}elseif ($partes_ruta[2] == 'login') {
    include_once 'vistas/login.php';
} elseif ($partes_ruta[1] == 'blog') {
    include_once 'vistas/home.php';
} else{
    echo '404';
}
*/
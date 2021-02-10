<?php
include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/panel-control-apertura.inc.php';
include_once 'app/ControlSesion.inc.php';
if (ControlSesion::sesion_iniciada()) {
    ?>

    <head>
        <link rel="shortcut icon" href="<?php echo RUTA_CSS ?>unex.ico">
    </head>
    <?php
    switch ($gestor_actual) {
        case 'general':
            $cantidad_entradas_activas = RepositorioEntrada::contar_entradas_activas(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
            $cantidad_entradas_inactivas = RepositorioEntrada::contar_entradas_inactivas(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
            $cantidad_comentarios = RepositorioComentario::contar_comentarios(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
            $cantidad_tramites_activos = RepositorioTramite::contar_tramites_activos(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
            $cantidad_tramites_inactivos = RepositorioTramite::contar_tramites_inactivos(Conexion::obtener_conexion(), $_SESSION['id_usuario']);



            include_once 'plantillas/gestor-general.inc.php';
            break;
        case 'entradas':
            $array_entradas = RepositorioEntrada::obtener_entradas_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

            include_once 'plantillas/gestor-entradas.inc.php';
            break;
        case 'comentarios':
            $array_comentarios = RepositorioComentario::obtener_comentarios_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

            include_once 'plantillas/gestor-comentarios.inc.php';
            break;
        case 'tramites':
            $array_tramites = RepositorioTramite::obtener_tramites_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

            include_once 'plantillas/gestor-tramites.inc.php';
            break;
    }

    include_once 'plantillas/panel-control-cierre.inc.php';
    include_once 'plantillas/documento-cierre.inc.php';
    ?>
    <?php
} else {

    include_once 'app/Conexion.inc.php';
    include_once 'app/RepositorioUsuario.inc.php';

    $titulo = 'INICIA SESIÓN CON ANTERIORIDAD';

    include_once 'plantillas/documento-apertura.inc.php';
    include_once 'plantillas/navbar.inc.php';
    include_once 'plantillas/inicia_sesion_antes.inc.php';
    include_once 'plantillas/documento-cierre.inc.php';
}
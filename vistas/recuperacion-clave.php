<?php
include_once 'app/RepositorioRecuperacionClave.inc.php';
include_once 'app/ValidadorNuevaClave.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion :: abrir_conexion();

if (RepositorioRecuperacionClave::url_secreta_existe(Conexion::obtener_conexion(), $url_personal)) {
    $id_usuario = RepositorioRecuperacionClave::obtener_id_usuario_mediante_url(Conexion::obtener_conexion(), $url_personal);
    $url_id = RepositorioRecuperacionClave::obtener_id_de_url_por_url(Conexion::obtener_conexion(), $url_personal);

    if (isset($_POST['guardar-clave'])) {
        Conexion::abrir_conexion();
        $clave_nueva = new ValidadorNuevaClave($_POST['clave'], $_POST['clave2']);

        if ($clave_nueva->cambio_contraseña_valido()) {
            $clave_cifrada = password_hash($clave_nueva->obtener_clave(), PASSWORD_DEFAULT);
            $cambio_clave = RepositorioUsuario::actualizar_password(Conexion::obtener_conexion(), $id_usuario, $clave_cifrada);

            if ($cambio_clave) {
                include_once 'scripts/borrar-url-secreta.php';
                Redireccion::redirigir(RUTA_CAMBIO_CLAVE_EXITOSO);
            } else {
                echo RUTA_ERROR;
            }
        }
    }

    $titulo = 'REEMPLAZAR CONTRASEÑA';

    include_once 'plantillas/documento-apertura.inc.php';
    include_once 'plantillas/navbar.inc.php';
    ?>
    <!--Vista para cambiar la contraseña de un usuario de la pagina-->
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>INTRODUZCA UNA NUEVA CONTRASEÑA</h4>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action=<?php echo RUTA_RECUPERACION_CLAVE . "/" . $url_personal ?>>
                            <?php
                            if (isset($_POST['guardar-clave'])) {
                                include_once 'plantillas/form_clave_nueva_validado.inc.php';
                            } else {
                                include_once 'plantillas/form_clave_nueva_vacio.inc.php';
                            }
                            ?>
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <?php
} else {
    Redireccion::redirigir(RUTA_ERROR);
}
Conexion::cerrar_conexion();
include_once 'plantillas/documento-cierre.inc.php';
?>

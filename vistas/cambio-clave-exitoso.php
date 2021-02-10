<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'CAMBIO EXITOSO';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista del cambio correcto de la contraseña-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> CAMBIO DE CLAVE EXITOSO
                </div>
                <div class="panel-body text-center">
                    <p><a href="<?php echo RUTA_LOGIN ?>">Iniciar sesión</a> para utilizar los servicios de la UNEXPO</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>

</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

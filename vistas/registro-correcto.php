<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Redireccion.inc.php';


$titulo = '!REGISTRADO SATISFACTORIAMENTE!';

$trans = array('-' => ' ', '%C3%B1' => 'ñ', '%C3%81' => 'Á', '%C3%89' => 'É', '%C3%8D' => 'Í', '%C3%93' => 'Ó', '%C3%9A' => 'Ú',
    '%C3%A1' => 'á', '%C3%A9' => 'é', '%C3%AD' => 'í', '%C3%B3' => 'ó', '%C3%BA' => 'ú');
$nombre = strtr($nombre, $trans);

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista para el registro correcto de un usuario-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> REGISTRADO SATISFACTORIAMENTE
                </div>
                <div class="panel-body text-center">
                    <p>!BIENVENIDO A LA UNEXPO <b><?php echo $nombre ?></b>!</p>
                    <br>
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

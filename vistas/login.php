<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {
    Conexion::abrir_conexion();

    $entrada_recuperada = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtener_conexion());

    if ($entrada_recuperada->obtener_error() === '' && !is_null($entrada_recuperada->obtener_usuario())) {
        ControlSesion::iniciar_sesion($entrada_recuperada->obtener_usuario()->obtener_id(), $entrada_recuperada->obtener_usuario()->obtener_nombre());
        Redireccion::redirigir(SERVIDOR);
    } else {
        echo "<br><div class='alert alert-danger' role='alert'>Ha ocurrio un error, por favor revise los campos de los datos.</div>";
    }

    Conexion::cerrar_conexion();
}

$titulo = "INICIAR SESIÓN";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista para iniciar sesion en la pagina-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>INICIAR SESIÓN</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action=<?php echo RUTA_LOGIN ?>>
                        <h3 class="text-center">Introduce tus datos:</h3>
                        <br>
                        <label for="email" class="sr-only">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="usuario@mail.com" 
                        <?php
                        if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                            echo 'value="' . $_POST['email'] . '"';
                        }
                        ?> 
                               required autofocus>
                        <br>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <br>
                        <div class="text-center">
                            <?php
                            if (isset($_POST['login'])) {
                                $entrada_recuperada->mostrar_error();
                            }
                            ?>
                        </div>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                            Iniciar sesion
                        </button>
                    </form>
                    <br>
                    <br>
                    <div class="text-center">
                        <a href="<?php echo RUTA_RECUPERAR_CLAVE; ?>">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
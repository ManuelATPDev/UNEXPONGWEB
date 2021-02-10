<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();
    switch ($_POST['especialidad']) {
        case "Mecatrónica":
            $tipo1 = "Mecatrónica";
            break;
        case "Industrial":
            $tipo2 = "Industrial";
            break;
        case "Mecánica":
            $tipo3 = "Mecánica";
            break;
        case "Sistemas":
            $tipo4 = "Sistemas";
            break;
        case "TSU Mecánica":
            $tipo5 = "TSU Mecánica";
            break;
    }

    $entrada_recuperada = new ValidadorRegistro($_POST['nombre'], $_POST['apellido'], $_POST['cedula'], $_POST['expediente'], $_POST['especialidad'], $_POST['email'], $_POST['clave'], $_POST['clave2'], Conexion :: obtener_conexion());

    if ($entrada_recuperada->registro_valido()) {
        $usuario = new Usuario('', $entrada_recuperada->obtener_nombre(), $entrada_recuperada->obtener_apellido(), $entrada_recuperada->obtener_cedula(), $entrada_recuperada->obtener_expediente(), $entrada_recuperada->obtener_especialidad(), $entrada_recuperada->obtener_email(), password_hash($entrada_recuperada->obtener_clave(), PASSWORD_DEFAULT), '', '');
        $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(), $usuario);

        if ($usuario_insertado) {
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario->obtener_nombre() . '-' . $usuario->obtener_apellido());
        }
    } else {
        echo "<br><div class='alert alert-danger' role='alert'>Ha ocurrio un error, por favor revise los campos del registro.</div>";
    }

    Conexion :: cerrar_conexion();
}

$titulo = 'REGISTRO';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista para insertar un usuario en la pagina-->
<head>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>estilos.css" type="text/css">
</head>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"> BIENVENIDO A LA UNEXPO</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        A TENER EN CUENTA:
                    </h3>
                </div>
                <div class="panel-body">
                    <a href="<?php echo RUTA_LOGIN ?>">¿Ya estás registrado?</a>
                    <br>
                    <br>
                    <a href="<?php echo RUTA_RECUPERAR_CLAVE; ?>">¿Olvidaste la contraseña?</a>
                </div>
            </div>
        </div>
        <div class="col-md-9 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        INTRODUCE TUS DATOS:
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<footer>
    <nav class="navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
                    UNEXPO Núcleo Guarenas
                </a>
            </div>
            <div id="navbar" class="text-center">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo RUTA_AVISO_LEGAL ?>"><i class="fas fa-balance-scale"></i> Aviso Legal y Contacto</a></li>  
                </ul>
            </div>
        </div>
    </nav>
</footer>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
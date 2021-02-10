<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/ValidadorEntrada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$tipo1 = null;
$tipo2 = null;
$tipo3 = null;
$tipo4 = null;
$tipo5 = null;


$entrada_publica = 0;
if (isset($_POST['guardar'])) {
    Conexion :: abrir_conexion();

    switch ($_POST['tipo']) {
        case "General":
            $tipo1 = "General";
            break;
        case "informacion_industrial":
            $tipo2 = "informacion_industrial";
            break;
        case "tramites_DACE":
            $tipo3 = "tramites_DACE";
            break;
        case "servicio_comunitario":
            $tipo4 = "servicio_comunitario";
            break;
        case "cultura":
            $tipo5 = "cultura";
            break;
    }

    $entrada_recuperada = new ValidadorEntrada($_POST['titulo'], $_POST['url'], htmlspecialchars($_POST['texto']), Conexion::obtener_conexion());

    if ($entrada_recuperada->entrada_valida()) {
        if (ControlSesion::sesion_iniciada()) {

            $entrada = new Entrada('', $_SESSION['id_usuario'], $entrada_recuperada->obtener_url(), $entrada_recuperada->obtener_titulo(), $entrada_recuperada->obtener_texto(), $_POST['tipo'], '', 0);

            $entrada_insertada = RepositorioEntrada::insertar_entrada(Conexion::obtener_conexion(), $entrada);
            if ($entrada_insertada) {
                Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }
        } else {
            Redireccion::redirigir(RUTA_LOGIN);
        }

        Conexion::cerrar_conexion();
    }
}

$titulo = 'NUEVA ENTRADA';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista para insertar una nueva publicacion en la pagina-->
<head>
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>estilos.css" type="text/css">
</head>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"> Crear nueva entrada</h1>
    </div>
</div>

<div class="container" id="nueva-entrada">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" action="<?php echo RUTA_NUEVA_ENTRADA ?>">
                <?php
                if (isset($_POST['guardar'])) {
                    include_once 'plantillas/form_nueva_entrada_validado.inc.php';
                } else {
                    include_once 'plantillas/form_nueva_entrada_vacio.inc.php';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
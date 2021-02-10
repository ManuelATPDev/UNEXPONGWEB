<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/ValidadorEntradaEditada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();

if (isset($_POST['guardar_cambios'])) {
    $entrada_publica_nueva = 0;

    switch ($_POST['tipo']) {
        case "General":
            $tipo1 = "General";
            $tipo2 = null;
            $tipo3 = null;
            $tipo4 = null;
            $tipo5 = null;
            break;
        case "informacion_industrial":
            $tipo2 = "informacion_industrial";
            $tipo1 = null;
            $tipo3 = null;
            $tipo4 = null;
            $tipo5 = null;
            break;
        case "tramites_DACE":
            $tipo3 = "tramites_DACE";
            $tipo2 = null;
            $tipo1 = null;
            $tipo4 = null;
            $tipo5 = null;
            break;
        case "servicio_comunitario":
            $tipo4 = "servicio_comunitario";
            $tipo2 = null;
            $tipo3 = null;
            $tipo1 = null;
            $tipo5 = null;
            break;
        case "cultura":
            $tipo5 = "cultura";
            $tipo2 = null;
            $tipo3 = null;
            $tipo4 = null;
            $tipo1 = null;
            break;
    }

    $validador = new ValidadorEntradaEditada($_POST['titulo'], $_POST['titulo_original'], $_POST['url'], $_POST['url_original'], htmlspecialchars($_POST['texto']), $_POST['texto_original'], Conexion::obtener_conexion());

    if (!$validador->hay_cambios()) {
        Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
    } else {
        if ($validador->entrada_valida()) {
            $cambio_realizado = RepositorioEntrada::actualizar_entrada(Conexion::obtener_conexion(), $_POST['id_entrada'], $validador->obtener_titulo(), $validador->obtener_url(), $validador->obtener_texto(), $_POST['tipo']);

            if ($cambio_realizado) {
                Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }
        }
    }
}

$titulo = "EDITAR ENTRADA";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista para editar una publicacion del usuario-->

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"> Editar entrada </h1>
    </div>
</div>
<div class="container" id="nueva-entrada">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" action="<?php echo RUTA_EDITAR_ENTRADA ?>">
                <?php
                if (isset($_POST['editar_entrada'])) {
                    $id_entrada = $_POST['id_editar'];

                    $entrada_recuperada = RepositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(), $id_entrada);

                    include_once 'plantillas/form_entrada_recuperada.inc.php';

                    Conexion::cerrar_conexion();
                } elseif (isset($_POST['guardar_cambios'])) {
                    $id_entrada = $_POST['id_entrada'];

                    $entrada_recuperada = RepositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(), $id_entrada);

                    include_once 'plantillas/form_entrada_recuperada_validada.inc.php';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
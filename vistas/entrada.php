<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';
include_once 'app/ValidadorComentario.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['guardar_comentario'])) {
    Conexion :: abrir_conexion();
    $comentario_recuperado = new ValidadorComentario($_POST['titulo_comentario'], htmlspecialchars($_POST['texto_comentario']), Conexion :: obtener_conexion());

    if ($comentario_recuperado->comentario_valido()) {

        $comentario = new Comentario('', $_SESSION['id_usuario'], $entrada->obtener_id(), $comentario_recuperado->obtener_titulo_comentario(), $comentario_recuperado->obtener_texto_comentario(), '');
        $comentario_insertado = RepositorioComentario :: insertar_comentario(Conexion :: obtener_conexion(), $comentario);

        if ($comentario_insertado) {
            Redireccion::redirigir(RUTA_COMENTARIO_EXITOSO);
        }
    } else {
        echo "<br><div class='alert alert-danger' role='alert'>Ha ocurrio un error, por favor revise el comentario.</div>";
    }
    Conexion :: cerrar_conexion();
}

$titulo = $entrada->obtener_titulo();

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista de las entradas de la pagina-->

<br>
<div class="container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                <?php echo $entrada->obtener_titulo(); ?>
            </h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                Por:
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $autor->obtener_nombre(); ?>
                el:
                <?php echo $entrada->obtener_fecha(); ?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify">
                <h3><?php echo nl2br($entrada->obtener_texto()); ?></h3>
            </article>
        </div>
    </div>
    <?php
    include_once 'plantillas/entradas_al_azar.inc.php';
    ?>
    <br>
    <?php
    if (count($comentarios) > 0) {
        include_once 'plantillas/comentarios_entrada.inc.php';
    } else {
        echo '<label>Todavia no hay comentarios, ¡Sé el primero!</label>';
        ?>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#new_comentario">
                    <i class="fas fa-comment-medical"></i>  Crear Comentario
                </button>
                <br>
                <br>
                <div id="new_comentario" class="collapse">
                    <?php if (ControlSesion::sesion_iniciada()) {
                        ?>
                        <br>
                        <form role="form" method="post" action="<?php echo RUTA_ENTRADA . '/' . $entrada->obtener_url() ?>">
                            <?php
                            if (isset($_POST['guardar_comentario'])) {
                                include_once 'plantillas/form_nuevo_comentario_validado.inc.php';
                            } else {
                                include_once 'plantillas/form_nuevo_comentario_vacio.inc.php';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="text-center">    
                <p><a href="<?php echo RUTA_LOGIN ?>">Iniciar sesión</a> para utilizar los servicios de la UNEXPO</p>
            </div>
        <?php } ?>
        <?php
    }
    ?>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
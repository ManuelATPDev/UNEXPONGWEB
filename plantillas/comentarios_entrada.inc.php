<?php ?>
<!--Vista de los comentarios que seran colocados en cada publicacion-->
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comentarios">
            <i class="fas fa-comments"></i> <?php echo 'Ver comentarios (' . count($comentarios) . ')' ?>
        </button>
        <br>
        <br>
        <div id="comentarios" class="collapse">
            <?php
            for ($i = 0; $i < count($comentarios); $i++) {
                $comentario = $comentarios[$i];
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $comentario->obtener_titulo(); ?>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <?php
                                    $id = $comentario->obtener_autor_id();
                                    Conexion :: abrir_conexion();
                                    $usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $id);
                                    Conexion :: cerrar_conexion();
                                    ?>
                                    <?php echo $usuario->obtener_nombre(); ?>
                                </div>
                                <div class="col-md-10">
                                    <p>
                                        <?php
                                        echo $comentario->obtener_fecha();
                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                        echo nl2br($comentario->obtener_texto());
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>

<!--Vista para crear los comentarios que seran colocados en cada publicacion-->
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#new_comentario">
            <i class="fas fa-comment-medical"></i> Crear Comentario
        </button>
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

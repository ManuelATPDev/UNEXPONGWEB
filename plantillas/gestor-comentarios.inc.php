<!--vista del gestor de comentarios de los datos obtenidos en la base de datos de la seccion de comentarios-->
<div class="row ">
    <div class="col-md-12 parte-gestor-entrada">
        <h2>Gestión de comentarios</h2>
        <br>
    </div>
    <div class="row parte-gestor-entrada">
        <div class="col-md-12">
            <?php
            if (count($array_comentarios) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Titulo de la publicacion en donde realizaste el comentario</th>
                            <th>Título del comentario públicado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($array_comentarios); $i++) {
                            $comentario_actual = $array_comentarios[$i][0];
                            ?>
                            <tr>
                                <td><?php echo $comentario_actual->obtener_fecha() ?></td>
                                <td>
                                    <?php
                                    $id = $comentario_actual->obtener_entrada_id();
                                    Conexion::abrir_conexion();
                                    $entrada = RepositorioEntrada::obtener_entrada_por_id(Conexion::obtener_conexion(), $id);
                                    Conexion::cerrar_conexion();
                                    ?>
                                    <?php echo $entrada->obtener_titulo() ?></td>
                                </td>
                                <td><?php echo $comentario_actual->obtener_titulo() ?></td>
                                <td>
                                    <form method="post" action="<?php echo RUTA_BORRAR_COMENTARIO; ?>">
                                        <input type="hidden" name="id_borrar_comentario" value="<?php echo $comentario_actual->obtener_id(); ?>">
                                        <button type="submit" class="btn btn-default btn-xs" name="borrar_comentario"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <h3 class="text-center">Todavía no tienes comentarios</h3>
                <br>
                <br>
                <?php
            }
            ?>
        </div>
    </div>
</div>


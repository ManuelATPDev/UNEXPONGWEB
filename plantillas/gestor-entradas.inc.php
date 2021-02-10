<!--vista del gestor de entradas de los datos obtenidos en la base de datos de la seccion de entradas-->
<div class="row ">
    <div class="col-md-12 parte-gestor-entrada">
        <h2>Gestión de entradas</h2>
        <br>
        <a href="<?php echo RUTA_NUEVA_ENTRADA ?>" class="btn btn-lg btn-primary" role="button" id="boton_entrada"><i class="fas fa-pen-square"></i> Crear nueva entrada</a>
        <br>
        <br>
    </div>
    <div class="row parte-gestor-entrada">
        <div class="col-md-12">
            <?php
            if (count($array_entradas) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Comentarios</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($array_entradas); $i++) {
                            $entrada_actual = $array_entradas[$i][0];
                            $comentarios_entrada_actual = $array_entradas[$i][1];
                            ?>
                            <tr>
                                <td><?php echo $entrada_actual->obtener_fecha() ?></td>
                                <td><?php echo $entrada_actual->obtener_titulo() ?></td>
                                <td>
                                    <?php
                                    $activa = $entrada_actual->esta_activa();
                                    if ($activa == 1) {
                                        ?>
                                        <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $comentarios_entrada_actual; ?></td>
                                <td>
                                    <form method="post" action="<?php echo RUTA_EDITAR_ENTRADA; ?>">
                                        <input type="hidden" name="id_editar" value="<?php echo $entrada_actual->obtener_id(); ?>">
                                        <button type="submit" class="btn btn-default btn-xs" name="editar_entrada"><i class="fas fa-edit"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="<?php echo RUTA_BORRAR_ENTRADA; ?>">
                                        <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual->obtener_id(); ?>">
                                        <button type="submit" class="btn btn-default btn-xs" name="borrar_entrada"><i class="fas fa-trash-alt"></i></button>
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
                <h3 class="text-center">Todavía no tienes entradas</h3>
                <br>
                <br>
                <?php
            }
            ?>
        </div>
    </div>
</div>

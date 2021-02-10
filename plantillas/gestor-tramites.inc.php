<!--vista del gestor de tramites de los datos obtenidos en la base de datos de la seccion de tramites-->
<div class="row ">
    <div class="col-md-12 parte-gestor-entrada">
        <h2>Gestión de trámites</h2>
        <br>
        <a href="<?php echo RUTA_NUEVO_TRAMITE ?>" class="btn btn-lg btn-primary" role="button" id="boton_entrada"><i class="fas fa-file-alt"></i> Crear nuevo tramite</a>
        <br>
        <br>
    </div>
    <div class="row parte-gestor-entrada">
        <div class="col-md-12">
            <?php
            if (count($array_tramites) > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>N° de Referencia</th>
                            <th>Estado</th>
                            <th>Tipo(s)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($array_tramites); $i++) {
                            $tramite_actual = $array_tramites[$i][0];
                            ?>
                            <tr>
                                <td><?php echo $tramite_actual->obtener_fecha() ?></td>
                                <td><?php echo $tramite_actual->obtener_referencia_tramite() ?></td>
                                <td><?php
                                    $activo = $tramite_actual->esta_tramite_activo();
                                    if ($activo == 1) {
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
                                <td><?php echo $tramite_actual->obtener_tipo() ?></td>
                                <td>
                                    <form method="post" action="<?php echo RUTA_BORRAR_TRAMITE; ?>">
                                        <input type="hidden" name="id_borrar_tramite" value="<?php echo $tramite_actual->obtener_id(); ?>">
                                        <button type="submit" class="btn btn-default btn-xs" name="borrar_tramite"><i class="fas fa-trash-alt"></i></button>
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
                <h3 class="text-center">Todavía no tienes trámites</h3>
                <br>
                <br>
                <?php
            }
            ?>
        </div>
    </div>
</div>

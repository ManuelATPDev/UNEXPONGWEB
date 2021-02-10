<?php
include_once 'app/EscritorEntradas.inc.php';
include_once 'plantillas/documento-apertura.inc.php';
?>

<!--Vista de otras entradas que seran colocados en cada publicacion-->
<div class="row">
    <div class="col-md-12">
        <br>
        <h4>
            Otras entradas que te podrian interesar:
        </h4>
        <br>
    </div>

    <?php
    for ($i = 0; $i < count($entradas_al_azar); $i++) {
        $entradas_actual = $entradas_al_azar[$i];
        ?>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fas fa-quote-left"></i>
                    <?php
                    echo $entradas_actual->obtener_titulo();
                    ?>
                </div>
                <div class="panel-body">
                    <div>
                        <strong>
                            <?php
                            echo $entradas_actual->obtener_fecha();
                            ?>
                        </strong>
                    </div>
                    <div class="text-justify">
                        <?php
                        echo (EscritorEntradas::resumir_texto(nl2br($entradas_actual->obtener_texto())));
                        ?>
                        <i class="fas fa-quote-right"></i></div>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary"  href="<?php echo RUTA_ENTRADA . '/' . $entradas_actual->obtener_url() ?>" role="button">Leer</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
    <div class="col-md-12">
        <hr>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
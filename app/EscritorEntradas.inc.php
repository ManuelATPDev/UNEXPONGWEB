<?php
/* Se incluyen la conexion para obtener conexion con la base de datos,
  se incluye la entrada para obtener las variables que seran insertadas
  y se incluye el repositorioEntrada para insertar los datos de las variables en la base de datos */

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/Entrada.inc.php';

/* Creamos la clase EscritorEntradas para manejar los distintos metodos relacionados 
  a las entradas publicadas en la pagina */

class EscritorEntradas {
    /* Metodo escribir_entradas_tipo para mostrar las entradas correspondientes a cada seccion de la pagina
      y poder paginarlas */

    public static function escribir_entradas_tipo($tipo) {
        $total_entradas = RepositorioEntrada::paginador_tipo(Conexion::obtener_conexion(), $tipo);
        $por_pagina = 10;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $por_pagina . "," . $por_pagina;
        $total_paginas = ceil($total_entradas / $por_pagina);
        $entradas = RepositorioEntrada::obtener_todas_por_tipo_descendiente(Conexion::obtener_conexion(), $tipo, $desde);
        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribir_entrada_tipo($entrada);
            }
        }
    }

    /* Metodo escribir_entrada_tipo para mostrar todo el contenido de la entrada correspondiente 
      a la entrada solicitada en escribir_entradas_tipo */

    public static function escribir_entrada_tipo($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fas fa-quote-left"></i>
                        <?php
                        echo $entrada->obtener_titulo();
                        ?>
                    </div>
                    <div class="panel-body">
                        <div>
                            <strong>
                                <?php
                                echo $entrada->obtener_fecha();
                                ?>
                            </strong>
                        </div>
                        <div class="text-justify">
                            <?php
                            echo nl2br(self::resumir_texto($entrada->obtener_texto()));
                            ?>
                            <i class="fas fa-quote-right"></i></div>
                        <br>
                        <div class="text-center">
                            <a class="btn btn-primary"  href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtener_url() ?>" role="button">Leer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /* Metodo escribir_entradas para mostrar todas las entradas de la pagina
      y poder paginarlas */

    public static function escribir_entradas() {
        $total_entradas = RepositorioEntrada::paginador(Conexion::obtener_conexion());
        $por_pagina = 10;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $por_pagina . "," . $por_pagina;
        $total_paginas = ceil($total_entradas / $por_pagina);
        $entradas = RepositorioEntrada::obtener_todas_por_fecha_descendiente(Conexion::obtener_conexion(), $desde);
        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribir_entrada($entrada);
            }
        }
    }

    /* Metodo escribir_entrada para mostrar todo el contenido de la entrada correspondiente 
      a la entrada solicitada en escribir_entradas */

    public static function escribir_entrada($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fas fa-quote-left"></i>
                        <?php
                        echo $entrada->obtener_titulo();
                        ?>
                    </div>
                    <div class="panel-body">
                        <div>
                            <strong>
                                <?php
                                echo $entrada->obtener_fecha();
                                ?>
                            </strong>
                        </div>
                        <div class="text-justify">
                            <?php
                            echo nl2br(self::resumir_texto($entrada->obtener_texto()));
                            ?>
                            <i class="fas fa-quote-right"></i></div>
                        <br>
                        <div class="text-center">
                            <a class="btn btn-primary"  href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtener_url() ?>" role="button">Leer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /* Metodo mostrar_entradas_busqueda para mostrar todas las entradas de la pagina
      cuando el usuario oprima el boton de buscar en la pagina */

    public static function mostrar_entradas_busqueda($entradas) {
        for ($i = 1; $i <= count($entradas); $i++) {
            if ($i % 3 == 0) {
                ?>
                <div class="row">
                    <?php
                }

                $entrada = $entradas [$i - 1];
                self::mostrar_entrada_busqueda($entrada);

                if ($i % 3 == 0) {
                    ?>
                </div>
                <?php
            }
        }
    }

    /* Metodo mostrar_entrada_busqueda para mostrar todo el contenido de las entradas correspondiente 
      a las entradas solicitadas en mostrar_entradas_busqueda */

    public static function mostrar_entrada_busqueda($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>


        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
        <?php
        echo $entrada->obtener_titulo();
        ?>
                </div>
                <div class="panel-body">
                    <div>
                        <strong>
        <?php
        echo $entrada->obtener_fecha();
        ?>
                        </strong>
                    </div>
                    <div class="text-justify">
        <?php
        echo nl2br(self::resumir_texto($entrada->obtener_texto()));
        ?>
                    </div>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary"  href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtener_url() ?>" role="button">Leer</a>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }

    /* Metodo mostrar_entradas_busqueda_multiple para mostrar todas las entradas de la pagina
      cuando el usuario oprima el boton de busqueda avanzada en la pagina */

    public static function mostrar_entradas_busqueda_multiple($entradas) {
        for ($i = 0; $i < count($entradas); $i++) {
            ?>
            <div class="row">
            <?php
            $entrada = $entradas [$i];
            self::mostrar_entrada_busqueda_multiple($entrada);
            ?>
            </div>
            <?php
        }
    }

    /* Metodo mostrar_entrada_busqueda_multiple para mostrar todo el contenido de las entradas correspondiente 
      a las entradas solicitadas en mostrar_entradas_busqueda_multiple */

    public static function mostrar_entrada_busqueda_multiple($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                            <?php
                            echo $entrada->obtener_titulo();
                            ?>
                </div>
                <div class="panel-body">
                    <div>
                        <strong>
                        <?php
                        echo $entrada->obtener_fecha();
                        ?>
                        </strong>
                    </div>
                    <div class="text-justify">
        <?php
        echo nl2br(self::resumir_texto($entrada->obtener_texto()));
        ?>
                    </div>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary"  href="<?php echo RUTA_ENTRADA . '/' . $entrada->obtener_url() ?>" role="button">Leer</a>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }

    //Metodo para resumir los textos en cada entrada
    public static function resumir_texto($texto) {
        $longitud_maxima = 400;

        $resultado = '';

        if (strlen($texto) >= $longitud_maxima) {
            /*
              for ($i=0; $i < $longitud_maxima; $i++){
              $resultado .= substr($texto, $i, 1);
              }
             */

            $resultado = substr($texto, 0, $longitud_maxima);

            $resultado .= '...';
        } else {
            $resultado = $texto;
        }
        return $resultado;
    }

}

<?php
include_once 'plantillas/documento-apertura.inc.php';
include_once 'app/EscritorEntradas.inc.php';
include_once 'app/Redireccion.inc.php';

$busqueda = null;

$resultados = null;
$resultados_avanzados = null;

$buscar_titulo = false;
$buscar_contenido = false;
$buscar_autor = false;

$campos = array();

if (isset($_POST['buscar']) && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar']) || isset($_GET['pagina'])) {

    if (isset($_GET['pagina'])) {
        $busqueda = "";
    } else {
        $busqueda = $_POST['termino-buscar'];
    }
    Conexion::abrir_conexion();

    $total_entradas = RepositorioEntrada::paginador_todos_los_campos(Conexion::obtener_conexion(), $busqueda);

    $por_pagina = 20;

    if (empty($_GET['pagina'])) {
        $pagina = 1;
        $busqueda = $_POST['termino-buscar'];
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $por_pagina . "," . $por_pagina;
    $total_paginas = ceil($total_entradas / $por_pagina);

    $resultados = RepositorioEntrada::buscar_entradas_todos_los_campos(Conexion::obtener_conexion(), $busqueda, $desde);

    Conexion::cerrar_conexion();
}

if (isset($_POST['busqueda_avanzada']) && isset($_POST['campos']) && !empty($_POST['campos'])) {

    if (in_array("titulo", $_POST['campos'])) {
        $buscar_titulo = true;
    }

    if (in_array("contenido", $_POST['campos'])) {
        $buscar_contenido = true;
    }

    if (in_array("autor", $_POST['campos'])) {
        $buscar_autor = true;
    }

    if ($_POST['fecha'] == "recientes") {
        $orden = "DESC";
    }
    if ($_POST['fecha'] == "antiguas") {
        $orden = "ASC";
    }

    if (isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
        $busqueda = $_POST['termino-buscar'];

        Conexion::abrir_conexion();

        if ($buscar_titulo) {
            if ($buscar_contenido == false) {
                $entradas_por_contenido = null;
            }
            if ($buscar_autor == false) {
                $entradas_por_autor = null;
            }
            $entradas_por_titulo = RepositorioEntrada::buscar_entradas_por_titulo(Conexion::obtener_conexion(), $busqueda, $orden);
            $resultados_avanzados_titulo = $entradas_por_titulo;
        }

        if ($buscar_contenido) {
            if ($buscar_titulo == false) {
                $entradas_por_titulo = null;
            }
            if ($buscar_autor == false) {
                $entradas_por_autor = null;
            }
            $entradas_por_contenido = RepositorioEntrada::buscar_entradas_por_contenido(Conexion::obtener_conexion(), $busqueda, $orden);
            $resultados_avanzados_contenido = $entradas_por_contenido;
        }

        if ($buscar_autor) {
            if ($buscar_contenido == false) {
                $entradas_por_contenido = null;
            }
            if ($buscar_titulo == false) {
                $entradas_por_titulo = null;
            }
            $entradas_por_autor = RepositorioEntrada::buscar_entradas_por_autor(Conexion::obtener_conexion(), $busqueda, $orden);
            $resultados_avanzados_autor = $entradas_por_autor;
        }

        Conexion::cerrar_conexion();
    }
} else {
    $entradas_por_contenido = null;
    $entradas_por_titulo = null;
    $entradas_por_autor = null;
    $orden = "DESC";
}

$titulo = "Buscar en UnexpoNGWeb";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista del buscador de la pagina-->
<div class="container">
    <div class="row">
        <div class="jumbotron">
            <h1 class="text-center"> Buscar en UnexpoNGWeb</h1>
            <br>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                        <div class="form-group">
                            <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?" required <?php echo "value='" . $busqueda . "'" ?>>
                        </div>
                        <button type="submit" name="buscar" class="form-control btn btn-primary btn-buscar">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Vista del buscador avanzado de la pagina-->
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Búsqueda avanzada<a data-toggle="collapse" href="#avanzada"> <span class="glyphicon glyphicon-filter" aria-hidden="true"></span></a>
                    </h4>
                </div>
                <div id="avanzada" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                            <div class="form-group">
                                <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?" required <?php echo "value='" . $busqueda . "'" ?>>
                            </div>
                            <p>Buscar en los siguientes campos:</p>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="titulo" name="campos[]"
                                <?php
                                if (isset($_POST['busqueda_avanzada'])) {
                                    if ($buscar_titulo) {
                                        echo "checked";
                                    }
                                } else {
                                    echo "checked";
                                }
                                ?>
                                       >Título
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="contenido" name="campos[]" 
                                <?php
                                if (isset($_POST['busqueda_avanzada'])) {
                                    if ($buscar_contenido) {
                                        echo "checked";
                                    }
                                } else {
                                    echo "checked";
                                }
                                ?>
                                       >Contenido
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="autor" name="campos[]" 
                                <?php
                                if (isset($_POST['busqueda_avanzada'])) {
                                    if ($buscar_autor) {
                                        echo "checked";
                                    }
                                }
                                ?>
                                       >Autor
                            </label>
                            <br>
                            <br>
                            <p>Ordenar por:</p>
                            <label class="radio-inline">
                                <input type="radio" name="fecha"  value="recientes" 
                                <?php
                                if (isset($_POST['busqueda_avanzada']) && isset($orden) && $orden == 'DESC') {
                                    echo "checked";
                                }

                                if (!isset($_POST['busqueda_avanzada'])) {
                                    echo "checked";
                                }
                                ?>
                                       >Entradas más recientes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="fecha" value="antiguas" 
                                <?php
                                if (isset($_POST['busqueda_avanzada']) && isset($orden) && $orden == 'ASC') {
                                    echo 'checked';
                                }
                                ?>
                                       >Entradas más antigüas
                            </label>
                            <br>
                            <br>
                            <button type="submit" name="busqueda_avanzada" class="btn btn-primary btn-buscar">Búsqueda avanzada</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Vista de los resultados del buscador de la pagina-->
<div class="container" id="resultados">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Resultados:
                    <?php
                    if (isset($_POST['buscar']) && $resultados || isset($_GET['pagina'])) {
                        echo " ";
                        ?>
                        <small><?php echo count($resultados); ?></small>
                        <?php
                    }
                    ?>
                    <i class="fas fa-newspaper"></i></h1>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['buscar']) || isset($_GET['pagina'])) {
        if ($resultados) {
            EscritorEntradas::mostrar_entradas_busqueda($resultados);
            ?>
            <div class="paginador">
                <ul>
                    <?php
                    if ($pagina != 1) {
                        ?>
                        <li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-angle-double-left"></i></a></li>
                        <li><a href="?pagina=<?php echo $pagina - 1; ?>"><i class="fas fa-angle-left"></i></a></li>
                        <?php
                    }
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="pageSelected">' . $i . '</li>';
                        } else {
                            echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($pagina != $total_paginas) {
                        ?>

                        <li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fas fa-angle-right"></i></a></li>
                        <li><a href="?pagina=<?php echo $total_paginas; ?>"><i class="fas fa-angle-double-right"></i></a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            ?>
            <h3>No hay Coincidencias</h3>
            <br>
            <br>
            <?php
        }
    } else if (isset($_POST['busqueda_avanzada'])) {
        if ($entradas_por_titulo || $entradas_por_contenido || $entradas_por_autor) {
            $parametros = count($_POST['campos']);
            $ancho_columnas = 12 / $parametros;
            ?>
            <div class="row">
                <?php
                for ($i = 0; $i < $parametros; $i++) {
                    ?>
                    <div class="<?php echo 'col-md-' . $ancho_columnas; ?> text center">
                        <h4><?php echo 'Coincidencias en ' . $_POST['campos'][$i]; ?> <?php
                            switch ($_POST['campos'][$i]) {
                                case "titulo":
                                    echo ": ";
                                    ?><?php
                                    echo count($resultados_avanzados_titulo);
                                    break;
                                case "contenido":
                                    echo ": ";
                                    ?><?php
                                    echo count($resultados_avanzados_contenido);
                                    break;
                                case "autor":
                                    echo ": ";
                                    ?><?php
                                    echo count($resultados_avanzados_autor);
                                    break;
                            }
                            ?></h4>
                        <br>
                        <br>
                        <?php
                        switch ($_POST['campos'][$i]) {
                            case "titulo":
                                EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_titulo);
                                break;
                            case "contenido":
                                EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_contenido);
                                break;
                            case "autor":
                                EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_autor);
                                break;
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            ?>
            <h3>No hay coincidencias</h3>
            <br>
            <br>
            <?php
        }
    }
    ?>
</div>
<br>
<br>
<br>
<br>
<br>




<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

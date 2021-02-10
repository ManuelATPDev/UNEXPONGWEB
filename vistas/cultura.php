<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'CULTURA';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista de la seccion cultura de la pagina-->

<div class="container-fluid text-center">
    <div class="jumbotron"> 
        <b>

            <div id="logo" class="col-lg-3 text-center">
                <img src="img/logounex.jpg" class="img-responsive" style="height: 100%; width: 100%">
            </div>

            <h2>Universidad Nacional Experimental Politécnica</h2>
            <h3>"Antonio José de Sucre"</h3>
            <h3>Núcleo Guarenas</h3>
            <h2>Síguenos en: @unexpoNGoficial</h2>
        </b>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Búsqueda
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                            <div class="form-group">
                                <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?">
                            </div>
                            <button type="submit" name="buscar" class="form-control btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cool-md-12">

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
                                            <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?" required
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
                                        <br>
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
        </div>
        <div class="row">
            <div class="cool-md-12">
                <div class="panel panel-default"> 
                    <div class="panel-heading" >
                        <i class="fas fa-map-marker-alt"></i> UBICACIÓN: SEDE TERRAZAS
                    </div>
                    <div class="panel-body text-center maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6598.415304184769!2d-66.60582874215191!3d10.465841981967966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf658d713103890b1!2sUniversidad%20Nacional%20Experimental%20Polit%C3%A9cnica%20UNEXPO!5e0!3m2!1ses!2sve!4v1578280164763!5m2!1ses!2sve" width="300" height="300" frameborder="0" style="border:0;"></iframe>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="cool-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-map-marker-alt"></i> UBICACIÓN: SEDE NARANJOS
                    </div>
                    <div class="panel-body text-center maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15693.20009476164!2d-66.5952909447903!3d10.476998046908447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2bab1a2182d905%3A0x9ec53928c3e767f9!2sN%C3%BAcleo%20UNEXPO%20Guarenas!5e0!3m2!1ses!2sve!4v1578279948015!5m2!1ses!2sve" width="300" height="300" frameborder="0" style="border:0; display: inline-block;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <?php
        $tipo = "cultura";
        EscritorEntradas::escribir_entradas_tipo($tipo);
        $total_entradas = RepositorioEntrada::paginador_tipo(Conexion::obtener_conexion(), $tipo);
        $por_pagina = 10;

        if (empty($_GET['pagina'])) {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $por_pagina . "," . $por_pagina;
        $total_paginas = ceil($total_entradas / $por_pagina);
        ?>
        <?php if ($total_entradas != 0) { ?>
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
        <?php } ?>
    </div>
</div>
</div>
<br>
<br>
<footer>
    <nav class="navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
                    UNEXPO Núcleo Guarenas
                </a>
            </div>
            <div id="navbar" class="text-center">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo RUTA_AVISO_LEGAL ?>"><i class="fas fa-balance-scale"></i> Aviso Legal y Contacto</a></li>  
                </ul>
            </div>
        </div>
    </nav>
</footer>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>



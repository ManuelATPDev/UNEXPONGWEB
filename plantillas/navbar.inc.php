<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion :: abrir_conexion();
$total_usuarios = RepositorioUsuario :: obtener_numero_usuarios(Conexion::obtener_conexion());
?>

<!--vista de la barra en la cabecera de la pagina-->
<nav class="navbar-default navbar-static-top">
    <div class="container-fluid" id="contenerdor_navbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este botón despliega la barra de navegación y sirve para los invidentes</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
                UNEXPO Núcleo Guarenas
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo SERVIDOR ?>"><i class="fas fa-home"></i> INICIO</a></li>
                <li><a href="<?php echo RUTA_INFORMACION_INDUSTRIAL ?>"><i class="fas fa-book-reader"></i> INFORMACIÓN DE ENTRENAMIENTO INDUSTRIAL Y PASANTÍAS</a></li>
                <li><a href="<?php echo RUTA_TRAMITES_DACE ?>"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> INFORMACIÓN Y TRÁMITES DACE</a></li>
                <li><a href="<?php echo RUTA_SERVICIO_COMUNITARIO ?>"><i class="fas fa-hand-holding-heart"></i> SERVICIO COMUNITARIO</a></li>
                <li><a href="<?php echo RUTA_CULTURA ?>"><i class="fas fa-icons"></i> CULTURA</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                    <li>
                        <a href="<?php echo RUTA_PERFIL ?>">
                            <span class="glyphicon glyphicon-education" aria-hidden="true"></span>
                            <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_GESTOR_GENERAL ?>">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            Gestiones
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_LOGOUT; ?>">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesión
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="fas fa-user-graduate"></i>
                            <?php
                            echo $total_usuarios;
                            ?>
                        </a>
                    </li>
                    <?php
                } else {
                    ?>

                    <li><a href="<?php echo RUTA_LOGIN ?>"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Iniciar sesión</a></li>
                    <li><a href="<?php echo RUTA_REGISTRO ?>"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Registro</a></li>

                    <li>
                        <a>
                            <i class="fas fa-user-graduate"></i>   
                            <?php
                            echo $total_usuarios;
                            ?>
                        </a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>
    </div> 
</nav>

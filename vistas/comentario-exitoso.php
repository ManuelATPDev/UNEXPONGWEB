<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'COMENTARIO PUBLICADO';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!--Vista de un comentario que ha sido colocado con exito en una publicacion-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> COMENTARIO PUBLICADO CON ÉXITO
                </div>
                <div class="panel-body text-center">
                    <h4><a href="javascript:history.back()"> <i class="fas fa-reply"></i> VOLVER</a> a la publicación</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>

</div>


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
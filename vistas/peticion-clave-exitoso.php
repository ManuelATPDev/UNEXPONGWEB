<?php
$titulo = "PETICIÓN EXITOSA";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista del correo ha sido enviado correctamente-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fas fa-envelope"></i> EL MENSAJE HA SIDO ENVIADO SATISFACTORIAMENTE A LA DIRECCION DE CORREO ELECTRÓNICO
                </div>
                <div class="panel-body text-center">
                    <p>Revise la bandeja de entrada del correo electronico proporcionado.</p>
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

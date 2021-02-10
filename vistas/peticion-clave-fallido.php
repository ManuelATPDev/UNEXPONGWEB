<?php
$titulo = "PETICIÓN FALLIDA";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista del correo no ha sido enviado correctamente-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    EL MENSAJE YA HA SIDO ENVIADO ANTERIORMENTE A LA DIRECCION DE CORREO ELECTRÓNICO
                </div>
                <div class="panel-body text-center">
                    <p>Revise la bandeja de entrada o SPAM del correo electrónico proporcionado. De lo contrario diríjase al DPTO. DE ADMISIÓN Y CONTROL DE ESTUDIOS</p>
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

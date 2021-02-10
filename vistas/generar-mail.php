<?php

$destinatario = "rivasa2936@clsn.top";
$asunto = "prueba de email";
$mensaje = "Esto es una prueba";

$exito = mail($destinatario, $asunto, $mensaje);

if ($exito){
    echo 'email enviado';
} else {
    echo 'envio fallido';
}
    
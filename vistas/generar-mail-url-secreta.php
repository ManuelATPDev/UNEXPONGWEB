<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/RecuperacionClave.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioRecuperacionClave.inc.php';

include_once 'app/Redireccion.inc.php';

$destinatario = "torrealbamanuel2001@gmail.com";
$asunto = "RECUPERACIÓN DE CLAVE DE LA UNEXPO";
$mensaje = "<strong>Ingrese a su URL ùnica: </strong><br/>" . "https://unexpong.000webhostapp.com/reemplazar-clave" . $url_secreta . "<br/>";
$mensaje .= "<img src='img/banunex.png'";
$encabezado = "From: UNEXPONG";
$encabezado .= "Content-type:text/html;charset=UTF-8";

$exito = mail($destinatario, $asunto, $mensaje, $encabezado);

if ($exito) {
    Redireccion::redirigir(RUTA_PETICION_VALIDA);
} else {
    Redireccion::redirigir(RUTA_PETICION_FALLIDA);
}
    
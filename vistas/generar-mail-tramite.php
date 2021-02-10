<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Tramite.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioTramite.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

include_once 'app/Redireccion.inc.php';

$destinatario = "torrealbamanuel2001@gmail.com";
$asunto = "DATOS DEL TRÁMITE REALIZADO EN LA UNEXPO";
$mensaje = "<strong>Datos del trámite: </strong><br/>";
$mensaje .= "Apellido y Nombre: " . $usuario->obtener_apellido() . " " . $usuario->obtener_nombre() . "<br/>";
$mensaje .= "Cédula: " . $usuario->obtener_cedula() . "<br/>";
$mensaje .= "Expediente: " . $usuario->obtener_expediente() . "<br/>";
$mensaje .= "Télefono Local: " . $tramite_recuperado->obtener_telf_local() . "<br/>";
$mensaje .= "Télefono Celular: " . $tramite_recuperado->obtener_telf_celular() . "<br/>";
$mensaje .= "Condición del solicitante: " . $condicion . "<br/>";
$mensaje .= "Número de Promoción: " . $tramite_recuperado->obtener_promo() . "<br/>";
$mensaje .= "Fecha de acto de grado: " . $tramite_recuperado->obtener_acto() . "<br/>";
$mensaje .= "Tipos de trámite a solicitar: " . $tipo . "<br/>";
$mensaje .= "Otros trámites: " . $tramite_recuperado->obtener_otro_tramite() . "<br/>";
$mensaje .= "<img src='img/BanUnex2.png'";
$encabezado = "From: UNEXPONG";
$encabezado .= "Content-type:text/html;charset=UTF-8";

$exito = mail($destinatario, $asunto, $mensaje, $encabezado);


if ($exito) {
    Redireccion::redirigir(RUTA_PETICION_VALIDA);
} else {
    Redireccion::redirigir(RUTA_PETICION_FALLIDA);
}

<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/RecuperacionClave.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioRecuperacionClave.inc.php';

include_once 'app/Redireccion.inc.php';

function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $string_aleatorio;
}

if (isset($_POST['enviar_email'])) {
    $email = $_POST['email'];

    Conexion::abrir_conexion();

    if (!RepositorioUsuario::email_existe(Conexion::obtener_conexion(), $email)) {
        Redireccion::redirigir(RUTA_RECUPERAR_CLAVE);
    }


    $usuario = RepositorioUsuario::obtener_usuario_por_email(Conexion::obtener_conexion(), $email);

    $nombre_usuario = $usuario->obtener_nombre();

    $string_aleatorio = sa(10);

    $url_secreta = hash('sha256', $string_aleatorio . $nombre_usuario);

    $peticiones = RepositorioRecuperacionClave::contar_peticiones(Conexion:: obtener_conexion(), $usuario->obtener_id());

    if ($peticiones == 0) {
        $peticion_generada = RepositorioRecuperacionClave::generar_peticion(Conexion:: obtener_conexion(), $usuario->obtener_id(), $url_secreta);

        $destinatario = "torrealbamanuel2001@gmail.com";
        $asunto = "Recuperación de clave de la UNEXPO";
        $mensaje = "<h1><strong>Ingrese a su URL única: </strong><br/></h1>";
        $mensaje .= "<p>https://unexpong.000webhostapp.com/reemplazar-clave/" . $url_secreta . "<br/></p>";
        $encabezado = "Content-type: text/html; charset=UTF-8\r\n";
        $encabezado .= "From: UNEXPONG <unexpong@gmail.com>\r\n";
        $encabezado .= "Reply-To:  <unexpong@gmail.com>\r\n";

        $exito = mail($destinatario, $asunto, $mensaje, $encabezado);

        if ($exito) {
            Redireccion::redirigir(RUTA_PETICION_VALIDA);
        } else {
            Redireccion::redirigir(RUTA_PETICION_FALLIDA);
        }
    } else {
        Redireccion::redirigir(RUTA_PETICION_FALLIDA);
    }


    Conexion::cerrar_conexion();
}




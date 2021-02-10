<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';
include_once 'app/Tramite.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';
include_once 'app/RepositorioTramite.inc.php';

function sa($longitud) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $string_aleatorio;
}

function sa_2($longitud) {
    $caracteres = '0123456789';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $string_aleatorio;
}

Conexion::abrir_conexion();

for ($usuarios = 0; $usuarios < 10; $usuarios++) {
    $nombre = sa(5);
    $apellido = sa(5);
    $cedula = sa_2(5);
    $expediente = sa_2(10);
    $especialidad = sa(5);
    $email = sa(5) . '@' . sa(3);
    $password = password_hash('123456', PASSWORD_DEFAULT);

    $usuario = new Usuario('', $nombre, $apellido, $cedula, $expediente, $especialidad, $email, $password, '', '');
    RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(), $usuario);
}

for ($entradas = 0; $entradas < 10; $entradas++) {
    $titulo = sa(10);
    $url = $titulo;
    $texto = lorem();
    $autor = rand(1, 10);

    $entrada = new Entrada('', $autor, $url, $titulo, $texto, 'informacion_industrial', '', '');
    RepositorioEntrada::insertar_entrada(Conexion::obtener_conexion(), $entrada);
}

for ($comentarios = 0; $comentarios < 10; $comentarios++) {
    $titulo = sa(10);
    $texto = lorem();
    $autor = rand(1, 10);
    $entrada = rand(1, 10);

    $comentario = new Comentario('', $autor, $entrada, $titulo, $texto, '');
    RepositorioComentario::insertar_comentario(Conexion::obtener_conexion(), $comentario);
}

for ($tramites = 0; $tramites < 10; $tramites++) {
    $tipo = rand (1,10);
    $autor = rand(1, 10);

    $tramite = new Tramite('', $autor, $tipo, '', rand(1000,1000000), '');
    RepositorioTramite::insertar_tramite(Conexion::obtener_conexion(), $tramite);
}

function lorem() {
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eleifend augue tempus ullamcorper tempus. Curabitur convallis vitae orci et sollicitudin. Nulla non diam augue. Fusce eu lacinia nulla. Curabitur consequat velit quis risus dictum, at finibus ante efficitur. Aliquam pulvinar tincidunt sem, ut ullamcorper diam dapibus non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce vel lobortis sapien.

Nunc varius, augue ut varius fringilla, quam mauris hendrerit risus, quis ultrices turpis massa sodales erat. Nulla at dolor ac urna dictum pulvinar. Sed sit amet ante ut purus vehicula pretium eu sit amet velit. Ut consectetur quam quis tellus aliquet, id imperdiet diam dictum. Suspendisse aliquam felis ut convallis aliquet. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vulputate pellentesque ex, at molestie erat consequat et. Nam hendrerit suscipit urna, sed congue magna vehicula ut.

Aenean sodales fringilla tortor, sit amet molestie massa. Ut faucibus augue leo, eu vulputate quam blandit at. Vestibulum tempus aliquet tortor. Sed id placerat justo. Aenean semper id arcu quis sodales. Proin lobortis elit mi. Fusce faucibus condimentum eleifend. Phasellus cursus et tellus vitae ornare. Ut dictum ipsum mauris, ac scelerisque mi tincidunt a. Vestibulum sed ante elementum, accumsan massa eu, elementum enim. Ut volutpat tincidunt ligula quis vestibulum. Curabitur sit amet consectetur velit. Fusce leo ipsum, sollicitudin quis nisi id, sagittis tristique odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec tempus metus quis turpis consequat, sit amet vehicula massa aliquam. Donec eget eros dui.

Nulla sagittis leo sit amet maximus congue. Nulla consectetur ipsum a nulla pellentesque maximus. Nullam condimentum placerat erat, posuere tincidunt purus sodales ut. Curabitur luctus suscipit nulla ac facilisis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer lobortis quis enim sit amet pulvinar. Quisque tempor egestas nisl at vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus.

Sed eget aliquet eros. Proin porttitor mattis tempor. Etiam vehicula enim at felis fringilla dictum. Nullam eget nisl bibendum, facilisis augue at, rutrum ex. Nulla sed facilisis dui, id vestibulum tortor. Aliquam cursus, lorem quis facilisis finibus, est justo scelerisque nunc, nec imperdiet ex diam in augue. Fusce at augue eu nisl consectetur facilisis vitae nec nisi. Donec commodo bibendum odio vitae lacinia. Curabitur eget convallis nisi. Donec in lorem in odio sagittis sagittis. Pellentesque faucibus nunc vel quam lobortis, non blandit massa fringilla. Cras dolor turpis, pretium vel dui ut, commodo porta felis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus luctus euismod purus vitae facilisis.';

    return $lorem;
}

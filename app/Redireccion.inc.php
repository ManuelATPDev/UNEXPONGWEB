<?php

/* Creamos la clase Redireccion para redireccionar a las distintas direcciones de archivos en la pagina (la url) */

class Redireccion {

    public static function redirigir($url) {
        header('Location:' . $url, true, 301);
        exit();
    }

}

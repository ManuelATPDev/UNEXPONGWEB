<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RecuperacionClave.inc.php';
    
    Conexion::abrir_conexion();
    
    RepositorioRecuperacionClave::borrar_url_secreta(Conexion :: obtener_conexion(), $url_id);
    
    Conexion :: cerrar_conexion();

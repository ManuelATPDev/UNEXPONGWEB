<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioTramite.inc.php';
include_once 'app/Redireccion.inc.php';

if(isset($_POST['borrar_tramite'])){
    $id_tramite = $_POST['id_borrar_tramite'];
    
    Conexion::abrir_conexion();
    
    RepositorioTramite::borrar_tramites(Conexion :: obtener_conexion(), $id_tramite);
    
    Conexion :: cerrar_conexion();
    
    Redireccion :: redirigir(RUTA_GESTOR_TRAMITES);
}

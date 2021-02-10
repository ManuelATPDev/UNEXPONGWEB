<?php

/* Creamos la clase Conexion para poder aperturar, obtener y cerrar la conexion 
  con el servidor y la base de datos */

class Conexion {

    //Se define la variable conexion
    private static $conexion;

    //Metodo para abrir la conexion
    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            try {
                /* se incluye el archivo config para poder acceder al nombre del servidor
                  nombre de la base de datos, nombre de usuario y la contraseña de la misma */
                include_once 'config.inc.php';

                self::$conexion = new PDO('mysql:host=' . NOMBRE_SERVIDOR . '; dbname=' . NOMBRE_BD, NOMBRE_USUARIO, PASSWORD);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage() . "<br>";
                die();
            }
        }
    }

    //Metodo para cerrar la conexion
    public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    //Metodo para obtener la conexion
    public static function obtener_conexion() {
        return self::$conexion;
    }

}

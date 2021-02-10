<?php

/* Se incluyen la conexion para obtener conexion con la base de datos,
  y se incluye RecuperacionClave.inc.php para obtener las variables que seran insertadas */
include_once 'app/Conexion.inc.php';
include_once 'app/RecuperacionClave.inc.php';

/* Creamos la clase EscritorEntradas para manejar los distintos metodos relacionados 
  a las entradas publicadas en la pagina */

class RepositorioRecuperacionClave {
    /* Metodo generar_peticion para insertar los distintos valores de la peticion en sus casillas
      correspondientes a cada seccion de recuperacionclave en la base de datos */

    public static function generar_peticion($conexion, $id_usuario, $url_secreta) {
        $peticion_generada = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO recuperacion_clave(usuario_id, url_secreta, fecha) VALUES (:usuario_id, :url_secreta, NOW())";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':usuario_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);

                $peticion_generada = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $peticion_generada;
    }

    /* Metodo url_secreta_existe para verificar la url de la peticion en su casilla
      correspondiente a recuperacionclave en la base de datos */

    public static function url_secreta_existe($conexion, $url_secreta) {
        $url_existe = false;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $url_existe = true;
                } else {
                    $url_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $url_existe;
    }

    /* Metodo contar_peticiones para contar las peticiones  y de esa manera no generar
      mas de 1 peticion en la base de datos */

    public static function contar_peticiones($conexion, $id_usuario) {
        $peticiones = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as peticiones FROM recuperacion_clave WHERE usuario_id = :usuario_id';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':usuario_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $peticiones = $resultado['peticiones'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $peticiones;
    }

    /* Metodo contar_peticiones para contar las peticiones  y de esa manera no generar
      mas de 1 peticion en la base de datos */

    public static function obtener_id_usuario_mediante_url($conexion, $url_secreta) {
        $id_usuario = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $id_usuario = $resultado['usuario_id'];
                    $id_url_secreta = $resultado['id'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $id_usuario;
    }

    /* Metodo obtener_id_de_url_por_url para determinar a el usuario que va a realizar el cambio de contraseña
      en la base de datos a partir de la url secreta */

    public static function obtener_id_de_url_por_url($conexion, $url_secreta) {
        $url_id = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $url_id = $resultado['id'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $url_id;
    }

    /* Metodo borrar_url_secreta para eliminar la url secreta una vez haya sido modificada exitosamente la contraseña del usuario en la base de datos */

    public static function borrar_url_secreta($conexion, $id_url_secreta) {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = 'DELETE FROM recuperacion_clave WHERE id = :id';
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->bindParam(':id', $id_url_secreta, PDO::PARAM_STR);
                $sentencia1->execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
        }
    }

}

<?php

/* Se incluyen la conexion para obtener conexion con la base de datos,
  y se incluye Tramite para obtener las variables que seran insertadas */
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Tramite.inc.php';

/* Creamos la clase RepositorioTramite para manejar los distintos metodos relacionados 
  a los tramites de los usuarios de la pagina */

class RepositorioTramite {
    /* Metodo insertar_tramite para insertar los distintos valores en sus casillas
      correspondientes a cada seccion de los tramites en la base de datos */

    public static function insertar_tramite($conexion, $tramite) {
        $tramite_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO tramites(autor_id, tipo, fecha, referencia_tramite, tramite_activo) VALUES(:autor_id, :tipo, NOW(), :referencia_tramite, 0)";

                $sentencia = $conexion->prepare($sql);

                $autor_idtemp = $tramite->obtener_autor_id();
                $tipotemp = $tramite->obtener_tipo();
                $referenciatemp = $tramite->obtener_referencia_tramite();

                $sentencia->bindParam(':autor_id', $autor_idtemp, PDO::PARAM_STR);
                $sentencia->bindParam(':tipo', $tipotemp, PDO::PARAM_STR);
                $sentencia->bindParam(':referencia_tramite', $referenciatemp, PDO::PARAM_STR);


                $tramite_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $tramite_insertado;
    }

    /* Metodo contar_tramites_activos para contar tramites correspondientes a cada id del usuario
      en la base de datos y que esten activos para mostrarlos en el gestor de tramites */

    public static function contar_tramites_activos($conexion, $id_usuario) {
        $total_tramites = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_tramites FROM tramites WHERE autor_id = :autor_id AND tramite_activo=1';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_tramites = $resultado['total_tramites'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_tramites;
    }

    /* Metodo contar_tramites_activos para contar tramites correspondientes a cada id del usuario
      en la base de datos y que esten activos para mostrarlos en el gestor de tramites */

    public static function contar_tramites_inactivos($conexion, $id_usuario) {
        $total_tramites = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_tramites FROM tramites WHERE autor_id = :autor_id AND tramite_activo=0';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_tramites = $resultado['total_tramites'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_tramites;
    }

    /* Metodo obtener_tramites_usuario_fecha_descendente para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de los tramites en la base de datos */

    public static function obtener_tramites_usuario_fecha_descendente($conexion, $id_usuario) {
        $tramites_obtenidos = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.tipo, a.fecha, a.referencia_tramite, a.tramite_activo FROM tramites a LEFT JOIN usuarios b ON a.autor_id = b.id WHERE a.autor_id = :autor_id GROUP BY a.id ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(":autor_id", $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchall();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $tramites_obtenidos[] = array(
                            new Tramite(
                                    $fila['id'], $fila['autor_id'], $fila['tipo'],
                                    $fila['fecha'], $fila['referencia_tramite'], $fila['tramite_activo']
                            )
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $tramites_obtenidos;
    }

    /* Metodo borrar_tramites para borrar la informacion del tramite correspondientes a cada id del mismo
      de los tramites en la base de datos */

    public static function borrar_tramites($conexion, $tramite_id) {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = 'DELETE FROM tramites WHERE id = :tramite_id';
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->bindParam(':tramite_id', $tramite_id, PDO::PARAM_STR);
                $sentencia1->execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
        }
    }

}

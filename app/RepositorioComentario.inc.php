<?php

/* Se incluyen la conexion para obtener conexion con la base de datos,
  y se incluye Comentario para obtener las variables que seran insertadas */

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Comentario.inc.php';


/* Creamos la clase RepositorioComentario para manejar los distintos metodos relacionados 
  a los comentarios en las publicaciones de la pagina */

class RepositorioComentario {
    /* Metodo insertar_comentario para insertar los distintos valores en sus casillas
      correspondientes a cada seccion de los comentarios en la base de datos */

    public static function insertar_comentario($conexion, $comentario) {
        $comentario_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id, :entrada_id, :titulo, :texto, NOW())";

                $sentencia = $conexion->prepare($sql);

                $autor_id_temp = $comentario->obtener_autor_id();
                $entrada_id_temp = $comentario->obtener_entrada_id();
                $titulotemp = $comentario->obtener_titulo();
                $textotemp = $comentario->obtener_texto();

                $sentencia->bindParam(':autor_id', $autor_id_temp, PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $entrada_id_temp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $titulotemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textotemp, PDO::PARAM_STR);

                $comentario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $comentario_insertado;
    }

    /* Metodo obtener_comentarios para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de los comentarios en la base de datos */

    public static function obtener_comentarios($conexion, $entrada_id) {
        $comentarios = array();

        if (isset($conexion)) {

            try {
                include_once 'Comentario.inc.php';

                $sql = 'SELECT * FROM comentarios WHERE entrada_id = :entrada_id';

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios[] = new Comentario($fila['id'], $fila['autor_id'], $fila['entrada_id'], $fila['titulo'], $fila['texto'], $fila['fecha']);
                    }
                }
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        return $comentarios;
    }

    /* Metodo contar_comentarios para contar comentarios correspondientes a cada autor 
      de los comentarios en la base de datos y mostrarlos en el gestor de comentarios */

    public static function contar_comentarios($conexion, $id_usuario) {
        $total_comentarios = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autor_id';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_comentarios = $resultado['total_comentarios'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_comentarios;
    }

    /* Metodo obtener_comentarios_usuario_fecha_descendente para obtener la informacion de los comentarios correspondientes a cada autor 
      de los comentarios en la base de datos y mostrarlos en el gestor de comentarios */

    public static function obtener_comentarios_usuario_fecha_descendente($conexion, $id_usuario) {
        $comentarios_obtenidos = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.entrada_id, a.titulo, a.texto, a.fecha FROM comentarios a LEFT JOIN entradas b ON a.entrada_id = b.id WHERE a.autor_id = :autor_id GROUP BY a.id ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(":autor_id", $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchall();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios_obtenidos[] = array(
                            new Comentario(
                                    $fila['id'], $fila['autor_id'], $fila['entrada_id'],
                                    $fila['titulo'], $fila['texto'], $fila['fecha']
                            )
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $comentarios_obtenidos;
    }

    /* Metodo borrar_comentarios para borrar la informacion del comentario correspondientes a cada id del mismo
      de los comentarios en la base de datos */

    public static function borrar_comentarios($conexion, $comentario_id) {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = 'DELETE FROM comentarios WHERE id = :comentario_id';
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->bindParam(':comentario_id', $comentario_id, PDO::PARAM_STR);
                $sentencia1->execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
        }
    }

}

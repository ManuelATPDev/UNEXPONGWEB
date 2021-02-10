<?php

/* Se incluyen la conexion para obtener conexion con la base de datos,
  y se incluye Entrada para obtener las variables que seran insertadas */
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entrada.inc.php';

/* Creamos la clase RepositorioEntrada para manejar los distintos metodos relacionados 
  a las entradas de la pagina */

class RepositorioEntrada {
    /* Metodo insertar_entrada para insertar los distintos valores en sus casillas
      correspondientes a cada seccion de las entradas en la base de datos */

    public static function insertar_entrada($conexion, $entrada) {
        $entrada_insertada = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas(autor_id, url, titulo, texto, tipo, fecha, activa) VALUES(:autor_id, :url, :titulo, :texto, :tipo, NOW(), 0)";

                $sentencia = $conexion->prepare($sql);

                $autor_idtemp = $entrada->obtener_autor_id();
                $urltemp = $entrada->obtener_url();
                $titulotemp = $entrada->obtener_titulo();
                $textotemp = $entrada->obtener_texto();
                $tipotemp = $entrada->obtener_tipo();

                $sentencia->bindParam(':autor_id', $autor_idtemp, PDO::PARAM_STR);
                $sentencia->bindParam(':url', $urltemp, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $titulotemp, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $textotemp, PDO::PARAM_STR);
                $sentencia->bindParam(':tipo', $tipotemp, PDO::PARAM_STR);

                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $entrada_insertada;
    }

    /* Metodo paginador para contar todas las entradas de la pagina y poder paginarlas */

    public static function paginador($conexion) {
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_entradas FROM entradas WHERE activa = 1';
                $sentencia = $conexion->prepare($sql);

                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    /* Metodo obtener_todas_por_fecha_descendiente para obtener la informacion de las entradas correspondientes de la pagina
      y limitarlos en base a la variable $desde de las entradas en la base de datos */

    public static function obtener_todas_por_fecha_descendiente($conexion, $desde) {
        $entradas = array();

        if (isset($conexion)) {
            try {
                include_once 'Entrada.inc.php';

                $sql = ("SELECT * FROM entradas  WHERE activa = 1 ORDER BY fecha DESC LIMIT $desde");

                $sentencia = $conexion->prepare($sql);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas [] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'],
                                $fila['texto'], $fila['tipo'], $fila['fecha'], $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    /* Metodo obtener_todas_por_fecha_descendiente para obtener la informacion de las entradas correspondientes a una url de la pagina
      de las entradas en la base de datos */

    public static function obtener_entrada_por_url($conexion, $url) {
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT * FROM entradas WHERE url LIKE :url';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'],
                            $resultado['texto'], $resultado['tipo'], $resultado['fecha'], $resultado['activa']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entrada;
    }

    /* Metodo paginador_tipo para contar todas las entradas segun el tipo que sean de la pagina y poder paginarlas */

    public static function paginador_tipo($conexion, $tipo) {
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE tipo = :tipo AND activa = 1";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    /* Metodo obtener_todas_por_tipo_descendiente para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de las entradas que unicamente estén activas en la base de datos */

    public static function obtener_todas_por_tipo_descendiente($conexion, $tipo, $desde) {
        $entradas = array();

        if (isset($conexion)) {
            try {
                include_once 'Entrada.inc.php';

                $sql = ("SELECT * FROM entradas WHERE tipo = :tipo AND activa = 1 ORDER BY fecha DESC LIMIT $desde");

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas [] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'],
                                $fila['texto'], $fila['tipo'], $fila['fecha'], $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $entradas;
    }

    /* Metodo obtener_entrada_por_id para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de las entradas que unicamente estén asociadas con el id del usuario en la base de datos para el gestor de entradas */

    public static function obtener_entrada_por_id($conexion, $id) {
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT * FROM entradas WHERE id = :id';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'],
                            $resultado['texto'], $resultado['tipo'], $resultado['fecha'], $resultado['activa']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entrada;
    }

    /* Metodo obtener_entradas_al_azar para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de las entradas en la base de datos y ordenarlos de manera random para la seccion de "otras publicaciones que te puedan interesar" */

    public static function obtener_entradas_al_azar($conexion, $limite) {
        $entradas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $limite";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchall();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'],
                                $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas;
    }

    /* Metodo contar_entradas_activas para contar entradas activas correspondientes a cada autor 
      de las entradas en la base de datos y mostrarlos en el gestor de entradas */

    public static function contar_entradas_activas($conexion, $id_usuario) {
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa = 1';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    /* Metodo contar_entradas_activas para contar entradas inactivas correspondientes a cada autor 
      de las entradas en la base de datos y mostrarlos en el gestor de entradas */

    public static function contar_entradas_inactivas($conexion, $id_usuario) {
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autor_id AND activa = 0';
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    /* Metodo obtener_entradas_usuario_fecha_descendente para obtener la informacion de las entradas correspondientes a cada autor 
      de las entradas en la base de datos y mostrarlos en el gestor de entradas */

    public static function obtener_entradas_usuario_fecha_descendente($conexion, $id_usuario) {
        $entradas_obtenidas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.tipo, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' FROM entradas a LEFT JOIN comentarios b ON a.id = b.entrada_id WHERE a.autor_id = :autor_id GROUP BY a.id ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(":autor_id", $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchall();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(
                            new Entrada(
                                    $fila['id'], $fila['autor_id'], $fila['url'],
                                    $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                    $fila['activa']
                            ),
                            $fila['cantidad_comentarios']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas_obtenidas;
    }

    //Metodo para verificar si la url de una entrada de la pagina existe
    public static function url_existe($conexion, $url) {
        $url_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE url = :url";
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
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

    /* Metodo borrar_comentarios_y_entradas para borrar la informacion del o los comentarios y la entrada correspondientes a cada id de la entrada
      de las entradas en la base de datos */

    public static function borrar_comentarios_y_entradas($conexion, $entrada_id) {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = 'DELETE FROM comentarios WHERE entrada_id = :entrada_id';
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia1->execute();

                $sql2 = 'DELETE FROM entradas WHERE id = :entrada_id';
                $sentencia2 = $conexion->prepare($sql2);
                $sentencia2->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia2->execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
        }
    }

    /* Metodo actualizar_entrada para actualizar la informacion de la entrada correspondientes a cada id de la misma,
      titulo, url, texto y tipo de las entradas en la base de datos */

    public static function actualizar_entrada($conexion, $id, $titulo, $url, $texto, $tipo) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE entradas SET titulo = :titulo, url = :url, texto = :texto, tipo = :tipo WHERE id = :id";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->rowCount();

                if ($resultado) {
                    $actualizacion_correcta = true;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $actualizacion_correcta;
    }

    /* Metodo paginador_todos_los_campos para contar las entradas correspondientes a cada termino de busqueda de la pagina
      y poder paginarlas */

    public static function paginador_todos_los_campos($conexion, $termino_busqueda) {
        $total_entradas = 0;

        $termino_busqueda = '%' . $termino_busqueda . '%';

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total_entradas_todos_los_campos FROM entradas WHERE titulo LIKE :busqueda OR texto LIKE :busqueda';
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(":busqueda", $termino_busqueda, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas_todos_los_campos'];
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $total_entradas;
    }

    /* Metodo buscar_entradas_todos_los_campos para mostrar todo el contenido de la entrada correspondiente 
      al termino de busqueda en el campo de busqueda y limitarlos por el paginador */

    public static function buscar_entradas_todos_los_campos($conexion, $termino_busqueda, $desde) {
        $entradas = [];

        $termino_busqueda = '%' . $termino_busqueda . '%';

        if (isset($conexion)) {
            try {

                $sql = ("SELECT * FROM entradas WHERE titulo LIKE :busqueda OR texto LIKE :busqueda ORDER BY fecha DESC LIMIT $desde");

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":busqueda", $termino_busqueda, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'],
                                $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas;
    }

    /* Metodo buscar_entradas_por_titulo para mostrar todo el contenido de la entrada correspondiente 
      al termino de busqueda en el campo del titulo y ordenarlos por la fecha de la variable $order */

    public static function buscar_entradas_por_titulo($conexion, $termino_busqueda, $order) {
        $entradas = [];

        $termino_busqueda = '%' . $termino_busqueda . '%';

        if (isset($conexion)) {
            try {

                $sql = "SELECT * FROM entradas WHERE titulo LIKE :busqueda ORDER BY fecha $order";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":busqueda", $termino_busqueda, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'],
                                $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas;
    }

    /* Metodo buscar_entradas_por_contenido para mostrar todo el contenido de la entrada correspondiente 
      al termino de busqueda en el campo del contenido y ordenarlos por la fecha de la variable $order */

    public static function buscar_entradas_por_contenido($conexion, $termino_busqueda, $orden) {
        $entradas = [];

        $termino_busqueda = '%' . $termino_busqueda . '%';

        if (isset($conexion)) {
            try {

                $sql = "SELECT * FROM entradas WHERE texto LIKE :busqueda ORDER BY fecha $orden";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":busqueda", $termino_busqueda, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'],
                                $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas;
    }

    /* Metodo buscar_entradas_por_autor para mostrar todo el contenido de la entrada correspondiente 
      al termino de busqueda en el campo del autor y ordenarlos por la fecha de la variable $order */

    public static function buscar_entradas_por_autor($conexion, $termino_busqueda, $orden) {
        $entradas = [];

        $autor = '%' . $termino_busqueda . '%';

        if (isset($conexion)) {
            try {

                $sql = "SELECT * FROM entradas e JOIN usuarios u ON u.id = e.autor_id WHERE u.nombre LIKE :autor ORDER BY e.fecha $orden";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(":autor", $autor, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['url'],
                                $fila['titulo'], $fila['texto'], $fila['tipo'], $fila['fecha'],
                                $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $entradas;
    }

}

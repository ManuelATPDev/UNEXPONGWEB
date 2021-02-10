<?php

/* Se incluyen la conexion para obtener conexion con la base de datos,
  y se incluye Usuarios para obtener las variables que seran insertadas */

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';

/* Creamos la clase RepositorioUsuario para manejar los distintos metodos relacionados 
  a los usuarios de la pagina */

class RepositorioUsuario {
    /* Metodo obtener_todos para obtener los distintos valores de sus casillas
      correspondientes a cada seccion de los usuarios en la base de datos */

    public static function obtener_todos($Conexion) {

        $usuarios = array();

        if (isset($Conexion)) {

            try {
                include_once 'Usuario.inc.php';
                $sql = 'SELECT * FROM unexpoweb.usuarios';

                $sentencia = $Conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuarios[] = new Usuario(
                                $fila['id'], $fila['cedula'], $fila['expediente'], $fila['password'], $fila['email'], $fila['fecha_registro'], $fila['activo']
                        );
                    }
                } else {
                    print ("No hay usuarios");
                }
            } catch (Exception $ex) {
                print "Error" . $ex->getMessage();
            }
        }
        return $usuarios;
    }

    /* Metodo obtener_numero_usuarios para contar usuarios en la base de datos 
      y mostrarlos en la navbar */

    public static function obtener_numero_usuarios($conexion) {
        $total_usuarios = null;

        if (isset($conexion)) {
            try {
                $sql = 'SELECT COUNT(*) as total FROM usuarios';

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $total_usuarios;
    }

    /* Metodo insertar_usuario para insertar los distintos valores en sus casillas
      correspondientes a cada seccion de los usuarios en la base de datos */

    public static function insertar_usuario($conexion, $usuario) {
        $usuario_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuarios(nombre, apellido, cedula, expediente, especialidad, email, password, fecha_registro, activo) VALUES(:nombre, :apellido, :cedula, :expediente, :especialidad, :email, :password, NOW(), 0)";

                $sentencia = $conexion->prepare($sql);

                $nombretemp = $usuario->obtener_nombre();
                $apellidotemp = $usuario->obtener_apellido();
                $cedulatemp = $usuario->obtener_cedula();
                $expedientetemp = $usuario->obtener_expediente();
                $especialidadtemp = $usuario->obtener_especialidad();
                $emailtemp = $usuario->obtener_email();
                $passwordtemp = $usuario->obtener_password();

                $sentencia->bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia->bindParam(':apellido', $apellidotemp, PDO::PARAM_STR);
                $sentencia->bindParam(':cedula', $cedulatemp, PDO::PARAM_STR);
                $sentencia->bindParam(':expediente', $expedientetemp, PDO::PARAM_STR);
                $sentencia->bindParam(':especialidad', $especialidadtemp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailtemp, PDO::PARAM_STR);
                $sentencia->bindParam(':password', $passwordtemp, PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $usuario_insertado;
    }

    /* Metodo expediente_existe para conocer la disponibilidad de la casilla
      correspondientes a el expediente de los usuarios en la base de datos */

    public static function expediente_existe($conexion, $expediente) {
        $expediente_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE expediente = :expediente";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':expediente', $expediente, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $expediente_existe = true;
                } else {
                    $expediente_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $expediente_existe;
    }

    /* Metodo cedula_existe para conocer la disponibilidad de la casilla
      correspondientes a la cedula de los usuarios en la base de datos */

    public static function cedula_existe($conexion, $cedula) {
        $cedula_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE cedula = :cedula";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':cedula', $cedula, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $cedula_existe = true;
                } else {
                    $cedula_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $cedula_existe;
    }

    /* Metodo email_existe para conocer la disponibilidad de la casilla
      correspondientes a el email de los usuarios en la base de datos */

    public static function email_existe($conexion, $email) {
        $email_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $email_existe;
    }

    /* Metodo obtener_usuario_por_email para obtener la informacion del usuario correspondientes a cada email del mismo
      en la base de datos */

    public static function obtener_usuario_por_email($conexion, $email) {
        $usuario = null;

        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';

                $sql = "SELECT * FROM usuarios WHERE email = :email";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['apellido'], $resultado['cedula'], $resultado['expediente'], $resultado['especialidad'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $usuario;
    }

    /* Metodo obtener_usuario_por_email para obtener la informacion del usuario correspondientes a cada id del mismo
      en la base de datos */

    public static function obtener_usuario_por_id($conexion, $id) {
        $usuario = null;

        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';

                $sql = "SELECT * FROM usuarios WHERE id = :id";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['apellido'], $resultado['cedula'], $resultado['expediente'], $resultado['especialidad'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }

        return $usuario;
    }

    /* Metodo actualizar_password para actualizar la informacion de la contraseña correspondiente a cada id del usuario
      en la base de datos */

    public static function actualizar_password($conexion, $id_usuario, $clave_nueva) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':password', $clave_nueva, PDO::PARAM_STR);
                $sentencia->bindParam(':id', $id_usuario, PDO::PARAM_STR);

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

}

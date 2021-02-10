<?php

include_once 'RepositorioUsuario.inc.php';

/* Creamos la clase ValidadorLogin para almacenar, obtener y comprobar las distintas variables 
  que serán utilizadas para iniciar sesion en la pagina */

class ValidadorLogin {

    //Se definen las distintas variables para iniciar sesion
    private $usuario;
    private $error;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($email, $clave, $conexion) {
        $this->error = "";

        if (!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)) {
            $this->usuario = null;
            $this->error = "Debes introducir tu correo electrónico y tu contraseña";
        } else {
            $this->usuario = RepositorioUsuario :: obtener_usuario_por_email($conexion, $email);

            if (is_null($this->usuario) || !password_verify($clave, $this->usuario->obtener_password())) {
                $this->error = "Datos incorrectos";
            } else {
                
            }
        }
    }

    //Distintos metodos para validar los atributos de las variables
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_usuario() {
        return $this->usuario;
    }

    public function obtener_error() {
        return $this->error;
    }

    public function mostrar_error() {
        if ($this->error !== '') {
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }

}

<?php

include_once 'RepositorioUsuario.inc.php';

/* Creamos la clase ValidadorRegistro para almacenar, obtener y comprobar las distintas variables 
  que serán puestas en la sección de usuarios de la base de datos */

class ValidadorRegistro {

    //Se definen las distintas variables del campo comentario
    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $apellido;
    private $cedula;
    private $expediente;
    private $especialidad;
    private $email;
    private $clave;
    private $error_nombre;
    private $error_apellido;
    private $error_cedula;
    private $error_expediente;
    private $error_especialidad;
    private $error_email;
    private $error_clave;
    private $error_clave2;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($nombre, $apellido, $cedula, $expediente, $especialidad, $email, $clave, $clave2, $conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";


        $this->nombre = "";
        $this->apellido = "";
        $this->cedula = "";
        $this->expediente = "";
        $this->especialidad = "";
        $this->email = "";
        $this->clave = "";

        $this->error_nombre = $this->validar_nombre($nombre);
        $this->error_apellido = $this->validar_apellido($apellido);
        $this->error_cedula = $this->validar_cedula($conexion, $cedula);
        $this->error_expediente = $this->validar_expediente($conexion, $expediente);
        $this->error_especialidad = $this->validar_especialidad($especialidad);
        $this->error_email = $this->validar_email($conexion, $email);
        $this->error_clave = $this->validar_clave($clave);
        $this->error_clave2 = $this->validar_clave2($clave, $clave2);

        if ($this->error_clave === "" && $this->error_clave2 === "") {
            $this->clave = $clave;
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

    private function validar_nombre($nombre) {
        $permitidos = "ÁÉÍÓÚáéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

        for ($i = 0; $i < strlen($nombre); $i++) {
            if (strpos($permitidos, substr($nombre, $i, 1)) === false) {
                return "Debe ingresar solo letras y no debe contener espacios.";
            }
        }

        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir un Nombre.";
        } else {
            $this->nombre = $nombre;
        }
        return "";
    }

    private function validar_apellido($apellido) {
        $permitidos = "ÁÉÍÓÚáéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

        for ($i = 0; $i < strlen($apellido); $i++) {
            if (strpos($permitidos, substr($apellido, $i, 1)) === false) {
                return "Debe ingresar solo letras y no debe contener espacios.";
            }
        }

        if (!$this->variable_iniciada($apellido)) {
            return "Debes escribir un Apellido.";
        } else {
            $this->apellido = $apellido;
        }
        return "";
    }

    private function validar_cedula($conexion, $cedula) {
        if (!$this->variable_iniciada($cedula)) {
            return "Debes ingresar un numero de cédula.";
        } else {
            $this->cedula = $cedula;
        }
        if (RepositorioUsuario :: cedula_existe($conexion, $cedula)) {
            return "El número de cédula ya ha sido utilizado anteriormente.";
        }

        return "";
    }

    private function validar_expediente($conexion, $expediente) {
        if (!$this->variable_iniciada($expediente)) {
            return "Debes ingresar un numero de expediente.";
        } else {
            $this->expediente = $expediente;
        }
        if (RepositorioUsuario :: expediente_existe($conexion, $expediente)) {
            return "El número de expediente ya ha sido utilizado anteriormente.";
        }

        return "";
    }

    private function validar_especialidad($especialidad) {
        $permitidos = "ÁÉÍÓÚáéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

        for ($i = 0; $i < strlen($especialidad); $i++) {
            if (strpos($permitidos, substr($especialidad, $i, 1)) === false) {
                return "Debe ingresar solo letras y no debe contener espacios.";
            }
        }

        if (!$this->variable_iniciada($especialidad)) {
            return "Debes escribir una Especialidad.";
        } else {
            $this->especialidad = $especialidad;
        }
        return "";
    }

    private function validar_email($conexion, $email) {
        if (!$this->variable_iniciada($email)) {
            return "Debes ingresar un correo electrónico.";
        } else {
            $this->email = $email;
        }
        if (RepositorioUsuario :: email_existe($conexion, $email)) {
            return "El correo electrónico ya ha sido utilizado anteriormente o <a href='#'>Intente recuperar su contraseña</a>.";
        }

        return "";
    }

    private function validar_clave($clave) {
        if (!$this->variable_iniciada($clave)) {
            return "Debes ingresar una contraseña.";
        }

        return "";
    }

    private function validar_clave2($clave2, $clave) {
        if (!$this->variable_iniciada($clave)) {
            return "Primero debes rellenar la contraseña anterior.";
        }

        if (!$this->variable_iniciada($clave2)) {
            return "Debes ingresar la misma contraseña anterior.";
        }

        if ($clave !== $clave2) {
            return "Ambas contraseñas deben ser iguales";
        }
        return "";
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_nombre() {
        return $this->nombre;
    }

    public function obtener_apellido() {
        return $this->apellido;
    }

    public function obtener_cedula() {
        return $this->cedula;
    }

    public function obtener_expediente() {
        return $this->expediente;
    }

    public function obtener_especialidad() {
        return $this->especialidad;
    }

    public function obtener_email() {
        return $this->email;
    }

    public function obtener_clave() {
        return $this->clave;
    }

    public function obtener_error_nombre() {
        return $this->error_nombre;
    }

    public function obtener_error_apellido() {
        return $this->error_apellido;
    }

    public function obtener_error_cedula() {
        return $this->error_cedula;
    }

    public function obtener_error_expediente() {
        return $this->error_expediente;
    }

    public function obtener_error_especialidad() {
        return $this->error_especialidad;
    }

    public function obtener_error_email() {
        return $this->error_email;
    }

    public function obtener_error_clave() {
        return $this->error_clave;
    }

    public function obtener_error_clave2() {
        return $this->error_clave2;
    }

    //Distintos metodos para mostrar los atributos de las variables
    public function mostrar_nombre() {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }

    public function mostrar_error_nombre() {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrar_apellido() {
        if ($this->apellido !== "") {
            echo 'value="' . $this->apellido . '"';
        }
    }

    public function mostrar_error_apellido() {
        if ($this->error_apellido !== "") {
            echo $this->aviso_inicio . $this->error_apellido . $this->aviso_cierre;
        }
    }

    public function mostrar_cedula() {
        if ($this->cedula !== "") {
            echo 'value="' . $this->cedula . '"';
        }
    }

    public function mostrar_error_cedula() {
        if ($this->error_cedula !== "") {
            echo $this->aviso_inicio . $this->error_cedula . $this->aviso_cierre;
        }
    }

    public function mostrar_expediente() {
        if ($this->expediente !== "") {
            echo 'value="' . $this->expediente . '"';
        }
    }

    public function mostrar_error_expediente() {
        if ($this->error_expediente !== "") {
            echo $this->aviso_inicio . $this->error_expediente . $this->aviso_cierre;
        }
    }

    public function mostrar_especialidad() {
        if ($this->especialidad !== "") {
            echo 'value="' . $this->especialidad . '"';
        }
    }

    public function mostrar_error_especialidad() {
        if ($this->error_especialidad !== "") {
            echo $this->aviso_inicio . $this->error_especialidad . $this->aviso_cierre;
        }
    }

    public function mostrar_email() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    public function mostrar_error_email() {
        if ($this->error_cedula !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrar_error_clave() {
        if ($this->error_clave !== "") {
            echo $this->aviso_inicio . $this->error_clave . $this->aviso_cierre;
        }
    }

    public function mostrar_error_clave2() {
        if ($this->error_clave2 !== "") {
            echo $this->aviso_inicio . $this->error_clave2 . $this->aviso_cierre;
        }
    }

    public function registro_valido() {
        if ($this->error_nombre === "" && $this->error_apellido === "" && $this->error_cedula === "" && $this->error_expediente === "" && $this->error_especialidad === "" && $this->error_email === "" && $this->error_clave === "" && $this->error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }

}

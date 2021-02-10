<?php

/* Creamos la clase ValidadorNuevaClave para almacenar, obtener y comprobar las distintas variables 
  que serán puestas en la sección de clave del usuario en la base de datos */

class ValidadorNuevaClave {

    //Se definen las distintas variables del campo comentario
    private $aviso_inicio;
    private $aviso_cierre;
    private $clave;
    private $error_clave;
    private $error_clave2;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($clave, $clave2) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->clave = "";

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
    public function obtener_clave() {
        return $this->clave;
    }

    public function obtener_error_clave() {
        return $this->error_clave;
    }

    public function obtener_error_clave2() {
        return $this->error_clave2;
    }

    //Distintos metodos para mostrar los atributos de las variables
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

    public function cambio_contraseña_valido() {
        if ($this->error_clave === "" && $this->error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }

}

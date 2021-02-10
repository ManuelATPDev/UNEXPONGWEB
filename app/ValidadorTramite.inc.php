<?php

include_once 'RepositorioTramite.inc.php';

/* Creamos la clase ValidadorTramite para almacenar, obtener y comprobar las distintas variables 
  que serán puestas en la sección de tramites de la base de datos */

class ValidadorTramite {

    //Se definen las distintas variables del campo comentario
    private $aviso_inicio;
    private $aviso_cierre;
    private $telf_local;
    private $telf_celular;
    private $promo;
    private $acto;
    private $otro_tramite;
    private $error_telf_local;
    private $error_telf_celular;
    private $error_promo;
    private $error_acto;
    private $error_otro_tramite;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($telf_local, $telf_celular, $promo, $acto, $otro_tramite) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";


        $this->telf_local = "";
        $this->telf_celular = "";
        $this->promo = "";
        $this->acto = "";
        $this->otro_tramite = "";

        $this->error_telf_local = $this->validar_telf_local($telf_local);
        $this->error_telf_celular = $this->validar_telf_celular($telf_celular);
        $this->error_promo = $this->validar_promo($promo);
        $this->error_acto = $this->validar_acto($acto);
        $this->error_otro_tramite = $this->validar_otro_tramite($otro_tramite);
    }

    //Distintos metodos para validar los atributos de las variables
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_telf_local($telf_local) {
        $permitidos = "0123456789-()";

        for ($i = 0; $i < strlen($telf_local); $i++) {
            if (strpos($permitidos, substr($telf_local, $i, 1)) === false) {
                return "Debe ingresar solo numeros y solo puedes separar el código de área con '-' o '()'.";
            }
        }

        if (!$this->variable_iniciada($telf_local)) {
            return "Debes escribir un número de télefono local.";
        } else {
            $this->telf_local = $telf_local;
        }
        return "";
    }

    private function validar_telf_celular($telf_celular) {
        $permitidos = "0123456789-()";

        for ($i = 0; $i < strlen($telf_celular); $i++) {
            if (strpos($permitidos, substr($telf_celular, $i, 1)) === false) {
                return "Debe ingresar solo numeros y solo puedes separar el código de área con '-' o '()'.";
            }
        }

        if (!$this->variable_iniciada($telf_celular)) {
            return "Debes escribir un número de télefono celular.";
        } else {
            $this->telf_celular = $telf_celular;
        }
        return "";
    }

    private function validar_promo($promo) {
        if (!$this->variable_iniciada($promo)) {
            $this->promo = null;
        } else {
            $this->promo = $promo;
        }

        return "";
    }

    private function validar_acto($acto) {
        if (!$this->variable_iniciada($acto)) {
            $this->acto = null;
        } else {
            $this->acto = $acto;
        }

        return "";
    }

    private function validar_otro_tramite($otro_tramite) {
        if (!$this->variable_iniciada($otro_tramite)) {
            $this->otro_tramite = null;
        } else {
            $this->otro_tramite = $otro_tramite;
        }

        return "";
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_telf_local() {
        return $this->telf_local;
    }

    public function obtener_telf_celular() {
        return $this->telf_celular;
    }

    public function obtener_promo() {
        return $this->promo;
    }

    public function obtener_acto() {
        return $this->acto;
    }

    public function obtener_otro_tramite() {
        return $this->otro_tramite;
    }

    public function obtener_error_telf_local() {
        return $this->error_telf_local;
    }

    public function obtener_error_telf_celular() {
        return $this->error_telf_celular;
    }

    public function obtener_error_promo() {
        return $this->error_promo;
    }

    public function obtener_error_acto() {
        return $this->error_acto;
    }

    public function obtener_error_otro_tramite() {
        return $this->error_otro_tramite;
    }

    //Distintos metodos para mostrar los atributos de las variables
    public function mostrar_telf_local() {
        if ($this->telf_local !== "") {
            echo 'value="' . $this->telf_local . '"';
        }
    }

    public function mostrar_error_telf_local() {
        if ($this->error_telf_local !== "") {
            echo $this->aviso_inicio . $this->error_telf_local . $this->aviso_cierre;
        }
    }

    public function mostrar_telf_celular() {
        if ($this->telf_celular !== "") {
            echo 'value="' . $this->telf_celular . '"';
        }
    }

    public function mostrar_error_telf_celular() {
        if ($this->error_telf_celular !== "") {
            echo $this->aviso_inicio . $this->error_telf_celular . $this->aviso_cierre;
        }
    }

    public function mostrar_promo() {
        if ($this->promo !== "") {
            echo 'value="' . $this->promo . '"';
        }
    }

    public function mostrar_error_promo() {
        if ($this->error_promo !== "") {
            echo $this->aviso_inicio . $this->error_promo . $this->aviso_cierre;
        }
    }

    public function mostrar_acto() {
        if ($this->acto !== "") {
            echo 'value="' . $this->acto . '"';
        }
    }

    public function mostrar_error_acto() {
        if ($this->error_acto !== "") {
            echo $this->aviso_inicio . $this->error_acto . $this->aviso_cierre;
        }
    }

    public function mostrar_otro_tramite() {
        if ($this->otro_tramite !== "") {
            echo $this->otro_tramite;
        }
    }

    public function mostrar_error_otro_tramite() {
        if ($this->error_otro_tramite !== "") {
            echo $this->aviso_inicio . $this->error_otro_tramite . $this->aviso_cierre;
        }
    }

    public function tramite_valido() {
        if ($this->error_telf_local === "" && $this->error_telf_celular === "" && $this->error_promo === "" && $this->error_acto === "" && $this->error_otro_tramite === "") {
            return true;
        } else {
            return false;
        }
    }

}

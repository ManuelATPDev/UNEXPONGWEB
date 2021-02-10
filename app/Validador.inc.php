<?php

/* Creamos un pequeño ejemplo de como funciona la herencia en PHP unicamente para las entradas asi que
  creamos la clase maestra Validador para almacenar, obtener y comprobar las distintas variables
  que serán puestas en la sección de entradas de la base de datos */

abstract class Validador {

    //Se definen las distintas variables del campo usuario en este caso exclusivo de herencia se utiliza protected
    protected $aviso_inicio;
    protected $aviso_cierre;
    protected $titulo;
    protected $url;
    protected $texto;
    protected $error_titulo;
    protected $error_url;
    protected $error_texto;

    //Metodo constructor para darle valores a las distintas variables que seran mandadas desde validadorEntrada
    function __construct() {
        
    }

    //Distintos metodos para validar los atributos de las variables
    protected function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    protected function validar_titulo($titulo) {
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        } else {
            $this->titulo = $titulo;
        }

        if (strlen($titulo) > 255) {
            return "El título no puede ser más largo que 255 caracteres";
        }

        return "";
    }

    protected function validar_url($conexion, $url) {
        if (!$this->variable_iniciada($url)) {
            return "Debes escribir una url";
        } else {
            $this->url = $url;
        }

        $permitidos = "ÁÉÍÓÚáéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890-_";

        for ($i = 0; $i < strlen($url); $i++) {
            if (strpos($permitidos, substr($url, $i, 1)) === false) {
                return "Debe ingresar una url que no contenga espacios solo puedes utilizar - o _ para separar palabras.";
            }
        }

        if (RepositorioEntrada :: url_existe($conexion, $url)) {
            return "Ya existe una entrada con la misma url, elige otra";
        }

        return "";
    }

    protected function validar_texto($texto) {
        if (!$this->variable_iniciada($texto)) {
            return "Debes escribir el contenido de la entrada";
        } else {
            $this->texto = $texto;
        }

        return "";
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_titulo() {
        return $this->titulo;
    }

    public function obtener_url() {
        return $this->url;
    }

    public function obtener_texto() {
        return $this->texto;
    }

    public function obtener_error_titulo() {
        return $this->error_titulo;
    }

    public function obtener_error_url() {
        return $this->error_url;
    }

    public function obtener_error_texto() {
        return $this->error_texto;
    }

    public function mostrar_titulo() {
        if ($this->titulo !== "") {
            echo 'value="' . $this->titulo . '"';
        }
    }

    //Distintos metodos para mostrar los atributos de las variables
    public function mostrar_url() {
        if ($this->url !== "") {
            echo 'value="' . $this->url . '"';
        }
    }

    public function mostrar_texto() {
        if ($this->texto !== "" && strlen(trim($this->texto)) > 0) {
            echo $this->texto;
        }
    }

    public function mostrar_error_titulo() {
        if ($this->error_titulo !== "") {
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
        }
    }

    public function mostrar_error_url() {
        if ($this->error_url !== "") {
            echo $this->aviso_inicio . $this->error_url . $this->aviso_cierre;
        }
    }

    public function mostrar_error_texto() {
        if ($this->error_texto !== "") {
            echo $this->aviso_inicio . $this->error_texto . $this->aviso_cierre;
        }
    }

    public function entrada_valida() {
        if ($this->error_titulo === "" && $this->error_url === "" && $this->error_texto === "") {
            return true;
        } else {
            return false;
        }
    }

}

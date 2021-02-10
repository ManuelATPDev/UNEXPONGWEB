<?php

/* Creamos la clase ValidadorComentario para almacenar, obtener y comprobar las distintas variables 
  que serán puestas en la sección de comentarios de la base de datos */

class ValidadorComentario {

    //Se definen las distintas variables del campo comentario
    private $aviso_inicio;
    private $aviso_cierre;
    private $titulo_comentario;
    private $texto_comentario;
    private $error_texto_comentario;
    private $error_titulo_comentario;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($titulo_comentario, $texto_comentario) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->texto_comentario = "";
        $this->titulo_comentario = "";

        $this->error_texto_comentario = $this->validar_texto_comentario($texto_comentario);
        $this->error_titulo_comentario = $this->validar_titulo_comentario($titulo_comentario);
    }

    //Distintos metodos para validar los atributos de las variables
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_texto_comentario($texto_comentario) {
        if (!$this->variable_iniciada($texto_comentario)) {
            return "Debes escribir el contenido del comentario";
        } else {
            $this->texto_comentario = $texto_comentario;
        }

        return "";
    }

    public function validar_titulo_comentario($titulo_comentario) {
        if (!$this->variable_iniciada($titulo_comentario)) {
            return "Debes escribir un título al comentario";
        } else {
            $this->titulo_comentario = $titulo_comentario;
        }

        if (strlen($titulo_comentario) > 255) {
            return "El título no puede ser más largo que 255 caracteres";
        }

        return "";
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_texto_comentario() {
        return $this->texto_comentario;
    }

    public function obtener_error_texto_comentario() {
        return $this->error_texto_comentario;
    }

    public function obtener_titulo_comentario() {
        return $this->titulo_comentario;
    }

    public function obtener_error_titulo_comentario() {
        return $this->error_titulo_comentario;
    }

    //Distintos metodos para mostrar los atributos de las variables
    public function mostrar_titulo_comentario() {
        if ($this->titulo_comentario !== "") {
            echo 'value="' . $this->titulo_comentario . '"';
        }
    }

    public function mostrar_error_titulo_comentario() {
        if ($this->error_titulo_comentario !== "") {
            echo $this->aviso_inicio . $this->error_titulo_comentario . $this->aviso_cierre;
        }
    }

    public function mostrar_texto_comentario() {
        if ($this->texto_comentario !== "") {
            echo $this->texto_comentario;
        }
    }

    public function mostrar_error_texto_comentario() {
        if ($this->error_texto_comentario !== "") {
            echo $this->aviso_inicio . $this->error_texto_comentario . $this->aviso_cierre;
        }
    }

    public function comentario_valido() {
        if ($this->error_texto_comentario === "" && $this->error_titulo_comentario === "") {
            return true;
        } else {
            return false;
        }
    }

}

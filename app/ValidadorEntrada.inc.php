<?php

include_once 'RepositorioEntrada.inc.php';
include_once 'Validador.inc.php';

/* Creamos la clase ValidadorEntrada que es la clase hija de Validador para enviar los valores 
  que seran analizados por la clase Validador por eso se coloca el extends */

class ValidadorEntrada extends Validador {

    public function __construct($titulo, $url, $texto, $conexion) {
        $this->aviso_inicio = "<div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div";

        $this->titulo = "";
        $this->url = "";
        $this->texto = "";

        $this->error_titulo = $this->validar_titulo($titulo);
        $this->error_url = $this->validar_url($conexion, $url);
        $this->error_texto = $this->validar_texto($texto);
    }

}

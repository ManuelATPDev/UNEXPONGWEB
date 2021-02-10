<?php

include_once 'RepositorioEntrada.inc.php';
include_once 'Validador.inc.php';

/* Creamos la clase ValidadorEntradaEditada que es la clase hija de Validador para enviar los valores 
  que seran analizados por la clase Validador por eso se coloca el extends */

class ValidadorEntradaEditada extends Validador {

    //Se definen las variables originales del campo entrada porque se van a comparar
    private $cambios_realizados;
    private $titulo_original;
    private $url_original;
    private $texto_original;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($titulo, $titulo_original, $url, $url_original, $texto, $texto_original, $conexion) {
        $this->aviso_inicio = "<div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div";

        $this->titulo = $this->devolver_variable_iniciada($titulo);
        $this->url = $this->devolver_variable_iniciada($url);
        $this->texto = $this->devolver_variable_iniciada($texto);


        $this->titulo_original = $this->devolver_variable_iniciada($titulo_original);
        $this->url_original = $this->devolver_variable_iniciada($url_original);
        $this->texto_original = $this->devolver_variable_iniciada($texto_original);


        if ($this->titulo == $this->titulo_original && $this->url == $this->url_original && $this->texto == $this->texto_original) {

            $this->cambios_realizados = false;
        } else {
            $this->cambios_realizados = true;
        }

        if ($this->cambios_realizados) {

            $this->aviso_inicio = "<div class='alert alert-danger' role='alert'>";
            $this->aviso_cierre = "</div";

            if ($this->titulo !== $this->titulo_original) {
                $this->error_titulo = $this->validar_titulo($this->titulo);
            } else {
                $this->error_titulo = "";
            }

            if ($this->url !== $this->url_original) {
                $this->error_url = $this->validar_url($conexion, $this->url);
            } else {
                $this->error_url = "";
            }

            if ($this->texto !== $this->texto_original) {
                $this->error_texto = $this->validar_texto($this->texto);
            } else {
                $this->error_texto = "";
            }
        }
    }

    //Distintos metodos para obtener los atributos de las variables
    private function devolver_variable_iniciada($variable) {
        if ($this->variable_iniciada($variable)) {
            return $variable;
        } else {
            return "";
        }
    }

    public function hay_cambios() {
        return $this->cambios_realizados;
    }

    public function obtener_titulo_original() {
        return $this->titulo_original;
    }

    public function obtener_url_original() {
        return $this->url_original;
    }

    public function obtener_texto_original() {
        return $this->texto_original;
    }

}

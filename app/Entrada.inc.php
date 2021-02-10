<?php

/* Creamos la clase Entrada para almacenar y obtener las distintas variables 
  que serán puestas en la sección de Entrada de la base de datos */

class Entrada {

    //Se definen las distintas variables del campo Entrada
    private $id;
    private $autor_id;
    private $url;
    private $titulo;
    private $texto;
    private $tipo;
    private $fecha;
    private $activa;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($id, $autor_id, $url, $titulo, $texto, $tipo, $fecha, $activa) {
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->url = $url;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->activa = $activa;
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_id() {
        return $this->id;
    }

    public function obtener_autor_id() {
        return $this->autor_id;
    }

    public function obtener_url() {
        return $this->url;
    }

    public function obtener_titulo() {
        return $this->titulo;
    }

    public function obtener_texto() {
        return $this->texto;
    }

    public function obtener_tipo() {
        return $this->tipo;
    }

    public function obtener_fecha() {
        return $this->fecha;
    }

    public function esta_activa() {
        return $this->activa;
    }

    //Distintos metodos para modificar los atributos de las variables
    public function cambiar_url($url) {
        $this->titulo = $url;
    }

    public function cambiar_titulo($titulo) {
        $this->titulo = $titulo;
    }

    public function cambiar_texto($texto) {
        $this->texto = $texto;
    }

    public function cambiar_tipo($tipo) {
        $this->texto = $tipo;
    }

    public function cambiar_activa($activa) {
        $this->activa = $activa;
    }

}

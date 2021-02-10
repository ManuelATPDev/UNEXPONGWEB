<?php

/* Creamos la clase Comentario para almacenar y obtener las distintas variables 
  que serán puestas en la sección de comentarios de la base de datos */

class Comentario {

    //Se definen las distintas variables del campo comentario
    private $id;
    private $autor_id;
    private $entrada_id;
    private $titulo;
    private $texto;
    private $fecha;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($id, $autor_id, $entrada_id, $titulo, $texto, $fecha) {
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->entrada_id = $entrada_id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_id() {
        return $this->id;
    }

    public function obtener_autor_id() {
        return $this->autor_id;
    }

    public function obtener_entrada_id() {
        return $this->entrada_id;
    }

    public function obtener_titulo() {
        return $this->titulo;
    }

    public function obtener_texto() {
        return $this->texto;
    }

    public function obtener_fecha() {
        return $this->fecha;
    }

    public function cambiar_titulo($titulo) {
        $this->titulo = $titulo;
    }

    public function cambiar_texto($texto) {
        $this->texto = $texto;
    }

}
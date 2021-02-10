<?php

/* Creamos la clase Tramite para almacenar y obtener las distintas variables 
  que serán puestas en la sección de Entrada de la base de datos */

class Tramite {

    //Se definen las distintas variables del campo Tramite
    private $id;
    private $autor_id;
    private $tipo;
    private $fecha;
    private $referencia_tramite;
    private $tramite_activo;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($id, $autor_id, $tipo, $fecha, $referencia_tramite, $tramite_activo) {
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->referencia_tramite = $referencia_tramite;
        $this->tramite_activo = $tramite_activo;
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_id() {
        return $this->id;
    }

    public function obtener_autor_id() {
        return $this->autor_id;
    }

    public function obtener_tipo() {
        return $this->tipo;
    }

    public function obtener_fecha() {
        return $this->fecha;
    }

    public function obtener_referencia_tramite() {
        return $this->referencia_tramite;
    }

    public function esta_tramite_activo() {
        return $this->tramite_activo;
    }

    //Metodo para modificar los atributos del tramite si esta activo o no 
    public function cambiar_tramite_activo($tramite_activo) {
        $this->tramite_activo = $tramite_activo;
    }

}

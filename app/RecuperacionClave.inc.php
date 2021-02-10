<?php

/* Creamos la clase RecuperacionClave para almacenar y obtener las distintas variables 
  que serán puestas en la sección de RecuperacionClave de la base de datos */

class RecuperacionClave {

    //Se definen las distintas variables del campo RecuperacionClave
    private $id;
    private $usuario_id;
    private $url_secreta;
    private $fecha;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($id, $usuario_id, $url_secreta, $fecha) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->url_secreta = $url_secreta;
        $this->fecha = $fecha;
    }

}

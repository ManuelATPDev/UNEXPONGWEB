<?php

/* Creamos la clase Usuario para almacenar y obtener las distintas variables 
  que serán puestas en la sección de usuarios de la base de datos */

class Usuario {

    //Se definen las distintas variables del campo usuario
    private $id;
    private $nombre;
    private $apellido;
    private $cedula;
    private $expediente;
    private $especialidad;
    private $email;
    private $password;
    private $fecha_registro;
    private $activo;

    //Metodo constructor para darle valores a las distintas variables
    public function __construct($id, $nombre, $apellido, $cedula, $expediente, $especialidad, $email, $password, $fecha_registro, $activo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->expediente = $expediente;
        $this->especialidad = $especialidad;
        $this->email = $email;
        $this->password = $password;
        $this->fecha_registro = $fecha_registro;
        $this->activo = $activo;
    }

    //Distintos metodos para obtener los atributos de las variables
    public function obtener_id() {
        return $this->id;
    }

    public function obtener_nombre() {
        return $this->nombre;
    }

    public function obtener_apellido() {
        return $this->apellido;
    }

    public function obtener_cedula() {
        return $this->cedula;
    }

    public function obtener_expediente() {
        return $this->expediente;
    }

    public function obtener_especialidad() {
        return $this->especialidad;
    }

    public function obtener_email() {
        return $this->email;
    }

    public function obtener_password() {
        return $this->password;
    }

    public function obtener_fecha_registro() {
        return $this->fecha_registro;
    }

    public function esta_activo() {
        return $this->activo;
    }

    //Distintos metodos para modificar los atributos de las variables
    public function cambiar_nombre($nombre) {
        $this->nombre = $nombre;
    }

    public function cambiar_apellido($apellido) {
        $this->apellido = $apellido;
    }

    public function cambiar_cedula($cedula) {
        $this->cedula = $cedula;
    }

    public function cambiar_expediente($expediente) {
        $this->expediente = $expediente;
    }

    public function cambiar_especialidad($especialidad) {
        $this->especialidad = $especialidad;
    }

    public function cambiar_email($email) {
        $this->email = $email;
    }

    public function cambiar_password($password) {
        $this->password = $password;
    }

    public function cambiar_activo($activo) {
        $this->activo = $activo;
    }

}

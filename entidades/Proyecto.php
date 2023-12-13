<?php

class Proyecto implements JsonSerializable{
    private $codigo;
    private $nombre;
    private $fechaInicio;
    private $fechaFin;

    public function __construct($codigo, $nombre, $fechaInicio, $fechaFin){
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    //Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    //Setters
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFechaInicio($fechaInicio) {
        $this->nombre = $fechaInicio;
    }

    public function setFechaFin($fechaFin) {
        $this->nombre = $fechaFin;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
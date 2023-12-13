<?php

class usuario implements JsonSerializable{
    private $nombre;
    private $pass;
    
    public function __construct($nombre, $pass) {
        $this->pass = $pass;
        $this->nombre = $nombre;
    }

    // Getters
    public function getpass() {
        return $this->pass;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // Setters
    public function setpass($pass) {
        $this->pass = $pass;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}

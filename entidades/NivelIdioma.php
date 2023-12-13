<?php

class NivelIdioma implements JsonSerializable{
    private $id;
    private $nivel;

    public function __construct($id, $nivel) {
        $this->id = $id;
        $this->nivel = $nivel;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNivel() {
        return $this->nivel;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
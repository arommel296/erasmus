<?php

class Destinatario implements JsonSerializable{
    private $codigoGrupo;
    private $nombre;

    public function __construct($codigoGrupo, $nombre) {
        $this->codigoGrupo = $codigoGrupo;
        $this->nombre = $nombre;
    }

    // Getters
    public function getCodigoGrupo() {
        return $this->codigoGrupo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // Setters
    public function setCodigoGrupo($codigoGrupo) {
        $this->codigoGrupo = $codigoGrupo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
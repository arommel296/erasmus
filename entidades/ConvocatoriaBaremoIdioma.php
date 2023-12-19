<?php

class ConvocatoriaBaremoIdioma implements JsonSerializable{
    private $idConvocatoria;
    private $idNivel;
    private $puntuacionNivel;

    public function __construct($idConvocatoria, $idNivel, $puntuacionNivel) {
        $this->idConvocatoria = $idConvocatoria;
        $this->idNivel = $idNivel;
        $this->puntuacionNivel = $puntuacionNivel;
    }

    // Getters
    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function getIdNivel() {
        return $this->idNivel;
    }

    public function getPuntuacionNivel() {
        return $this->puntuacionNivel;
    }

    // Setters
    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setIdNivel($idNivel) {
        $this->idNivel = $idNivel;
    }

    public function setPuntuacionNivel($puntuacionNivel) {
        $this->puntuacionNivel = $puntuacionNivel;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
<?php

class DestinatarioConvocatoria implements JsonSerializable{
    private $idConvocatoria;
    private $idDestinatario;

    public function __construct($idConvocatoria, $idDestinatario) {
        $this->idConvocatoria = $idConvocatoria;
        $this->idDestinatario = $idDestinatario;
    }

    // Getters
    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function getIdDestinatario() {
        return $this->idDestinatario;
    }

    // Setters
    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setIdDestinatario($idDestinatario) {
        $this->idDestinatario = $idDestinatario;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
<?php

class ConvocatoriaBaremo implements JsonSerializable{
    private $idConvocatoria;
    private $idItem;
    private $puntuacionMax;
    private $valorMin;
    private $aportaAlumno;

    public function __construct($idConvocatoria, $idItem, $puntuacionMax, $valorMin, $aportaAlumno){
        $this->idConvocatoria = $idConvocatoria;
        $this->idItem = $idItem;
        $this->puntuacionMax = $puntuacionMax;
        $this->valorMin = $valorMin;
        $this->aportaAlumno = $aportaAlumno;
    }

    //Getters
    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function getIdItem() {
        return $this->idItem;
    }

    public function getPuntuacionMax() {
        return $this->puntuacionMax;
    }

    public function getValorMin() {
        return $this->valorMin;
    }

    public function getAportaAlumno() {
        return $this->aportaAlumno;
    }


    //Setters
    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    public function setPuntuacionMax($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setValorMin($valorMin) {
        $this->valorMin = $valorMin;
    }

    public function setAportaAlumno($aportaAlumno) {
        $this->aportaAlumno = $aportaAlumno;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }

}
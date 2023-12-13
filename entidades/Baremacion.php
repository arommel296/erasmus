<?php


class Baremacion implements JsonSerializable{
    private $idSolicitud;
    private $idBaremo;
    private $idConvocatoria;
    private $rutaFichero;
    private $baremoProvisional;
    private $baremoDefinitivo;

    public function __construct($idSolicitud, $idBaremo, $idConvocatoria, $rutaFichero, $baremoProvisional, $baremoDefinitivo){
        $this->idSolicitud = $idSolicitud;
        $this->idBaremo = $idBaremo;
        $this->idConvocatoria = $idConvocatoria;
        $this->rutaFichero = $rutaFichero;
        $this->baremoProvisional = $baremoProvisional;
        $this->baremoDefinitivo = $baremoDefinitivo;
    }

    //Getters
    public function getIdSolicitud() {
        return $this->idSolicitud;
    }

    public function getIdBaremo() {
        return $this->idBaremo;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    public function getRutaFichero() {
        return $this->rutaFichero;
    }

    public function getBaremoProvisional() {
        return $this->baremoProvisional;
    }

    public function getBaremoDefinitivo() {
        return $this->baremoDefinitivo;
    }

    //Setters
    public function setIdSolicitud($idSolicitud) {
        $this->idSolicitud = $idSolicitud;
    }

    public function setIdBaremo($idBaremo) {
        $this->idBaremo = $idBaremo;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

    public function setRutaFichero($rutaFichero) {
        $this->rutaFichero = $rutaFichero;
    }

    public function setBaremoProvisional($baremoProvisional) {
        $this->baremoProvisional = $baremoProvisional;
    }

    public function setbaremoDefinitivo($baremoDefinitivo) {
        $this->baremoDefinitivo = $baremoDefinitivo;
    }

    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }
}
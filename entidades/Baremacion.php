<?php


class Baremacion{
    private $idSolicitud;
    private $idBaremo;
    private $idConvocatoria;
    private $rutaFichero;
    private $baremacion;

    public function __construct($idSolicitud, $idBaremo, $idConvocatoria, $rutaFichero, $baremacion){
        $this->idSolicitud = $idSolicitud;
        $this->idBaremo = $idBaremo;
        $this->idConvocatoria = $idConvocatoria;
        $this->rutaFichero = $rutaFichero;
        $this->baremacion = $baremacion;
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

    public function getBaremacion() {
        return $this->baremacion;
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

    public function setBaremacion($baremacion) {
        $this->baremacion = $baremacion;
    }
}
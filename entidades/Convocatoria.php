<?php

class Convocatoria{
    private $id;
    private $movilidades;
    private $duracion;
    private $tipo;
    private $inicioSolicitud;
    private $finSolicitud;
    private $inicioPrueba;
    private $finPrueba;
    private $listaProv;
    private $listaDef;
    private $codigoProyecto;
    private $destinos;

    public function __construct($id, $movilidades, $duracion, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $destinos) {
        $this->id = $id;
        $this->movilidades = $movilidades;
        $this->duracion = $duracion;
        $this->tipo = $tipo;
        $this->inicioSolicitud = $inicioSolicitud;
        $this->finSolicitud = $finSolicitud;
        $this->inicioPrueba = $inicioPrueba;
        $this->finPrueba = $finPrueba;
        $this->listaProv = $listaProv;
        $this->listaDef = $listaDef;
        $this->codigoProyecto = $codigoProyecto;
        $this->destinos = $destinos;
    }

    //Getters
    public function getId() {
        return $this->id;
    }

    public function getMovilidades() {
        return $this->movilidades;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getInicioSolicitud() {
        return $this->inicioSolicitud;
    }

    public function getFinSolicitud() {
        return $this->finSolicitud;
    }

    public function getInicioPrueba() {
        return $this->inicioPrueba;
    }

    public function getFinPrueba() {
        return $this->finPrueba;
    }

    public function getListaProv() {
        return $this->listaProv;
    }

    public function getListaDef() {
        return $this->listaDef;
    }

    public function getCodigoProyecto() {
        return $this->codigoProyecto;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getDestinos() {
        return $this->destinos;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setMovilidades($movilidades) {
        $this->movilidades = $movilidades;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setInicioSolicitud($inicioSolicitud) {
        $this->inicioSolicitud = $inicioSolicitud;
    }

    public function setFinSolicitud($finSolicitud) {
        $this->finSolicitud = $finSolicitud;
    }

    public function setInicioPrueba($inicioPrueba) {
        $this->inicioPrueba = $inicioPrueba;
    }

    public function setFinPrueba($finPrueba) {
        $this->finPrueba = $finPrueba;
    }

    public function setListaProv($listaProv) {
        $this->listaProv = $listaProv;
    }

    public function setListaDef($listaDef) {
        $this->listaDef = $listaDef;
    }

    public function setCodigoProyecto($codigoProyecto) {
        $this->codigoProyecto = $codigoProyecto;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function setDestinos($destinos) {
        $this->destinos = $destinos;
    }

}
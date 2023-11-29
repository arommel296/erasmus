<?php


class Solicitud{
    private $id;
    private $dni;
    private $nombre;
    private $apellidos;
    private $curso;
    private $telefono;
    private $correo;
    private $fechaNac;
    private $domicilio;
    private $dniTutor;
    private $nombreTutor;
    private $apellidosTutor;
    private $domicilioTutor;
    private $telefonoTutor;
    private $pass;
    private $idConvocatoria;

    public function __construct($id, $dni, $nombre, $apellidos, $curso, $telefono, $correo, $fechaNac, $domicilio, $dniTutor, $nombreTutor, $apellidosTutor, $domicilioTutor, $telefonoTutor, $pass, $idConvocatoria) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->curso = $curso;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->fechaNac = $fechaNac;
        $this->domicilio = $domicilio;
        $this->dniTutor = $dniTutor;
        $this->nombreTutor = $nombreTutor;
        $this->apellidosTutor = $apellidosTutor;
        $this->domicilioTutor = $domicilioTutor;
        $this->telefonoTutor = $telefonoTutor;
        $this->pass = $pass;
        $this->idConvocatoria = $idConvocatoria;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getFechaNac() {
        return $this->fechaNac;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getDniTutor() {
        return $this->dniTutor;
    }

    public function getNombreTutor() {
        return $this->nombreTutor;
    }

    public function getApellidosTutor() {
        return $this->apellidosTutor;
    }

    public function getDomicilioTutor() {
        return $this->domicilioTutor;
    }

    public function getTelefonoTutor() {
        return $this->telefonoTutor;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getIdConvocatoria() {
        return $this->idConvocatoria;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function setDniTutor($dniTutor) {
        $this->dniTutor = $dniTutor;
    }

    public function setNombreTutor($nombreTutor) {
        $this->nombreTutor = $nombreTutor;
    }

    public function setApellidosTutor($apellidosTutor) {
        $this->apellidosTutor = $apellidosTutor;
    }

    public function setDomicilioTutor($domicilioTutor) {
        $this->domicilioTutor = $domicilioTutor;
    }

    public function setTelefonoTutor($telefonoTutor) {
        $this->telefonoTutor = $telefonoTutor;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function setIdConvocatoria($idConvocatoria) {
        $this->idConvocatoria = $idConvocatoria;
    }

}

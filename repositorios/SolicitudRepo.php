<?php

class SolicitudRepo implements dbInterface{
    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM solicitud where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $solicitud = new Solicitud($registro['id'], $registro['dni'], $registro['nombre'], $registro['apellidos'], $registro['curso'], $registro['telefono'], $registro['correo'],
                $registro['fechaNac'], $registro['domicilio'], $registro['dniTutor'], $registro['nombreTutor'], $registro['apellidosTutor'], $registro['domicilioTutor'],
                $registro['telefonoTutor'], $registro['pass'], $registro['idConvocatoria'], $registro['imagen']);
                return $solicitud;
            }
        } 
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM solicitud";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registro;
        }
        return null;
    }

    function findByName($name){
        $sql = "SELECT * FROM solicitud where nombre=:nombre";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $name);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $solicitud = new Solicitud($registro['id'], $registro['dni'], $registro['nombre'], $registro['apellidos'], $registro['curso'], $registro['telefono'], $registro['correo'],
                $registro['fechaNac'], $registro['domicilio'], $registro['dniTutor'], $registro['nombreTutor'], $registro['apellidosTutor'], $registro['domicilioTutor'],
                $registro['telefonoTutor'], $registro['pass'], $registro['idConvocatoria'], $registro['imagen']);
                return $solicitud;
            }   
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM solicitud where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

    function delete($object){
        return $this->deleteById($object->getId());
    }
    
    function save($object){
        $id=$object->getId();
        if($id!=""){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    function update($object){
        $sql = "UPDATE solicitud set dni = :dni, nombre = :nombre, apellidos = :apellidos, curso = :curso, telefono = :telefono, correo = :correo, fechaNac = :fechaNac,
        domicilio = :domicilio, dniTutor = :dniTutor, nombreTutor = :nombreTutor, apellidosTutor = :apellidosTutor, domicilioTutor = :domicilioTutor,
        telefonoTutor = :telefonoTutor, pass = :pass, idConvocatoria = :idConvocatoria, imagen = :imagen where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->execute([':nombre' => $object->getNombre(), ':dni' => $object->getDni(), ':apellidos' => $object->getApellidos(), ':curso' => $object->getCurso(),
        ':telefono' => $object->getTelefono(), ':correo' => $object->getCorreo(), ':fechaNac' => $object->getFechaNac(), ':domicilio' => $object->getDomicilio(),
        ':dniTutor' => $object->getDniTutor(), ':nombreTutor' => $object->getNombreTutor(), ':apellidosTutor' => $object->getApellidosTutor(), ':domicilioTutor' => $object->getDomicilioTutor(),
        ':telefonoTutor' => $object->getTelefonoTutor(), ':pass' => $object->getPass(), ':idConvocatoria' => $object->getIdConvocatoria(), ':imagen' => $object->getImagen(), ':id' => $object->getId()]);
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into solicitud(dni, nombre, apellidos, curso, telefono, correo, fechaNac, domicilio, dniTutor, nombreTutor, apellidosTutor, domicilioTutor, telefonoTutor, pass,
        idConvocatoria, imagen) values(:dni, :nombre, :apellidos, :curso, :telefono, :correo, :fechaNac, :domicilio, :dniTutor, :nombreTutor, :apellidosTutor, :domicilioTutor, :telefonoTutor,
        :pass, :idConvocatoria, imagen)";
        $statement = $this->conex->prepare($sql);
        $statement->execute([':nombre' => $object->getNombre(), ':dni' => $object->getDni(), ':apellidos' => $object->getApellidos(), ':curso' => $object->getCurso(),
        ':telefono' => $object->getTelefono(), ':correo' => $object->getCorreo(), ':fechaNac' => $object->getFechaNac(), ':domicilio' => $object->getDomicilio(),
        ':dniTutor' => $object->getDniTutor(), ':nombreTutor' => $object->getNombreTutor(), ':apellidosTutor' => $object->getApellidosTutor(), ':domicilioTutor' => $object->getDomicilioTutor(),
        ':telefonoTutor' => $object->getTelefonoTutor(), ':pass' => $object->getPass(), ':idConvocatoria' => $object->getIdConvocatoria(), ':imagen' => $object->getImagen(), ':id' => $object->getId()]);
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    

}
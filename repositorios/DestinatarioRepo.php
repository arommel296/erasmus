<?php

class DestinatarioRepo implements dbInterface{

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($id) {
        $sql = "SELECT * FROM destinatario WHERE codigoGrupo = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new Destinatario($registro['codigoGrupo'], $registro['nombre']);
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM destinatario";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $destinatarios = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $destinatarios[] = new Destinatario($registro['codigoGrupo'], $registro['nombre']);
        }
        return $destinatarios;
    }

    public function deleteById($id) {
        $sql = "DELETE FROM destinatario WHERE codigoGrupo = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($object) {
        return $this->deleteById($object->getCodigoGrupo());
    }

    public function save($object) {
        if ($this->findById($object->getCodigoGrupo())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE destinatario SET nombre = :nombre WHERE codigoGrupo = :codigoGrupo";
        $stmt = $this->conex->prepare($sql);
        return $stmt->execute([':codigoGrupo' => $object->getCodigoGrupo(), ':nombre' => $object->getNombre()]);
    }

    public function insert($object) {
        $sql = "INSERT INTO destinatario (codigoGrupo, nombre) VALUES (:codigoGrupo, :nombre)";
        $stmt = $this->conex->prepare($sql);
        return $stmt->execute([':codigoGrupo' => $object->getCodigoGrupo(), ':nombre' => $object->getNombre()]);
    }
}
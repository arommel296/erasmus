<?php

class DestinatarioConvocatoriaRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($idConvocatoria, $idDestinatario) {
        $sql = "SELECT * FROM destinatario_convocatoria WHERE idConvocatoria = :idConvocatoria AND idDestinatario = :idDestinatario";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idDestinatario' => $idDestinatario
        ];
        $stmt->execute($variables);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new DestinatarioConvocatoria(
                $registro['idConvocatoria'],
                $registro['idDestinatario']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM destinatario_convocatoria";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $destinatariosConvocatoria = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $destinatariosConvocatoria[] = new DestinatarioConvocatoria(
                $registro['idConvocatoria'],
                $registro['idDestinatario']
            );
        }
        return $destinatariosConvocatoria;
    }

    public function deleteById($idConvocatoria, $idDestinatario) {
        $sql = "DELETE FROM destinatario_convocatoria WHERE idConvocatoria = :idConvocatoria AND idDestinatario = :idDestinatario";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idDestinatario' => $idDestinatario
        ];
        return $stmt->execute($variables);
    }

    public function delete($object) {
        return $this->deleteById($object->getIdConvocatoria(), $object->getIdDestinatario());
    }

    public function save($object) {
        if ($this->findById($object->getIdConvocatoria(), $object->getIdDestinatario())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE destinatario_convocatoria SET idConvocatoria = :idConvocatoria WHERE idDestinatario = :idDestinatario";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idDestinatario' => $object->getIdDestinatario()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO destinatario_convocatoria (idConvocatoria, idDestinatario) VALUES (:idConvocatoria, :idDestinatario)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idDestinatario' => $object->getIdDestinatario()
        ];
        return $stmt->execute($variables);
    }
}

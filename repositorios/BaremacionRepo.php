<?php
class BaremacionRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($idConvocatoria, $idSolicitud, $idBaremo) {
        $sql = "SELECT * FROM baremacion WHERE idConvocatoria = :idConvocatoria AND idSolicitud = :idSolicitud AND idBaremo = :idBaremo";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':idConvocatoria', $idConvocatoria);
        $stmt->bindParam(':idSolicitud', $idSolicitud);
        $stmt->bindParam(':idBaremo', $idBaremo);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new Baremacion(
                $registro['idSolicitud'],
                $registro['idBaremo'],
                $registro['idConvocatoria'],
                $registro['rutaFichero'],
                $registro['baremoProvisional'],
                $registro['baremoDefinitivo']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM baremacion";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $baremaciones = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $baremaciones[] = new Baremacion(
                $registro['idSolicitud'],
                $registro['idBaremo'],
                $registro['idConvocatoria'],
                $registro['rutaFichero'],
                $registro['baremoProvisional'],
                $registro['baremoDefinitivo']
            );
        }
        return $baremaciones;
    }

    public function deleteById($idConvocatoria, $idSolicitud, $idBaremo) {
        $sql = "DELETE FROM baremacion WHERE idConvocatoria = :idConvocatoria AND idSolicitud = :idSolicitud AND idBaremo = :idBaremo";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':idConvocatoria', $idConvocatoria);
        $stmt->bindParam(':idSolicitud', $idSolicitud);
        $stmt->bindParam(':idBaremo', $idBaremo);
        return $stmt->execute();
    }

    public function delete($object) {
        return $this->deleteById($object->getIdConvocatoria(), $object->getIdSolicitud(), $object->getIdBaremo());
    }

    public function save($object) {
        if ($this->findById($object->getIdConvocatoria(), $object->getIdSolicitud(), $object->getIdBaremo())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE baremacion SET 
            rutaFichero = :rutaFichero,
            baremoProvisional = :baremoProvisional,
            baremoDefinitivo = :baremoDefinitivo
            WHERE idConvocatoria = :idConvocatoria AND idSolicitud = :idSolicitud AND idBaremo = :idBaremo";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idSolicitud' => $object->getIdSolicitud(),
            ':idBaremo' => $object->getIdBaremo(),
            ':rutaFichero' => $object->getRutaFichero(),
            ':baremoProvisional' => $object->getBaremoProvisional(),
            ':baremoDefinitivo' => $object->getBaremoDefinitivo()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO baremacion (idConvocatoria, idSolicitud, idBaremo, rutaFichero, baremoProvisional, baremoDefinitivo) 
            VALUES (:idConvocatoria, :idSolicitud, :idBaremo, :rutaFichero, :baremoProvisional, :baremoDefinitivo)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idSolicitud' => $object->getIdSolicitud(),
            ':idBaremo' => $object->getIdBaremo(),
            ':rutaFichero' => $object->getRutaFichero(),
            ':baremoProvisional' => $object->getBaremoProvisional(),
            ':baremoDefinitivo' => $object->getBaremoDefinitivo()
        ];
        return $stmt->execute($variables);
    }
}


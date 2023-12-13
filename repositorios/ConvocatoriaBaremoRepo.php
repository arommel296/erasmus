<?php

class ConvocatoriaBaremoRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findByIdConvocatoriaAndItem($idConvocatoria, $idItem) {
        $sql = "SELECT * FROM convocatoria-baremo WHERE idConvocatoria = :idConvocatoria AND idItem = :idItem";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idItem' => $idItem
        ];
        $stmt->execute($variables);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new ConvocatoriaBaremo(
                $registro['idConvocatoria'],
                $registro['idItem'],
                $registro['puntuacionMax'],
                $registro['valorMin'],
                $registro['aportaAlumno']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM convocatoria-baremo";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $convocatoriasBaremo = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $convocatoriasBaremo[] = new ConvocatoriaBaremo(
                $registro['idConvocatoria'],
                $registro['idItem'],
                $registro['puntuacionMax'],
                $registro['valorMin'],
                $registro['aportaAlumno']
            );
        }
        return $convocatoriasBaremo;
    }

    public function deleteByIdConvocatoriaAndItem($idConvocatoria, $idItem) {
        $sql = "DELETE FROM convocatoria-baremo WHERE idConvocatoria = :idConvocatoria AND idItem = :idItem";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idItem' => $idItem
        ];
        return $stmt->execute($variables);
    }

    public function delete($object) {
        return $this->deleteByIdConvocatoriaAndItem($object->getIdConvocatoria(), $object->getIdItem());
    }

    public function save($object) {
        if ($this->findByIdConvocatoriaAndItem($object->getIdConvocatoria(), $object->getIdItem())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE convocatoria-baremo SET 
            puntuacionMax = :puntuacionMax,
            valorMin = :valorMin,
            aportaAlumno = :aportaAlumno
            WHERE idConvocatoria = :idConvocatoria AND idItem = :idItem";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idItem' => $object->getIdItem(),
            ':puntuacionMax' => $object->getPuntuacionMax(),
            ':valorMin' => $object->getValorMin(),
            ':aportaAlumno' => $object->getAportaAlumno()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO convocatoria-baremo (idConvocatoria, idItem, puntuacionMax, valorMin, aportaAlumno) 
            VALUES (:idConvocatoria, :idItem, :puntuacionMax, :valorMin, :aportaAlumno)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idItem' => $object->getIdItem(),
            ':puntuacionMax' => $object->getPuntuacionMax(),
            ':valorMin' => $object->getValorMin(),
            ':aportaAlumno' => $object->getAportaAlumno()
        ];
        return $stmt->execute($variables);
    }
}

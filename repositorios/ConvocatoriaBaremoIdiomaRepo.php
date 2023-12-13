<?php

class ConvocatoriaBaremoIdiomaRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findByIdConvocatoriaAndNivel($idConvocatoria, $idNivel) {
        $sql = "SELECT * FROM convocatoria-baremo-idioma WHERE idConvocatoria = :idConvocatoria AND idNivel = :idNivel";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idNivel' => $idNivel
        ];
        $stmt->execute($variables);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new ConvocatoriaBaremoIdioma(
                $registro['idConvocatoria'],
                $registro['idNivel'],
                $registro['puntuacionNivel']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM convocatoria-baremo-idioma";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $convocatoriasBaremo = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $convocatoriasBaremo[] = new ConvocatoriaBaremoIdioma(
                $registro['idConvocatoria'],
                $registro['idNivel'],
                $registro['puntuacionNivel']
            );
        }
        return $convocatoriasBaremo;
    }

    public function deleteByIdConvocatoriaAndNivel($idConvocatoria, $idNivel) {
        $sql = "DELETE FROM convocatoria-baremo-idioma WHERE idConvocatoria = :idConvocatoria AND idNivel = :idNivel";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $idConvocatoria,
            ':idNivel' => $idNivel
        ];
        return $stmt->execute($variables);
    }

    public function delete($object) {
        return $this->deleteByIdConvocatoriaAndNivel($object->getIdConvocatoria(), $object->getIdNivel());
    }

    public function save($object) {
        if ($this->findByIdConvocatoriaAndNivel($object->getIdConvocatoria(), $object->getIdNivel())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE convocatoria-baremo-idioma SET 
            puntuacionNivel = :puntuacionNivel
            WHERE idConvocatoria = :idConvocatoria AND idNivel = :idNivel";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idNivel' => $object->getIdNivel(),
            ':puntuacionNivel' => $object->getPuntuacionNivel()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO convocatoria-baremo-idioma (idConvocatoria, idNivel, puntuacionNivel) 
            VALUES (:idConvocatoria, :idNivel, :puntuacionNivel)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':idConvocatoria' => $object->getIdConvocatoria(),
            ':idNivel' => $object->getIdNivel(),
            ':puntuacionNivel' => $object->getPuntuacionNivel()
        ];
        return $stmt->execute($variables);
    }
}

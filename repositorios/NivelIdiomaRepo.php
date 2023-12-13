<?php

class NivelIdiomaRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($id) {
        $sql = "SELECT * FROM nivel-idioma WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':id' => $id
        ];
        $stmt->execute($variables);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new NivelIdioma(
                $registro['id'],
                $registro['nivel']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM nivel-idioma";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $nivelesIdioma = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nivelesIdioma[] = new NivelIdioma(
                $registro['id'],
                $registro['nivel']
            );
        }
        return $nivelesIdioma;
    }

    public function deleteById($id) {
        $sql = "DELETE FROM nivel-idioma WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':id' => $id
        ];
        return $stmt->execute($variables);
    }

    public function delete($object) {
        return $this->deleteById($object->getId());
    }

    public function save($object) {
        if ($this->findById($object->getId())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE nivel-idioma SET nivel = :nivel WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':id' => $object->getId(),
            ':nivel' => $object->getNivel()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO nivel-idioma (id, nivel) VALUES (:id, :nivel)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':id' => $object->getId(),
            ':nivel' => $object->getNivel()
        ];
        return $stmt->execute($variables);
    }
}

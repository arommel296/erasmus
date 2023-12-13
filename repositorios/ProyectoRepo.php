<?php
class ProyectoRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($codigo) {
        $sql = "SELECT * FROM proyecto WHERE codigo = :codigo";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new Proyecto($registro['codigo'], $registro['nombre'], $registro['fechaInicio'], $registro['fechaFin']);
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM proyecto";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $proyectos = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $proyectos[] = new Proyecto($registro['codigo'], $registro['nombre'], $registro['fechaInicio'], $registro['fechaFin']);
        }
        return $proyectos;
    }

    public function deleteById($codigo) {
        $sql = "DELETE FROM proyecto WHERE codigo = :codigo";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        return $stmt->execute();
    }

    public function delete($object) {
        return $this->deleteById($object->getCodigo());
    }

    public function save($object) {
        if ($this->findById($object->getCodigo())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE proyecto SET nombre = :nombre, fechaInicio = :fechaInicio, fechaFin = :fechaFin WHERE codigo = :codigo";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':codigo' => $object->getCodigo(),
            ':nombre' => $object->getNombre(),
            ':fechaInicio' => $object->getFechaInicio(),
            ':fechaFin' => $object->getFechaFin()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO proyecto (codigo, nombre, fechaInicio, fechaFin) VALUES (:codigo, :nombre, :fechaInicio, :fechaFin)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':codigo' => $object->getCodigo(),
            ':nombre' => $object->getNombre(),
            ':fechaInicio' => $object->getFechaInicio(),
            ':fechaFin' => $object->getFechaFin()
        ];
        return $stmt->execute($variables);
    }
}
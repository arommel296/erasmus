<?php

class ItemBaremableRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findById($id) {
        $sql = "SELECT * FROM itembaremable WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new ItemBaremable($registro['id'], $registro['nombre']);
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM itembaremable";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $items = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = new ItemBaremable($registro['id'], $registro['nombre']);
        }
        return $items;
    }

    public function deleteById($id) {
        $sql = "DELETE FROM itembaremable WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
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
        $sql = "UPDATE itembaremable SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        return $stmt->execute([':id' => $object->getId(), ':nombre' => $object->getNombre()]);
    }
    
    public function insert($object) {
        $sql = "INSERT INTO itembaremable (id, nombre) VALUES (:id, :nombre)";
        $stmt = $this->conex->prepare($sql);
        return $stmt->execute([':id' => $object->getId(), ':nombre' => $object->getNombre()]);
    }
}

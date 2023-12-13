<?php

class UsuarioRepo implements dbInterface {

    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    public function findByNombre($nombre) {
        $sql = "SELECT * FROM usuario WHERE nombre = :nombre";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':nombre' => $nombre
        ];
        $stmt->execute($variables);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($registro) {
            return new Usuario(
                $registro['nombre'],
                $registro['pass']
            );
        }
        return null;
    }

    public function findAll() {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->conex->prepare($sql);
        $stmt->execute();
        $usuarios = [];
        while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario(
                $registro['nombre'],
                $registro['pass']
            );
        }
        return $usuarios;
    }

    public function deleteByNombre($nombre) {
        $sql = "DELETE FROM usuario WHERE nombre = :nombre";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':nombre' => $nombre
        ];
        return $stmt->execute($variables);
    }

    public function delete($object) {
        return $this->deleteByNombre($object->getNombre());
    }

    public function save($object) {
        if ($this->findByNombre($object->getNombre())) {
            return $this->update($object);
        } else {
            return $this->insert($object);
        }
    }

    public function update($object) {
        $sql = "UPDATE usuario SET pass = :pass WHERE nombre = :nombre";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':nombre' => $object->getNombre(),
            ':pass' => $object->getPass()
        ];
        return $stmt->execute($variables);
    }

    public function insert($object) {
        $sql = "INSERT INTO usuario (nombre, pass) VALUES (:nombre, :pass)";
        $stmt = $this->conex->prepare($sql);
        $variables = [
            ':nombre' => $object->getNombre(),
            ':pass' => $object->getPass()
        ];
        return $stmt->execute($variables);
    }
}

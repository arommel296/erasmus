<?php
//require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/autocargar.php";

interface methodDB{
    public function findById($id);
    public function findAll();
    public function deleteById($id);
    public function delete($object);
    public function save($object);
    public function update($object);
    public function insert($object);
}
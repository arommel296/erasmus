<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$repo = new DestinatarioRepo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['codigoGrupo'])) {
        $id=$_GET['codigoGrupo'];
        try {
            $resultado = $repo->findById($id);
        } catch (Exception $e) {
            http_response_code(502);
            echo json_encode(['error' => $e->getMessage()]);
            die;
        }
        if ($resultado) {
            header('Content-Type: application/json');
            echo json_encode($resultado);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se ha encontrado grupo"]);
        }
    } else{
        try {
            $resultado = $repo->findAll();
        } catch (Exception $e) {
            http_response_code(502);
            echo json_encode(['error' => $e->getMessage()]);
            die;
        }
        if ($resultado) {
            header('Content-Type: application/json');
            echo json_encode($resultado);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se han encontrado grupos"]);
        }
    }
}
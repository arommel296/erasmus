<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";

$repo=new ProyectoRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
        echo json_encode(["error" => "Proyectos no encontrados"]);
    }
}

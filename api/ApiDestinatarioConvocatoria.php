<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$repo = new DestinatarioConvocatoriaRepo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['grupo'])) {
        $idGrupo = $_GET['grupo'];
        try {
            // Busca todas las convocatorias asociadas al destinatario
            $resultado = $repo->findAllByDestinatario($idGrupo);
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
            echo json_encode(["mensaje" => "No se han encontrado convocatorias para el grupo"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["mensaje" => "Debe proporcionar un código de grupo"]);
    }
}

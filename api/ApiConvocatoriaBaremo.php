<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$repo = new ConvocatoriaBaremoRepo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['idConvocatoria'])) {
        $idConvocatoria = $_GET['idConvocatoria'];
        try {
            // Busca todas las convocatorias asociadas al destinatario
            $resultado = $repo->findByIdConvocatoria($idConvocatoria);
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
            echo json_encode(["mensaje" => "No se han encontrado items baremables para la convocatorias"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["mensaje" => "Debe proporcionar un id de convocatoria"]);
    }
}
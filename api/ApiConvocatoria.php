<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$repo=new ConvocatoriaRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET[''])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "nuevaconvocatoria") {
            $resultado = $repo->findAll();
            $convocatoriaes=[];
            foreach($resultado as $convocatoria){
                $convocatoriaes[]=$convocatoria;
            }
            header('Content-Type: application/json');
            echo json_encode($convocatoriaes);
        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $datosPreg=file_get_contents("php://input");
        $convocatoria=json_decode($datosPreg, true);

        $id = $convocatoria['id'];
        $movilidades = $convocatoria['movilidades'];
        $duracion = $convocatoria['duracion'];
        $tipo = $convocatoria['tipo'];
        $codigoProyecto = $convocatoria['codigoProyecto'];
        $destinos = $convocatoria['destinos'];
        $inicioSolicitud = $convocatoria['inicioSolicitud'];
        $finSolicitud = $convocatoria['finSolicitud'];
        $inicioPrueba = $convocatoria['inicioPrueba'];
        $finPrueba = $convocatoria['finPrueba'];
        $listaProv = $convocatoria['listaProv'];
        $listaDef = $convocatoria['listaDef'];

        $finSolicitudTutor = $convocatoria['finSolicitudTutor'];
        $pass = $convocatoria['pass'];
        $idConvocatoria = $convocatoria['idConvocatoria'];
        $imagen = $convocatoria['imagen'];

        $convocatoriaG = new convocatoria($id, $movilidades, $duracion, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $destinos);

        $resultado = $repo->save($convocatoriaG);
        // header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($resultado);
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {
        $id = $_GET["id"];
        $respuesta = $repo->deleteById($id);
        echo '{"respuesta":"200"}';
    } else{
        echo '{"respuesta":"ERROR"}';
    }
}
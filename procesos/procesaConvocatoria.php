<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        // $datosPreg=file_get_contents("php://input");
        // $solicitud=json_decode($datosPreg, true);

        $id = $_POST['id'];
        $movilidades = $_POST['movilidades'];
        $tipo = $_POST['tipo'];
        $inicioSolicitud = $_POST['inicioSolicitud'];
        $finSolicitud = $_POST['finSolicitud'];
        $inicioPrueba = $_POST['inicioPrueba'];
        $finPrueba = $_POST['finPrueba'];
        $listaProv = $_POST['listaProv'];
        $listaDef = $_POST['listaDef'];
        $codigoProyecto = $_POST['codigoProyecto'];
        $duracion = $_POST['duracion'];
        $destinos = $_POST['destinos'];
        $idItem = $_POST['idItem'];
        $puntuacionMax1 = $_POST['puntuacionMax1'];
        $valorMin1 = $_POST['valorMin1'];
        $aportaAlumno = $_POST['aportaAlumno'];
        $destinatarios = $_POST['destinatarios'];

        $convocatoria = new Convocatoria(null, $movilidades, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $duracion, $destinos);

        $convocatoriaBaremo = new ConvocatoriaBaremo(null, $idItem, $puntuacionMax1, $valorMin1, $aportaAlumno);

        foreach ($destinatarios as $idDestinatario) {
            $destinatarioConvocatoria = new DestinatarioConvocatoria(null, $idDestinatario);
        }
        

        $resultado = $repo->transaction($convocatoria, $convocatoriaBaremo);
        // header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($resultado);
    }
}
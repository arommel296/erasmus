<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
$repo=new SolicitudRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET[''])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "nuevasolicitud") {
            $resultado = $repo->findAll();
            $solicitudes=[];
            foreach($resultado as $solicitud){
                $solicitudes[]=$solicitud;
            }
            header('Content-Type: application/json');
            echo json_encode($solicitudes);
        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $datosPreg=file_get_contents("php://input");
        $solicitud=json_decode($datosPreg, true);

        $id = $solicitud['id'];
        $dni = $solicitud['dni'];
        $nombre = $solicitud['nombre'];
        $apellidos = $solicitud['apellidos'];
        $curso = $solicitud['curso'];
        $telefono = $solicitud['telefono'];
        $correo = $solicitud['correo'];
        $fechaNac = $solicitud['fechaNac'];
        $domicilio = $solicitud['domicilio'];
        $dniTutor = $solicitud['dniTutor'];
        $nombreTutor = $solicitud['nombreTutor'];
        $apellidosTutor = $solicitud['apellidosTutor'];
        $telefonoTutor = $solicitud['telefonoTutor'];
        $domicilioTutor = $solicitud['domicilioTutor'];
        $pass = $solicitud['pass'];
        $idConvocatoria = $solicitud['idConvocatoria'];
        $imagen = $solicitud['imagen'];

        $solicitudG = new Solicitud($id, $dni, $nombre, $apellidos, $curso, $telefono, $correo, $fechaNac, $domicilio, $dniTutor, $nombreTutor, $apellidosTutor, $telefonoTutor, $domicilioTutor, $pass, $idConvocatoria, $imagen);

        $resultado = $repo->save($solicitudG);
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
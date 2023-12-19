<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";

$repo = new SolicitudRepo();

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $resultado = $repo->findAll();
        $solicitudes = [];
        foreach ($resultado as $solicitud) {
            $solicitudes[] = $solicitud;
        }
        header('Content-Type: application/json');
        echo json_encode($solicitudes);
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $datosPreg = file_get_contents("php://input");
        $solicitud = json_decode($datosPreg, true);

        echo '<script>console.log('.$solicitud.')</script>';
        // validar los datos de la solicitud antes de insertarla en la base de datos

        $solicitudG = new Solicitud(
            $solicitud['id'],
            $solicitud['dni'],
            $solicitud['nombre'],
            $solicitud['apellidos'],
            $solicitud['curso'],
            $solicitud['telefono'],
            $solicitud['correo'],
            $solicitud['fechaNac'],
            $solicitud['domicilio'],
            $solicitud['dniTutor'],
            $solicitud['nombreTutor'],
            $solicitud['apellidosTutor'],
            $solicitud['telefonoTutor'],
            $solicitud['domicilioTutor'],
            $solicitud['pass'],
            $solicitud['idConvocatoria'],
            $solicitud['imagen']
        );

        $resultado = $repo->insert($solicitudG);
        http_response_code(200);
        echo json_encode($resultado);
    } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $datosPreg = file_get_contents("php://input");
        $solicitud = json_decode($datosPreg, true);

        // validar los datos de la solicitud antes de actualizarla en la base de datos

        $solicitudG = new Solicitud(
            $solicitud['id'],
            $solicitud['dni'],
            $solicitud['nombre'],
            $solicitud['apellidos'],
            $solicitud['curso'],
            $solicitud['telefono'],
            $solicitud['correo'],
            $solicitud['fechaNac'],
            $solicitud['domicilio'],
            $solicitud['dniTutor'],
            $solicitud['nombreTutor'],
            $solicitud['apellidosTutor'],
            $solicitud['telefonoTutor'],
            $solicitud['domicilioTutor'],
            $solicitud['pass'],
            $solicitud['idConvocatoria'],
            $solicitud['imagen']
        );

        $resultado = $repo->update($solicitudG);
        http_response_code(200);
        echo json_encode($resultado);
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $respuesta = $repo->deleteById($id);
            echo '{"respuesta":"200"}';
        } else {
            throw new Exception('No se proporcionó un id válido');
        }
    } else {
        throw new Exception('Método HTTP no soportado');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}




// $repo=new SolicitudRepo();
// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//     if (isset($_GET[''])) {
//         $resultado = $repo->findAll();
//         $solicitudes=[];
//         foreach($resultado as $solicitud){
//             $solicitudes[]=$solicitud;
//         }
//         header('Content-Type: application/json');
//         echo json_encode($solicitudes);    
//     }
// }elseif($_SERVER["REQUEST_METHOD"] == "POST"){
//     if (isset($_POST)) {
//         $datosPreg=file_get_contents("php://input");
//         $solicitud=json_decode($datosPreg, true);

//         $id = $solicitud['id'];
//         $dni = $solicitud['dni'];
//         $nombre = $solicitud['nombre'];
//         $apellidos = $solicitud['apellidos'];
//         $curso = $solicitud['curso'];
//         $telefono = $solicitud['telefono'];
//         $correo = $solicitud['correo'];
//         $fechaNac = $solicitud['fechaNac'];
//         $domicilio = $solicitud['domicilio'];
//         $dniTutor = $solicitud['dniTutor'];
//         $nombreTutor = $solicitud['nombreTutor'];
//         $apellidosTutor = $solicitud['apellidosTutor'];
//         $telefonoTutor = $solicitud['telefonoTutor'];
//         $domicilioTutor = $solicitud['domicilioTutor'];
//         $pass = $solicitud['pass'];
//         $idConvocatoria = $solicitud['idConvocatoria'];
//         $imagen = $solicitud['imagen'];

//         $solicitudG = new Solicitud($id, $dni, $nombre, $apellidos, $curso, $telefono, $correo, $fechaNac, $domicilio, $dniTutor, $nombreTutor, $apellidosTutor, $telefonoTutor, $domicilioTutor, $pass, $idConvocatoria, $imagen);

//         $resultado = $repo->insert($solicitudG);
//         // header('Content-Type: application/json');
//         http_response_code(200);
//         echo json_encode($resultado);
//     }
// } elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
//         //recoger datos 

//         $id = $solicitud['id'];
//         $dni = $solicitud['dni'];
//         $nombre = $solicitud['nombre'];
//         $apellidos = $solicitud['apellidos'];
//         $curso = $solicitud['curso'];
//         $telefono = $solicitud['telefono'];
//         $correo = $solicitud['correo'];
//         $fechaNac = $solicitud['fechaNac'];
//         $domicilio = $solicitud['domicilio'];
//         $dniTutor = $solicitud['dniTutor'];
//         $nombreTutor = $solicitud['nombreTutor'];
//         $apellidosTutor = $solicitud['apellidosTutor'];
//         $telefonoTutor = $solicitud['telefonoTutor'];
//         $domicilioTutor = $solicitud['domicilioTutor'];
//         $pass = $solicitud['pass'];
//         $idConvocatoria = $solicitud['idConvocatoria'];
//         $imagen = $solicitud['imagen'];

//         $solicitudG = new Solicitud($id, $dni, $nombre, $apellidos, $curso, $telefono, $correo, $fechaNac, $domicilio, $dniTutor, $nombreTutor, $apellidosTutor, $telefonoTutor, $domicilioTutor, $pass, $idConvocatoria, $imagen);

//         $resultado = $repo->insert($solicitudG);
//         // header('Content-Type: application/json');
//         http_response_code(200);
//         echo json_encode($resultado);
// } elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
//     if (isset($_GET)) {
//         $id = $_GET["id"];
//         $respuesta = $repo->deleteById($id);
//         echo '{"respuesta":"200"}';
//     } else{
//         echo '{"respuesta":"ERROR"}';
//     }
// }
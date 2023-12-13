<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/convocatoria.js"></script>
    <link rel="stylesheet" href="../estilos/convocatoria.css">
    <title>Convocatoria</title>
</head>

<body>
    <form method="post" action="">
        <label for="id" class="escondido">ID:</label>
            <input type="number" id="id" name="id" disabled min="1" class="escondido">
        <div class="izq">
            <label for="movilidades">Movilidades:</label>
                <input type="number" id="movilidades" name="movilidades" min="1">
            <label for="duracion">Duración:</label>
                <input type="number" id="duracion" name="duracion" min="1">
            <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                </select> 
            <label for="destinos">Destinos:</label>
                <input type="text" id="destinos" name="destinos">
            <label for="codigoProyecto">Proyecto:</label>
                <select id="codigoProyecto" name="codigoProyecto">
                    <option value="">Selecciona el proyecto</option>
                </select>
        </div>  
        <div class="dcha">
            <label for="inicioSolicitud" class="right">Inicio Solicitud:</label>
                <input type="date" id="inicioSolicitud" name="inicioSolicitud" class="right">
            <label for="inicioPrueba" class="right">Inicio Prueba:</label>
                <input type="date" id="inicioPrueba" name="inicioPrueba" class="right">
            <label for="listaProv" class="right">Lista Prov:</label>
                <input type="date" id="listaProv" name="listaProv" class="right">
            <label for="finSolicitud" class="right">Fin Solicitud:</label>
                <input type="date" id="finSolicitud" name="finSolicitud" class="right">
            <label for="finPrueba" class="right">Fin Prueba:</label>
                <input type="date" id="finPrueba" name="finPrueba" class="right">
            <label for="listaDef" class="right">Lista Def:</label>
                <input type="date" id="listaDef" name="listaDef" class="right">
        </div>
        <label for="itembaremable" class="escondido">Item Baremable:</label>
            <select id="itembaremable" name="itembaremable" class="escondido">
                <option value="">Selecciona Item Baremable</option>

                <?php
                require_once "";
                ?>

            </select>
        <label for="puntuacionMax" class="escondido">Puntuación Máx:</label>
            <input type="number" id="puntuacionMax" name="puntuacionMax" min="0" class="escondido">
        <label for="valorMin" class="escondido">Valor Min:</label>
            <input type="number" id="valorMin" name="valorMin" min="0" class="escondido">
        <label for="aportaAlumno" class="escondido">Aporta Alumno:</label>
            <select id="aportaAlumno" name="aportaAlumno" class="escondido">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>

 <?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

}

// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     if (isset($_POST)) {
//         $datosPreg=file_get_contents("php://input");
//         $solicitud=json_decode($datosPreg, true);

//         $id = $_POST['id'];
//         $movilidades = $_POST['movilidades'];
//         $tipo = $_POST['tipo'];
//         $inicioSolicitud = $_POST['inicioSolicitud'];
//         $finSolicitud = $_POST['finSolicitud'];
//         $inicioPrueba = $_POST['inicioPrueba'];
//         $finPrueba = $_POST['finPrueba'];
//         $listaProv = $_POST['listaProv'];
//         $listaDef = $_POST['listaDef'];
//         $codigoProyecto = $_POST['codigoProyecto'];
//         $duracion = $_POST['duracion'];
//         $destinos = $_POST['destinos'];
//         $idItem = $_POST['idItem'];
//         $puntuacionMax1 = $_POST['puntuacionMax1'];
//         $valorMin1 = $_POST['valorMin1'];
//         $aportaAlumno = $_POST['aportaAlumno'];
//         $imagen = $_POST['imagen'];

//         $convocatoria = new Convocatoria($id, $movilidades, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $duracion, $destinos);




//         $resultado = $repo->save($solicitudG);
//         http_response_code(200);
//         echo json_encode($resultado);
//     }
// }
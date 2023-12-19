<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";
Session::iniciaSesion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/header.css">
    <link rel="stylesheet" href="estilos/solicitud.css">
    <link rel="stylesheet" href="estilos/convocatoria.css">
    <script src="js/convocatoria.js"></script>
    <script src="js/crudConvocatoria.js"></script>
    <!-- <link rel="stylesheet" href="../estilos/convocatoria.css"> -->
    <title>Convocatoria</title>
</head>

<body>
<header>
        <a href="?menu=inicio" tabindex="1">
            <img src="imagenes/logoFuentezuelasBlanco.png" alt="INICIO" width="20%" height="20%">
        </a>
        <nav class="menu">
            <ul class="ul">
                <li class="li" id="aConvocatorias"><a a href="?menu=listaConvocatorias" tabindex="2">Convocatorias
                        Disponibles</a></li>
                <li class="li" id="consultaSolicitud"><a href="?menu=loginSolicitud" tabindex="3">Consulta
                        Solicitud</a>
                </li>
                <li class="dropdown li" id="loginAdmin">
                    <a href="?menu=loginAdmin" tabindex="3">Administración<span>&#9662;</span></a>
                    <ul class="dropdown-content ul">
                        <li class="li"><a href="?menu=crudConvocatoria"" class="opc">Administrar convocatorias</a>
                        </li>
                        <li class="li"><a href="?menu=listaSolicitudes" class="opc">Baremar Solicitudes</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <?php
        ?>
    </header>
    <form method="post" action="" class="formulario">
            <fieldset>
            <legend>Datos</legend>
            <div class="fila">
                <input type="number" id="idConvocatoria" name="idConvocatoria" style="display: none;">
                <div class="campo">
                    <label for="movilidades">Movilidades:</label>
                    <input type="number" id="movilidades" name="movilidades" min="1">
                </div>
                <div class="campo">
                    <label for="duracion">Duración:</label>
                    <input type="number" id="duracion" name="duracion" min="1">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo">
                        <option value="larga">Larga</option>
                        <option value="corta">Corta</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="destinos">Destinos:</label>
                    <input type="text" id="destinos" name="destinos">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="proyecto">Proyecto:</label>
                    <select id="proyecto" name="proyecto">
                        <option>Selecciona el proyecto</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="destinatarios">Destinatarios:</label>
                    <select id="destinatarios" name="destinatarios[]" multiple>
                        <option value="">Selecciona los grupos</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Plazos</legend>
            <div class="fila">
                <div class="campo">
                    <label for="inicioSolicitud" class="right">Inicio Solicitud:</label>
                    <input type="date" id="inicioSolicitud" name="inicioSolicitud" class="right">
                </div>
                <div class="campo">
                <label for="finSolicitud" class="right">Fin Solicitud:</label>
                    <input type="date" id="finSolicitud" name="finSolicitud" class="right">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                <label for="inicioPrueba" class="right">Inicio Prueba:</label>
                    <input type="date" id="inicioPrueba" name="inicioPrueba" class="right">
                </div>
                <div class="campo">
                <label for="finPrueba" class="right">Fin Prueba:</label>
                    <input type="date" id="finPrueba" name="finPrueba" class="right">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                <label for="listaProv" class="right">Lista Prov:</label>
                    <input type="date" id="listaProv" name="listaProv" class="right">
                </div>
                <div class="campo">
                    <label for="listaDef" class="right">Lista Def:</label>
                    <input type="date" id="listaDef" name="listaDef" class="right">
                </div>
            </div>
        </fieldset>
        <?php
        $itemRepo = new ItemBaremableRepo();
        $convoBaremoRepo = new ConvocatoriaBaremoRepo();
        $convoRepo = new ConvocatoriaRepo();

        try {
            $items = $itemRepo->findAll();
            if(empty($items)) {
                throw new Exception('No hay items baremables disponibles');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        echo '<fieldset>';
        echo '<legend>Items Baremables</legend>';
        foreach($items as $item) {
            echo '<div id="itemB' . $item->getId() . '">';
            echo '<div class="fila">';
            echo '<div class="campo">';
            echo '<div style="display: flex;"><input type="checkbox" id="item_' . $item->getId() . '" name="items[]" value="' . $item->getId() . '">';
            echo '<label for="item_' . $item->getId() . '">' . $item->getNombre() . '</label></div>';
            echo '</div>';
            echo '<div class="campo">';
            echo '<label for="aportaAlumno' . $item->getId() .'">Aporta Alumno:</label> <select name="aportaAlumno_' . $item->getId() . '"><option value="SI">SI</option><option value="NO">NO</option></select><br>';
            echo '</div>';
            echo '</div>';
            echo '<div class="fila">';
            echo '<div class="campo">';
            echo '<label for="valorMin' . $item->getId() .'">Valor Min:</label> <input type="number" name="valorMin_' . $item->getId() . '" min="0"><br>';
            echo '</div>';
            echo '<div class="campo">';
            echo '<label for="puntuacionMax' . $item->getId() .'">Puntuación Máx:</label> <input type="number" name="puntuacionMax_' . $item->getId() . '" min="0"><br>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</fieldset>';

        ?>

        <div class="listadoC">
            <p>Convocatorias disponibles:</p>
            <?php
            try {
                $convocatorias = $convoRepo->findAllDisponibles();
                if(empty($convocatorias)) {
                    throw new Exception('No hay convocatorias disponibles');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="escondido">ID Convocatoria</th>
                        <th>Proyecto</th>
                        <th>Inicio Solicitudes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Itera sobre cada convocatoria
                        foreach($convocatorias as $convocatoria) {
                            echo '<tr>';
                            echo '<td class="escondido">' . $convocatoria->getId() . '</td>';
                            echo '<td>' . $convocatoria->getCodigoProyecto() . '</td>';
                            echo '<td>' . $convocatoria->getInicioSolicitud() . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
        <input type="submit" value="Enviar">
    </form>
    <?php

    ?>
</body>

</html>

 <?php
echo $_SESSION['usuario'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $validator = new Validacion();
    $convocatoriaRepo = new ConvocatoriaRepo();
    if (isset($_POST)) {

        echo $_SESSION['usuario'];
        //Validaciones de los campos, utilizo la función validarCampo, a la que se le pasa el nombre del campo y un array con las comprobaciones que se le quiere hacer
        $validator->validarCampo('movilidades', ['requerido', 'entero'], 1);
        $validator->validarCampo('duracion', ['requerido', 'entero'], 1);
        $validator->validarCampo('tipo', ['requerido']);
        $validator->validarCampo('proyecto', ['requerido']);
        $validator->validarCampo('destinos', ['requerido']);
        $validator->validarCampo('inicioSolicitud', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'finSolicitud');
        $validator->validarCampo('finSolicitud', ['requerido', 'fecha']);
        $validator->validarCampo('inicioPrueba', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'inicioPrueba');
        $validator->validarCampo('finPrueba', ['requerido', 'fecha']);
        $validator->validarCampo('listaProv', ['requerido']);
        $validator->validarCampo('listaDef', ['requerido']);

        if (!$validator->ValidacionPasada()) {
            foreach ($validator->getErrores() as $error) {
                echo $error;
            }
            $validator->borrarErrores();
        } else{
            
            $movilidades = $_POST['movilidades'];
            $duracion = $_POST['duracion'];
            $tipo = $_POST['tipo'];
            $codigoProyecto = $_POST['proyecto'];
            $destinos = $_POST['destinos'];
            $inicioSolicitud = $_POST['inicioSolicitud'];
            $finSolicitud = $_POST['finSolicitud'];
            $inicioPrueba = $_POST['inicioPrueba'];
            $finPrueba = $_POST['finPrueba'];
            $listaProv = $_POST['listaProv'];
            $listaDef = $_POST['listaDef'];
            // $inicioSolicitud = DateTime::createFromFormat('d/m/Y', $_POST['inicioSolicitud'])->format('Y-m-d');
            // $finSolicitud = DateTime::createFromFormat('d/m/Y', $_POST['finSolicitud'])->format('Y-m-d');
            // $inicioPrueba = DateTime::createFromFormat('d/m/Y', $_POST['inicioPrueba'])->format('Y-m-d');
            // $finPrueba = DateTime::createFromFormat('d/m/Y', $_POST['finPrueba'])->format('Y-m-d');
            // $listaProv = DateTime::createFromFormat('d/m/Y', $_POST['listaProv'])->format('Y-m-d');
            // $listaDef = DateTime::createFromFormat('d/m/Y', $_POST['listaDef'])->format('Y-m-d');



            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $convocatoriaG = new convocatoria($id, $movilidades, $duracion, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $destinos);
            }else{
                $convocatoriaG = new convocatoria(null, $movilidades, $duracion, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $destinos);
            }
            
            
            $destinatarios=[];
            if (!empty($_POST['destinatarios'])) {
                foreach ($_POST['destinatarios'] as $destinatario) {

                    $grupo = new DestinatarioConvocatoria(null, $destinatario);
                    $destinatarios[]=$grupo;
                }
            }

            $convocBaremo =[];
            if (isset($_POST['items'])) {
                //variable donde almaceno los items
                
                $items = $_POST['items'];
                foreach($items as $item) {
                    $aportaAlumno = $_POST['aportaAlumno_' . $item];
                    $valorMin = $_POST['valorMin_' . $item];
                    $puntuacionMax = $_POST['puntuacionMax_' . $item];

                
                    $itemBaremable = new ConvocatoriaBaremo(null, $item, $puntuacionMax, $valorMin, $aportaAlumno);
                    $convocBaremo[] = $itemBaremable;
                }
            }

            $nivelIdioma =[];
            if (isset($_POST['item_4'])) {
                // El checkbox "item_4" está marcado, que va a ser el idioma
                $puntuaciones = [];
                $puntuaciones[]=$_POST['a1'];
                $puntuaciones[]=$_POST['a2'];
                $puntuaciones[]=$_POST['b1'];
                $puntuaciones[]=$_POST['b2'];
                $puntuaciones[]=$_POST['c1'];
                $puntuaciones[]=$_POST['c2'];

                
                for ($i=0; $i < 5; $i++) { 
                    $convoBareIdioma = new ConvocatoriaBaremoIdioma(null, ($i+1), $puntuaciones[$i]);
                    $nivelIdioma[]=$convoBareIdioma;
                }
        
            }

            $convocatoriaRepo->transaction($convocatoriaG, $convocBaremo, $destinatarios, $nivelIdioma);

        }


    }
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
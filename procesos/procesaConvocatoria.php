<?php

require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/erasmus/helpers/Autocargar.php";

// $validator = new Validacion();
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     if (isset($_POST)) {
//         $id = $_POST['id'];
//         $movilidades = $validator->validarCampo('movilidades', ['requerido', 'entero'], 1);
//         $duracion = $validator->validarCampo('duracion', ['requerido', 'entero'], 1);
//         $tipo = $validator->validarCampo('tipo', ['requerido']);
//         $codigoProyecto = $validator->validarCampo('codigoProyecto', ['requerido']);
//         $destinos = $validator->validarCampo('destinos', ['requerido']);
//         $inicioSolicitud = $validator->validarCampo('inicioSolicitud', ['requerido', 'fecha']);
//         $finSolicitud = $validator->validarCampo('finSolicitud', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'inicioSolicitud');
//         $inicioPrueba = $validator->validarCampo('inicioPrueba', ['requerido', 'fecha']);
//         $finPrueba = $validator->validarCampo('finPrueba', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'inicioPrueba');
//         $listaProv = $validator->validarCampo('listaProv', ['requerido']);
//         $listaDef = $validator->validarCampo('listaDef', ['requerido']);

//         $convocatoriaG = new convocatoria($id, $movilidades, $duracion, $tipo, $inicioSolicitud, $finSolicitud, $inicioPrueba, $finPrueba, $listaProv, $listaDef, $codigoProyecto, $destinos);



//     }
// }

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $validator = new Validacion();
    $convocatoriaRepo = new ConvocatoriaRepo();
    if (isset($_POST)) {

        $validator->validarCampo('movilidades', ['requerido', 'entero'], 1);
        $validator->validarCampo('duracion', ['requerido', 'entero'], 1);
        $validator->validarCampo('tipo', ['requerido']);
        $validator->validarCampo('proyecto', ['requerido']);
        $validator->validarCampo('destinos', ['requerido']);
        $validator->validarCampo('inicioSolicitud', ['requerido', 'fecha']);
        $validator->validarCampo('finSolicitud', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'inicioSolicitud');
        $validator->validarCampo('inicioPrueba', ['requerido', 'fecha']);
        $validator->validarCampo('finPrueba', ['requerido', 'fecha', 'fechaAntesQue'], PHP_INT_MIN, PHP_INT_MAX, 'inicioPrueba');
        $validator->validarCampo('listaProv', ['requerido']);
        $validator->validarCampo('listaDef', ['requerido']);

        if (!$validator->ValidacionPasada()) {
            foreach ($validator->getErrores() as $error) {
                echo $error;
            }
            // echo $validator->getErrores();
            $validator->borrarErrores();
        } else{
            
            $movilidades = $_POST['movilidades'];
            $duracion = $_POST['duracion'];
            $tipo = $_POST['tipo'];
            $codigoProyecto = $_POST['proyecto'];
            $destinos = $_POST['destinos'];
            $inicioSolicitud = DateTime::createFromFormat('d/m/Y', $_POST['inicioSolicitud'])->format('Y-m-d');
            $finSolicitud = DateTime::createFromFormat('d/m/Y', $_POST['finSolicitud'])->format('Y-m-d');
            $inicioPrueba = DateTime::createFromFormat('d/m/Y', $_POST['inicioPrueba'])->format('Y-m-d');
            $finPrueba = DateTime::createFromFormat('d/m/Y', $_POST['finPrueba'])->format('Y-m-d');
            $listaProv = DateTime::createFromFormat('d/m/Y', $_POST['listaProv'])->format('Y-m-d');
            $listaDef = DateTime::createFromFormat('d/m/Y', $_POST['listaDef'])->format('Y-m-d');

            echo $movilidades;

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
                $idiomas = [];
                $idiomas[]=$_POST['a1'];
                $idiomas[]=$_POST['a2'];
                $idiomas[]=$_POST['b1'];
                $idiomas[]=$_POST['b2'];
                $idiomas[]=$_POST['c1'];
                $idiomas[]=$_POST['c2'];

                
                for ($i=0; $i < 5; $i++) { 
                    $convoBareIdioma = new ConvocatoriaBaremoIdioma(null, ($i+1), $idiomas[$i]);
                    $nivelIdioma[]=$convoBareIdioma;
                }
        
            }

            $convocatoriaRepo->transaction($convocatoriaG, $convocBaremo, $destinatarios, $nivelIdioma);

        }

        

        // $convocatoriaRepo->transaction($convocatoriaG, $convocBaremo, $destinatarios, $nivelIdioma);

    }
}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convocatorias Disponibles</title>
    <!-- <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/listaConvocatorias.css"> -->
    <!-- <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="stylesheet" href="./css/loginRegistro.css">
    <link rel="stylesheet" href="./css/nuevoExamen.css">
    <link rel="stylesheet" href="./css/nuevaPregunta.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gudea&family=Hind&display=swap" rel="stylesheet">
    <!-- <script src="./js/preguntas.js"></script>
    <script src="./js/nuevaPregunta.js"></script>
    <script src="./js/cargaAlumnos.js"></script>
    <script src="./js/realizaExamen.js"></script> -->
</head>

<body>
    <?php
        require_once './vistas/principal/header.php';
        require_once './vistas/principal/Enrutador.php';
           Enrutador::enruta();
        
    ?>
    <!-- <section class="content">
        <div id="cuerpo" >
        <?php
        //    require_once './vistas/principal/Enrutador.php';
        //    Enrutador::enruta();
        ?>
        </div>
    </section> -->

    <!-- <?php
        // require_once './vistas/principal/footer.php';
    ?> -->

</body>

</html>
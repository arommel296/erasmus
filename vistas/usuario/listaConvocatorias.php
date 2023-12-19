<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/principal.css"> -->
    <link rel="stylesheet" href="estilos/header.css">
    <link rel="stylesheet" href="estilos/listaConvocatorias.css">
    <script src="js/listaConvocatorias.js"></script>
    <title>Listado Convocatorias</title>
</head>

<body>
    <header>
        <a href="?menu=inicio" tabindex="1">
            <img src="./imagenes/logoFuentezuelasBlanco.png" alt="INICIO" width="20%" height="20%">
        </a>
        <nav class="menu">
            <ul class="ul">
                <li class="li" id="aConvocatorias"><a a href="?menu=listaConvocatorias" tabindex="2">Convocatorias
                        Disponibles</a></li>
                <li class="li" id="consultaSolicitud"><a href="?menu=loginSolicitud" tabindex="3">Consulta
                        Solicitud</a>
                </li>
                <li class="li" id="loginAdmin"><a href="?menu=loginAdmin" tabindex="3">Administración</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Convocatorias Disponibles</h1>
        <label>Seleccionar grupo:</label>
        <div id="selectGrupo">
            <select name="grupo">
            </select>
        </div>
        <table id="listadoConvoc">
            <thead>
                <tr>
                    <th>Convocatoria</th>
                    <th>Inicio Solicitud</th>
                    <th>Fin Solicitud</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>Convocatoria 1</td>
                    <td>10/12/2023</td>
                    <td>01/15/2024</td>
                    <td><a href="?menu=solicitud">Solicitar</a></td>
                </tr>
                <tr>
                    <td>Convocatoria 2</td>
                    <td>01/02/2024</td>
                    <td>28/02/2024</td>
                    <td><a href="?menu=solicitud">Solicitar</a></td>
                </tr>
                <tr>
                    <td>Convocatoria 3</td>
                    <td>01/03/2024</td>
                    <td>31/03/2024</td>
                    <td><a href="?menu=solicitud">Solicitar</a></td>
                </tr> -->
            </tbody>
        </table>
    </main>
</body>

</html>
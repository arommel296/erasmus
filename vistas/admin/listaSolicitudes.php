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
    <link rel="stylesheet" href="estilos/listaConvocatorias.css">
    <title>Solicitudes</title>
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
                <li class="li" id="consultaSolicitud"><a href="?menu=loginSolicitud" tabindex="3">Consulta Solicitud</a>
                </li>
                <!-- <li class="li" id="loginAdmin"><a href="?menu=loginAdmin" tabindex="3">Administración</a></li> -->
                <li class="dropdown li" id="loginAdmin">
                    <a href="?menu=loginAdmin" tabindex="3">Administración<span>&#9662;</span></a>
                    <ul class="dropdown-content ul">
                        <li class="li"><a href="?menu=crudConvocatoria" class=" opc">Administrar convocatorias</a>
                        </li>
                        <li class="li"><a href="?menu=listaSolicitudes" class="opc">Baremar Solicitudes</a></li>
                    </ul>
                </li>
                <?php
                    echo $_SESSION['usuario'];
                ?>
            </ul>
        </nav>
    </header>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/loginSolicitud.css">
    <link rel="stylesheet" href="estilos/header.css">
    <link rel="stylesheet" href="estilos/estilo.css">
    <script src = "js/validaciones1.js"></script>
    <script src = "js/logica.js"></script>
    <title>Consulta de solicitud</title>
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
                <li class="li" id="loginAdmin"><a href="?menu=loginAdmin" tabindex="3">Administración</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="login-form">
            <form>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" data-valida = "dni" placeholder="DNI" required >
                <label for="localizador">Localizador:</label>
                <input type="text" name="localizador" data-valida = "relleno" placeholder="Localizador" required >
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="contraseña" data-valida = "relleno" placeholder="Contraseña" required >
                <div>
                    <input type="submit" value="Consultar Solicitud" id="submit">
                </div>
            </form>
        </div>
    </main>

</body>

</html>
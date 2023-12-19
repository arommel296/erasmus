<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/solicitud.css">
    <link rel="stylesheet" href="estilos/header.css">
    <link rel="stylesheet" href="estilos/estilo.css">
    <script type="module" src="js/validaciones1.js"></script>
    <script type="module" src="js/logica.js"></script>
    <script type="module" src="js/recuadro.js"></script>
    <script type="module" src="js/solicitud.js"></script>
    <title>Solicitud</title>
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
    <form action="" method="post" class="formulario">
        <fieldset>
            <legend>Datos Solicitante</legend>
            <input type="number" id="id" name="id" maxlength="5" class="escondido">
            <div class="fila">
                <div class="campo">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" maxlength="9" data-valida = "relleno">
                </div>
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" maxlength="50" data-valida = "relleno">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" maxlength="50" data-valida = "relleno">
                </div>
                <div class="campo">
                    <label for="curso">Curso:</label>
                    <input type="text" id="curso" name="curso" maxlength="100" data-valida = "relleno">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" maxlength="9" data-valida = "relleno">
                </div>
                <div class="campo">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" maxlength="50" data-valida = "relleno">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="fechaNac">Fecha de Nacimiento:</label>
                    <input type="date" id="fechaNac" name="fechaNac" data-valida = "relleno">
                </div>
                <div class="campo">
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" maxlength="100" data-valida = "relleno">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Datos Tutor Legal</legend>
            <div class="fila">
                <div class="campo">
                    <label for="dniTutor">DNI Tutor:</label>
                    <input type="text" id="dniTutor" name="dniTutor" maxlength="9">
                </div>
                <div class="campo">
                    <label for="nombreTutor">Nombre Tutor:</label>
                    <input type="text" id="nombreTutor" name="nombreTutor" maxlength="100">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="apellidosTutor">Apellidos Tutor:</label>
                    <input type="text" id="apellidosTutor" name="apellidosTutor" maxlength="100">
                </div>
                <div class="campo">
                    <label for="telefonoTutor">Teléfono Tutor:</label>
                    <input type="text" id="telefonoTutor" name="telefonoTutor" maxlength="9">
                </div>
            </div>
            <div class="fila">
                <div class="campo">
                    <label for="domicilioTutor">Domicilio Tutor:</label>
                    <input type="text" id="domicilioTutor" name="domicilioTutor" maxlength="100">
                </div>
                <div class="campo">

                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Establecer contraseña</legend>
            <div class="fila">
                <div class="campo">
                    <label for="pass1">Contraseña:</label>
                    <input type="password" id="pass1" name="pass1" maxlength="30">
                </div>
                <div class="campo">
                    <label for="pass2">Confirmar Contraseña:</label>
                    <input type="password" id="pass2" name="pass2" maxlength="30">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Archivos Requeridos</legend>
            <div id="items"></div>
            <!-- <div class="fila">
                <div class="campo">
                    <label for="notaMedia">Nota media:</label>
                    <input type="file" id="notaMedia" name="notaMedia">
                </div>
                <div class="campo">
                    <label for="idioma">Título Idioma:</label>
                    <input type="file" id="idioma" name="idioma">
                </div>
            </div> -->
            <div class="fila">
                <div class="campo">
                    <label for="imagen">Subir Imagen:</label>
                    <input type="file" accept="image/*" id="imagen" name="imagen">
                </div>
                <div class="campo">
                    <label for="capturar">Hacer foto:</label>
                    <button id="capturar" name="capturar">Capturar Imagen</button>
                    <button id="quitar" name="quitar" disabled="true">Descartar foto</button>
                </div>
            </div>
            <div class="fila">
                <div class="campo tam">

                </div>
                <div class="campo tam">
                    <img src="" alt="Foto Web" id="foto" style="display: none;">
                </div>
            </div>
        </fieldset>
        <div class="fila">
            <div class="fila">
                <input type="submit" value="Enviar" id="submit">
                <div id="volver">
                    <a href="?menu=inicio">Volver</a>
                </div>
                <!-- <div id="guardar">
                    <a href="?menu=inicio">Guardar</a>
                </div> -->
            </div>
        </div>
    </form>
</body>

</html>
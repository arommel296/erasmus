<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../estilos/header.css">
    <link rel="stylesheet" href="../../estilos/solicitud.css">
    <link rel="stylesheet" href="../../estilos/convocatoria.css">
    <script src="../../js/convocatoria.js"></script>
    <script src="../../js/crudConvocatoria.js"></script>
    <!-- <link rel="stylesheet" href="../estilos/convocatoria.css"> -->
    <title>Convocatoria</title>
</head>

<body>
<header>
        <a href="?menu=inicio" tabindex="1">
            <img src="../../imagenes/logoFuentezuelasBlanco.png" alt="INICIO" width="20%" height="20%">
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
                        <li class="li"><a href="?menu=crearConvocatoria"" class=" opc">Administrar convocatorias</a>
                        </li>
                        <li class="li"><a href="?menu=listaSolicitudes" class="opc">Baremar Solicitudes</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main>
            <div class="login-form">
                <form method="post" class="formInicioSesion" action="">
                    <label for="usuario">Usuario:</label><br>
                    <input autocomplete="on" class="input-form" type="text" placeholder="Usuario" id="usuario"
                        name="usuario"><br>
                    <label for="password">Contraseña:</label><br>
                    <input class="input-form" type="password" placeholder="Contraseña" id="password" name="password"><br>
                    <div>
                        <input type="submit" name="submit" value="Iniciar sesión">
                    </div>
                </form>
            </div>
        </main>
</header>
</body>
</html>
<?php
    session_unset();
    Session::cierraSesion();
    $valida=new Validacion();
    $repo=new UsuarioRepo();
    if(isset($_POST['submit']))
    {
        $nomUsu=$_POST['usuario'];
        $passUsu=$_POST['password'];
        // $valida->Requerido($nomUsu); //puede generar error
        // $valida->Requerido($passUsu); //puede generar error
        echo $nomUsu;
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {
            // $usuario=null;
            $usuario=$repo->findByNamePass($nomUsu, $passUsu);
            // $repo->u($nomUsu);
            if($usuario!=null)
            {
                //echo $_SESSION['usuario'];
                Login::login($nomUsu);
                echo $nomUsu;
                echo $_SESSION['usuario'];
                // $_SESSION['rol']=$usuario->getRol();

                header("location: ?menu=inicio");
                
            } else{
                echo json_encode(['error'=>'No se ha podido iniciar sesión']);
                echo $nomUsu;
            }
        }
    }
?>
